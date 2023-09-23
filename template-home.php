<?php
/**
 * Template Name: Home Page
 * The front page template file
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
