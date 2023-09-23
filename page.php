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

<section class="page-title">
  <div class="container">

    <?php if (have_posts()):
        while (have_posts()):
            the_post(); ?>

    <?php if (has_post_thumbnail()): ?>
    <figure>
      <picture>
        <?php the_post_thumbnail(); ?>
      </picture>
    </figure>

    <div>
      <h2><?php the_title(); ?></h2>
      <p><?php the_content(); ?></p>
    </div>

    <?php else: ?>
    <h2><?php the_title(); ?></h2>
    <p><?php the_content(); ?></p>
    <?php endif; ?>
    </article>
    <?php
        endwhile;
    else:
         ?>
    <p>Nothing to show</p>
    <?php
    endif; ?>
  </div>
</section>

<section class="category">
  <div class="container">Categories</div>
</section>

<?php get_footer(); ?>
