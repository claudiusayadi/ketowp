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


<main id="keto-content">

  <section class="hero">
    <div class="container">
      <?php include_once get_template_directory() . "/template-home.php"; ?>
    </div>
  </section>

  <section class="category">
    <div class="container">Categories</div>
  </section>
</main>
<?php get_footer(); ?>
