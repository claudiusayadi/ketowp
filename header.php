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
    <div class="bg-alt/60 text-action-800 hidden md:block">
      <div class="container">
        <div class="grid grid-cols-3 items-center gap-m py-2 text-sm min-h-[3.7rem]">
          <nav class="socials" aria-label="Socials">
            <ul class="flex gap-2">
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

          <p class="notifications justify-self-center">
            <?php echo get_theme_mod("notification"); ?>
          </p>

          <div class="top-right justify-self-end flex gap-m">
            <div class="shortcode max-w-fit"><?php echo do_shortcode(
                "[adsw_currency_switcher title=]",
            ); ?>
            </div>
            <nav class="top-links" aria-label="Top Links">
              <?php wp_nav_menu([
                  "menu" => "top-links",
                  "menu_class" => "flex gap-m",
                  "container" => false,
                  "fallback_cb" => false,
                  "theme_location" => "top-links",
              ]); ?>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="main-header">
      <div class="container">
        <div class="grid grid-cols-2 md:grid-cols-3 items-center gap-m py-4">
          <?php
          $site_name = get_bloginfo("name");
          $description = get_bloginfo("description", "display");
          $home = esc_url(home_url("/"));

          if (has_custom_logo()): ?>
          <figure class="logo-wrapper max-w-48 overflow-hidden">
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

          <nav class="main-menu hidden md:block justify-self-center" aria-label="Main Menu">
            <?php wp_nav_menu([
                "menu" => "main-menu",
                "menu_class" => "flex items-center gap-xl p-0 m-0",
                "container" => false,
                "fallback_cb" => false,
                "theme_location" => "main-menu",
            ]); ?>
          </nav>

          <nav class="user-menu hidden md:block justify-self-end" aria-label="User Menu">
            <ul class="flex items-center gap-m">
              <li>
                <?php get_product_search_form(); ?>
              </li>
              <li id="mini-cart">
                <a href="<?php echo esc_url(
                    wc_get_cart_url(),
                ); ?>" aria-label="<?php _e("Mini Cart"); ?>" title="<?php _e(
    "Mini Cart",
); ?>" class="relative">
                  <span class="cart-bag">
                    <strong class="relative inline-block border-2 border-action rounded-xs font-bold font-sans text-center align-middle w-7 h-7 leading-6 after:absolute after:left-1/2 after:bottom-full after:content-[''] after:h-2 after:w-4 after:mb-0 after:-ml-2 after:border-2 after:border-action after:rounded-full after:border-b-0 after:border-b-transparent after:pointer-events-none after:transition-all hover:bg-action hover:text-white hover:after:h-4">
                      <span class="cart-bag__count">
                        <?php echo WC()->cart->get_cart_contents_count(); ?>
                      </span>
                    </strong>
                  </span>
                </a>
              </li>
            </ul>
          </nav>

          <!-- Mobile menu button (you can add mobile menu functionality here) -->
          <div class="md:hidden justify-self-end">
            <button class="p-2" aria-label="Open mobile menu">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </header>

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