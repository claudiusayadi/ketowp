<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Adun_Studio
 * @subpackage KetoWP
 * @since KetoWP 1.0
 */

get_header(); ?>

<section class="hero">
  <div class="container"><?php get_template_part(
      "/template-part/content/query",
  ); ?>
  </div>
</section>

<section class="category">
  <div class="container">Categories</div>
</section>

<?php get_footer(); ?>
