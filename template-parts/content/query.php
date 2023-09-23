<ul class="post-query" role="list" aria-label="List of posts">

  <?php if (have_posts()):
      while (have_posts()):
          the_post(); ?>

  <li role="listitem" aria-label="Post">
    <article class="post-card keto-card">
      <div class="post-card__body">
        <a class="clickable-card" href="<?php the_permalink(); ?>"
          aria-label="Read more about <?php the_title_attribute(); ?>">
          <h2 class="clickable-card"><?php the_title(); ?></h2>
        </a>
        <div class="post-card__meta">
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
            <li data-separator="." role="listitem" aria-label="Category"><a href="<?php echo esc_url(
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
          <time><?php the_date(); ?></time>
        </div>
      </div>

      <figure class="post-card__head">
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
  <p>No posts to show</p>
  <?php
  endif; ?>
</ul>