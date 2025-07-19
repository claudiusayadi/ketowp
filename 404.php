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

<main id="primary" class="site-main">
  <section class="py-16">
    <div class="container">
      <div class="text-center max-w-2xl mx-auto">
        <h1 class="text-4xl font-bold mb-6"><?php _e(
          "Oops! That page can&rsquo;t be found.",
          "ketowp",
      ); ?></h1>

        <div>
          <p class="text-lg mb-8">
          <?php _e(
              "It looks like nothing was found at this location. Maybe try a search?",
              "ketowp",
          ); ?>
          </p>
          <div class="max-w-md mx-auto">
            <?php get_search_form(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer();
