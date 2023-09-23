<?php

require_once ABSPATH . "wp-admin/includes/image.php";

// Fetch data from the API
$response = wp_remote_get("https://dummyjson.com/products?limit=30");

// Check for errors
if (is_wp_error($response)) {
    error_log(
        "Failed to fetch products from API: " . $response->get_error_message(),
    );
    return;
}

// Decode the JSON data
$data = json_decode(wp_remote_retrieve_body($response), true);

// Flag to track if any new products are created
$new_products_created = false;

// Array to store used image URLs
$used_images = [];

// Loop through each product
foreach ($data["products"] as $product_data) {
    // Check if a product with the same SKU already exists
    $existing_product_id = wc_get_product_id_by_sku($product_data["id"]);
    if (0 === $existing_product_id) {
        // Create a new product
        $product = new WC_Product_Simple();
        $new_products_created = true; // Set flag to true
    } else {
        // Update an existing product
        $product = wc_get_product($existing_product_id);
        if (!$product) {
            error_log("Failed to get product with SKU: " . $product_data["id"]);
            continue;
        }
    }

    // Check if the image has already been used
    if (in_array($product_data["thumbnail"], $used_images)) {
        error_log(
            "Image " . $product_data["thumbnail"] . " has already been used.",
        );
        continue;
    }

    // Add the image to the used images array
    $used_images[] = $product_data["thumbnail"];

    // Set product properties
    $product->set_props([
        "sku" => sanitize_text_field($product_data["id"]),
        "name" => sanitize_text_field($product_data["title"]),
        "description" => sanitize_textarea_field($product_data["description"]),
        "regular_price" => floatval($product_data["price"]),
        "sale_price" =>
            floatval($product_data["price"]) *
            (1 - floatval($product_data["discountPercentage"]) / 100),
        "stock_quantity" => intval($product_data["stock"]),
        "image_id" => cwpai_upload_image_from_url(
            sanitize_url($product_data["thumbnail"]),
        ),
        "gallery_image_ids" => array_map(
            "cwpai_upload_image_from_url",
            array_map("sanitize_url", $product_data["images"]),
        ),
    ]);

    // Set category
    if (!empty($product_data["category"])) {
        $category = sanitize_text_field($product_data["category"]);
        if (!term_exists($category, "product_cat")) {
            wp_insert_term($category, "product_cat");
        }
        wp_set_object_terms($product->get_id(), $category, "product_cat", true);
    }

    // Set tags (brands)
    if (!empty($product_data["brand"])) {
        wp_set_object_terms(
            $product->get_id(),
            sanitize_text_field($product_data["brand"]),
            "product_tag",
            true,
        );
    }

    // Save the product
    $product->save();
}

// Set a transient to indicate that the products have been updated, but only if new products were created
if ($new_products_created) {
    set_transient("products_updated", true, DAY_IN_SECONDS);

    // Delete duplicate products
    cwpai_delete_duplicate_products();
}

// Function to upload image from URL and return the attachment ID
function cwpai_upload_image_from_url($image_url)
{
    $upload_dir = wp_upload_dir();

    // Retrieve the image file name
    $image_file = basename($image_url);

    // Build the image file path
    $image_path = $upload_dir["path"] . "/" . $image_file;

    // Download and save the image file
    if (file_put_contents($image_path, file_get_contents($image_url))) {
        // Build the image file URL
        $image_url = $upload_dir["url"] . "/" . $image_file;

        // Set the image file attributes
        $attachment_data = [
            "guid" => $image_url,
            "post_mime_type" => "image/jpeg",
            "post_title" => sanitize_file_name($image_file),
            "post_content" => "",
            "post_status" => "inherit",
        ];

        // Create the attachment
        $attachment_id = wp_insert_attachment($attachment_data, $image_path);

        // Generate the metadata for the attachment and update it
        $attachment_data = wp_generate_attachment_metadata(
            $attachment_id,
            $image_path,
        );
        wp_update_attachment_metadata($attachment_id, $attachment_data);

        return $attachment_id;
    }

    return false; // Return false if the upload fails
}

// Function to delete duplicate products
function cwpai_delete_duplicate_products()
{
    global $wpdb;

    // Get all SKUs
    $results = $wpdb->get_results(
        "SELECT meta_value, COUNT(*) c FROM wp_postmeta WHERE meta_key='_sku' GROUP BY meta_value HAVING c > 1;",
    );

    foreach ($results as $result) {
        // Get all product IDs with this SKU
        $product_ids = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT post_id FROM wp_postmeta WHERE meta_key='_sku' AND meta_value='%s';",
                $result->meta_value,
            ),
        );

        // Keep the first product, delete the rest
        array_shift($product_ids);
        foreach ($product_ids as $product_id) {
            wp_delete_post($product_id->post_id);
        }
    }
}
