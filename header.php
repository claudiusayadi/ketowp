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
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="https://gmpg.org/xfn/11" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <a class="skip-link screen-reader-text" href="#keto-content">
    <?php
		/* translators: Hidden accessibility text. */
		_e( 'Skip to content', 'ketowp' );
		?>
  </a>
  <header id="keto-header">
    <?php
    $site_name = get_bloginfo('name');
    $description = get_bloginfo( 'description', 'display' );
    $home = esc_url(home_url('/'));

    if ( has_custom_logo() ) : ?>
    <figure class="logo-wrapper">
      <picture>
        <?php the_custom_logo(); ?>
        <figcaption class="screen-reader-text">Home</figcaption>
      </picture>
    </figure>
    <?php endif; ?>
  </header>

  <main id="keto-content">