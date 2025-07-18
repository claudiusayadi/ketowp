<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if (!defined("ABSPATH")) {
    exit();
}

// Determine the input ID
$input_id = isset($index)
    ? "wc-search-field-" . absint($index)
    : "wc-search-field-0";

// Default placeholder
$default_placeholder = esc_attr__("What are you looking for?", "woocommerce");

// Alternate placeholder
$alternate_placeholder = "Instant search";

// Use the alternate placeholder if the input ID is "wc-search-field-1", else use the default
$placeholder =
    $input_id === "wc-search-field-1"
        ? $alternate_placeholder
        : $default_placeholder;
?>
<form class="wc-search-form w-full max-w-lg inline-block relative" role="search" method="get"
  action="<?php echo esc_url(home_url("/")); ?>">
  <label class="screen-reader-text" for="<?php echo $input_id; ?>"><?php esc_html_e(
    "Search &hellip;",
    "woocommerce",
); ?></label>
  <input type="search" id="<?php echo $input_id; ?>" class="wc-search-field px-4 w-full border border-gray-300 rounded-lg relative min-h-[2.5em]"
    placeholder="<?php echo $placeholder; ?>" value="<?php echo get_search_query(); ?>" name="s" />
  <button type="submit" class="px-4 bg-transparent rounded-sm absolute top-0 right-0 min-h-[2.5em] hover:bg-action-50" value="<?php echo esc_attr_x(
      "Search",
      "submit button",
      "woocommerce",
  ); ?>" class="<?php echo esc_attr(
    wc_wp_theme_get_element_class_name("button"),
); ?>">
    <?php
    // Use a placeholder for the icon and replace it
    $icon_html = '<span class="iconify text-xl" data-icon="ri:search-line"></span>';
    $button_text = esc_html_x("%s", "submit button with icon", "woocommerce");
    printf($button_text, $icon_html);
    ?>
  </button>
  <input type="hidden" name="post_type" value="product" />
</form>