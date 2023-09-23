<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined("ABSPATH") || exit();

get_header("shop");

// Remove Breadcrumb
remove_action("woocommerce_before_main_content", "woocommerce_breadcrumb", 20);

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action("woocommerce_before_main_content");
?>
<section class="collection-page">
  <div class="container page-hero">
    <h1 class="page-title">
      <?php echo get_the_archive_title("", false); ?>
    </h1>
    <div class="sub-hero">
      <?php
      // Add Breadcrumb
      woocommerce_breadcrumb();
      // Add Catalog Ordering
      woocommerce_catalog_ordering();
      ?>
    </div>
  </div>
</section>

<?php if (woocommerce_product_loop()) { ?>
<section class="wc-notices">
  <div class="container">

    <?php
    // Remove Catalog Ordering
    remove_action(
        "woocommerce_before_shop_loop",
        "woocommerce_catalog_ordering",
        30,
    );

    // Remove Result Count
    remove_action(
        "woocommerce_before_shop_loop",
        "woocommerce_result_count",
        20,
    );

    /**
     * Hook: woocommerce_before_shop_loop.
     *
     * @hooked woocommerce_output_all_notices - 10
     * @hooked woocommerce_result_count - 20
     * @hooked woocommerce_catalog_ordering - 30
     */
    do_action("woocommerce_before_shop_loop");
    ?>
  </div>
</section>

<section class="collections">
  <div class="container">

    <?php
    /**
      * Hook: woocommerce_sidebar.
      *
      * @hooked woocommerce_get_sidebar - 10
      */
    ?>
    <?php do_action("woocommerce_sidebar"); ?>

    <div class="products">
      <?php
      woocommerce_product_loop_start();

      if (wc_get_loop_prop("total")) {
          while (have_posts()) {
              the_post();

              /**
               * Hook: woocommerce_shop_loop.
               */
              do_action("woocommerce_shop_loop");

              wc_get_template_part("content", "product");
          }
      }

      woocommerce_product_loop_end();

      /**
       * Hook: woocommerce_after_shop_loop.
       *
       * @hooked woocommerce_pagination - 10
       */
      do_action("woocommerce_after_shop_loop");

      /**
       * Hook: woocommerce_archive_description.
       *
       * @hooked woocommerce_taxonomy_archive_description - 10
       * @hooked woocommerce_product_archive_description - 10
       */
      do_action("woocommerce_archive_description");
      } else {/**
     * Hook: woocommerce_no_products_found.
     *
     * @hooked wc_no_products_found - 10
     */
    do_action("woocommerce_no_products_found");} ?>

    </div>
  </div>
</section>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action("woocommerce_after_main_content");

get_footer("shop");