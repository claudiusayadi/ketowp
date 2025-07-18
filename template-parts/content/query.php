<ul class="grid grid-cols-2 md:grid-cols-3 gap-xl items-stretch" role="list" aria-label="List of posts">

  <?php if (have_posts()):
      while (have_posts()):
          the_post(); ?>

  <li role="listitem" aria-label="Post">
    <article class="keto-card bg-action-50 border-2 border-action-50 text-center hover:bg-action-100 hover:border-action-100 transition-all">
      <div class="post-card__body order-2">
        <a class="clickable-card" href="<?php the_permalink(); ?>"
          aria-label="Read more about <?php the_title_attribute(); ?>">
          <h2 class="text-xl font-bold mb-2"><?php the_title(); ?></h2>
        </a>
        <div class="post-card__meta -order-1 flex items-center gap-1 mb-2">
          <ul role="list" aria-label="Post categories">
            <?php
            $taxonomies = get_post_taxonomies();
            foreach ($taxonomies as $taxonomy) {
                $terms = get_the_terms(get_the_ID(), $taxonomy);
                if (!empty($terms)) {

                    $count = 0;
                    foreach ($terms as $term) {
                        if ($count >= 2) {
                            break;
                        } ?>
            <li data-separator="." role="listitem" aria-label="Category" class="relative z-10"><a href="<?php echo esc_url(
                get_term_link($term),
            ); ?>"><?php echo esc_html($term->name); ?></a>
            </li>
            <?php $count++;
                    }
                    ?>
          </ul>
          <?php
                }
            }
            ?>
          <time class="text-sm text-gray-600"><?php the_date(); ?></time>
        </div>
      </div>

      <figure class="post-card__head order-1">
        <picture>
          <?php the_post_thumbnail(); ?>
        </picture>
        <figcaption class="screen-reader-text"><?php the_title(); ?></figcaption>
      </figure>
    </article>
  </li>
  <?php
      endwhile;
  else:
       ?>
  <li class="col-span-full text-center text-gray-500">No posts to show</li>
  <?php
  endif; ?>
</ul>