<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "keto-content" main tag.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package adun_studio
 * @subpackage KetoWP
 * @since KetoWP 1.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo("charset"); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="https://gmpg.org/xfn/11" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <a class="skip-link screen-reader-text" href="#keto-content">
    /* translators: Hidden accessibility text. */<?php _e(
        "Skip to content",
        "ketowp",
    ); ?>
  </a>
  <header id="keto-header">
    <div class="top-menu">
      <nav class="socials" aria-label="Socials">
        <ul>
          <li>
            <?php echo do_shortcode("[facebook]"); ?>
          </li>
          <li>
            <?php echo do_shortcode("[instagram]"); ?>
          </li>
          <li>
            <?php echo do_shortcode("[twitter]"); ?>
          </li>
          <li>
            <?php echo do_shortcode("[pinterest]"); ?>
          </li>
          <li>
            <?php echo do_shortcode("[youtube]"); ?>
          </li>
        </ul>
      </nav>

      <p class="notifications">
        <?php echo get_theme_mod("notification"); ?>
      </p>

      <div class="top-right">
        <div class="shortcode"><?php echo do_shortcode(
            "[adsw_currency_switcher title=]",
        ); ?>
        </div>
        <nav class="top-links" aria-label="Top Links">
          <?php wp_nav_menu([
              "menu" => "top-links",
              "menu_class" => false,
              "container" => false,
              "fallback_cb" => false,
              "theme_location" => "top-links",
          ]); ?>
        </nav>
      </div>
    </div>

    <div class="main-header">
      <?php
      $site_name = get_bloginfo("name");
      $description = get_bloginfo("description", "display");
      $home = esc_url(home_url("/"));

      if (has_custom_logo()): ?>
      <figure class="logo-wrapper">
        <picture>
          <?php the_custom_logo(); ?>
          <figcaption class="screen-reader-text">Home</figcaption>
        </picture>
      </figure>

      <?php else: ?>
      <div class="no-logo">
        <h3><?php echo $site_name; ?></h3>
        <p><?php echo $description; ?></p>
        <figcaption class="screen-reader-text">Home</figcaption>
      </div>
      <?php endif;
      ?>

      <nav class="main-menu" aria-label="Main Menu">
        <?php wp_nav_menu([
            "menu" => "main-menu",
            "menu_class" => false,
            "container" => false,
            "fallback_cb" => false,
            "theme_location" => "main-menu",
        ]); ?>
      </nav>

      <nav class="user-menu" aria-label="User Menu">
        <ul>
          <li>
            <?php get_product_search_form(); ?>
          </li>
          <li id="mini-cart">

            <a href="<?php echo esc_url(
                wc_get_cart_url(),
            ); ?>" aria-label="<?php _e("Mini Cart"); ?>" title="<?php _e(
    "Mini Cart",
); ?>">
              <span class="cart-bag">
                <span class="cart-bag__count">
                  <?php echo WC()->cart->get_cart_contents_count(); ?>
                </span>
              </span>
            </a>
            </span>
          </li>
        </ul>
      </nav>
    </div>
  </header>