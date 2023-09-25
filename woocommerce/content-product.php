<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined("ABSPATH") || exit();

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class("keto-card product-card", $product); ?>>
  <div class="product-card__body">
    <h3 class="product-card__title">
      <a class="clickable-card" href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </h3>

    <?php // Get average rating

$average_rating = number_format($product->get_average_rating(), 1); ?>

    <?php // Get sold and round

$sold = $product->get_stock_quantity(); ?>
    <?php if ($sold >= 1000) {
        $sold_display = number_format($sold / 1000, 1) . "k+";
    } else {
        $sold_display = number_format($sold);
    } ?>

    <div class="rating">
      <span>
        <?php echo $sold_display; ?> sold
      </span>
      <?php if ($average_rating != 0) { ?>
      <span>
        <span class="iconify" data-icon="ri:star-fill">
        </span>
        <?php echo $average_rating; ?>
      </span>
      <?php } ?>
    </div>

    <?php
// Get price and savings percentage?
?>
    <?php $price = $product->get_price_html(); ?>
    <?php $regular_price = $product->get_regular_price(); ?>
    <?php $sale_price = $product->get_sale_price(); ?>

    <div class="price">
      <span class="adsw_price_code">
        <?php echo $price; ?>
      </span>
    </div>

    <?php if ($regular_price && $sale_price): ?>
    <?php $savings_percentage = round(
        (($regular_price - $sale_price) / $regular_price) * 100,
    ); ?>

    <span class="savings">
      Save <?php echo $savings_percentage . "%"; ?>
    </span>

    <?php endif; ?>

    <div class="delivery">
      <?php $current_date = date("D, M j"); ?>
      <?php $delivery_date = date(
          "D, M j",
          strtotime($current_date . " + " . rand(10, 15) . " days"),
      ); ?>
      <span>Delivery:</span>
      <span>
        <?php echo $delivery_date; ?>
      </span>
    </div>

    <?php
    require_once get_template_directory() . "/inc/geolocate.php";
    echo do_shortcode("[geolocate]");
    ?>


  </div>

  <figure class="product-card__head">
    <picture>
      <?php the_post_thumbnail("medium", [
          "alt" => the_title_attribute("echo", false),
      ]); ?>
    </picture>
    <figcaption class="screen-reader-text"><?php the_title(); ?></figcaption>
  </figure>
</li>