<?php
/**
 * Single Page Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Adun_Studio
 * @subpackage KetoWP
 * @since KetoWP 1.0
 */

get_header(); ?>

<main id="site-content" class="block flex-1 relative w-full">
<section class="py-8">
  <div class="container">

    <?php if (have_posts()):
        while (have_posts()):
            the_post(); ?>

    <?php if (has_post_thumbnail()): ?>
    <figure class="mb-6">
      <picture>
        <?php the_post_thumbnail(); ?>
      </picture>
    </figure>

    <div class="prose max-w-none">
      <h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>
      <div class="text-base leading-relaxed"><?php the_content(); ?></div>
    </div>

    <?php else: ?>
    <div class="prose max-w-none">
      <h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>
      <div class="text-base leading-relaxed"><?php the_content(); ?></div>
    </div>
    <?php endif; ?>
    <?php
        endwhile;
    else:
         ?>
    <p class="text-center text-gray-500">Nothing to show</p>
    <?php
    endif; ?>
  </div>
</section>

<section class="py-8">
  <div class="container">
    <div class="text-center">Categories</div>
  </div>
</section>
</main>

<?php get_footer(); ?>
