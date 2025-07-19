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
<main id="primary" class="site-main">

  <section class="py-8">
    <div class="container">
      <?php get_template_part( 'template-parts/content/query' ); ?>
    </div>
  </section>

</main>
<?php get_footer(); ?>
