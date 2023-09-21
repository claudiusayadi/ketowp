<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Adun_Studio
 * @subpackage KetoWP
 * @since KetoWP 1.0
 */

get_header(); ?>

<main id="content">
  <section class="not-found">
    <div class="container">
      <h1 class="page-title"><?php _e(
          "Oops! That page can&rsquo;t be found.",
          "ketowp",
      ); ?></h1>

      <div class="page-content">
        <p>
          <?php _e(
              "It looks like nothing was found at this location. Maybe try a search?",
              "ketowp",
          ); ?>
        </p>
        <?php get_search_form(); ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer();
