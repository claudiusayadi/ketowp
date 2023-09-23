<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Adun_Studio
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
            <a href="">
              <span class="iconify" data-icon="ri:facebook-fill"></span>
            </a>
          </li>
          <li>
            <a href="">
              <span class="iconify" data-icon="ri:instagram-line"></span>
            </a>
          </li>
          <li>
            <a href="">
              <span class="iconify" data-icon="ri:twitter-line"></span>
            </a>
          </li>
          <li>
            <a href="">
              <span class="iconify" data-icon="ri:pinterest-line"></span>
            </a>
          </li>
          <li>
            <a href="">
              <span class="iconify" data-icon="ri:youtube-line"></span>
            </a>
          </li>
        </ul>
      </nav>

      <p class="notifications">NOTIFICATIONS</p>

      <div class="top-right">
        <div class="shortcode">Currency</div>
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
          <li>Mini Cart</li>
        </ul>
      </nav>
    </div>
  </header>