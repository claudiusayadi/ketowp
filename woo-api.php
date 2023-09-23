<?php
// Set your API credentials
$consumer_key = "ck_6ecdb3028545a651b38894f8b45654a6335ac4b2";
$consumer_secret = "cs_e8fb8bb7d7a3d401fb05ccb3081a316a79975525";
$store_url = "https://dealsomart.com";

// Set the API endpoint to retrieve products
$api_endpoint = $store_url . "/wp-json/wc/v3/products";

// Product data to be created
$product_data = [
    "name" => "Product Name",
    "type" => "simple",
    "regular_price" => "29.99",
    "description" => "Product description goes here.",
    // Add more product attributes as needed
];

// Create cURL session
$ch = curl_init($api_endpoint);

// Set cURL options
$headers = [
    "Authorization: Basic " . $consumer_key . ":" . $consumer_secret,
    "Content-Type: application/json",
];
$product_data_json = json_encode($product_data);

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $product_data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session to create the product
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo "Error: " . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Display the API response (created product data)
echo $response;
?>
