<?php
/**
 * Custom template tags for this theme
 *
 * @package KetoWP
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'ketowp_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function ketowp_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x( 'Posted on %s', 'post date', 'ketowp' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on text-sm text-gray-600">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if ( ! function_exists( 'ketowp_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function ketowp_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x( 'by %s', 'post author', 'ketowp' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline text-sm text-gray-600"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if ( ! function_exists( 'ketowp_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function ketowp_entry_footer() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', 'ketowp' ) );
            if ( $categories_list ) {
                /* translators: 1: list of categories. */
                printf( '<span class="cat-links text-sm text-gray-600">' . esc_html__( 'Posted in %1$s', 'ketowp' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'ketowp' ) );
            if ( $tags_list ) {
                /* translators: 1: list of tags. */
                printf( '<span class="tags-links text-sm text-gray-600">' . esc_html__( 'Tagged %1$s', 'ketowp' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link text-sm text-gray-600">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'ketowp' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Edit <span class="screen-reader-text">%s</span>', 'ketowp' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post( get_the_title() )
            ),
            '<span class="edit-link text-sm text-gray-600">',
            '</span>'
        );
    }
endif;

if ( ! function_exists( 'ketowp_post_thumbnail' ) ) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function ketowp_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        if ( is_singular() ) :
            ?>
            <div class="post-thumbnail mb-6">
                <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto rounded-lg' ) ); ?>
            </div><!-- .post-thumbnail -->
        <?php else : ?>
            <a class="post-thumbnail block mb-4" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'ketowp-featured',
                    array(
                        'alt' => the_title_attribute(
                            array(
                                'echo' => false,
                            )
                        ),
                        'class' => 'w-full h-48 object-cover rounded-lg',
                    )
                );
                ?>
            </a>
        <?php
        endif; // End is_singular().
    }
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
    /**
     * Shim for sites older than 5.2.
     *
     * @link https://core.trac.wordpress.org/ticket/12563
     */
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
endif;

if ( ! function_exists( 'ketowp_comment' ) ) :
    /**
     * Template for comments and pingbacks.
     */
    function ketowp_comment( $comment, $args, $depth ) {
        if ( 'pingback' === $comment->comment_type || 'trackback' === $comment->comment_type ) : ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'p-4 border-l-4 border-gray-300' ); ?>>
            <div class="comment-body">
                <?php esc_html_e( 'Pingback:', 'ketowp' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'ketowp' ), '<span class="edit-link">', '</span>' ); ?>
            </div>

        <?php else : ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? 'p-4 border border-gray-200 rounded-lg mb-4' : 'parent p-4 border border-gray-200 rounded-lg mb-4' ); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                <footer class="comment-meta flex items-center mb-4">
                    <div class="comment-author vcard flex items-center">
                        <?php if ( 0 !== $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'w-10 h-10 rounded-full mr-3' ) ); ?>
                        <?php
                        $comment_author = get_comment_author_link( $comment );
                        if ( '0' === $comment->comment_approved ) : ?>
                            <em class="comment-awaiting-moderation text-yellow-600"><?php esc_html_e( 'Your comment is awaiting moderation.', 'ketowp' ); ?></em>
                            <br />
                        <?php endif; ?>
                        <b class="fn"><?php echo $comment_author; ?></b>
                    </div><!-- .comment-author -->

                    <div class="comment-metadata ml-auto text-sm text-gray-600">
                        <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                            <time datetime="<?php comment_time( 'c' ); ?>">
                                <?php
                                /* translators: 1: comment date, 2: comment time */
                                printf( esc_html__( '%1$s at %2$s', 'ketowp' ), get_comment_date( '', $comment ), get_comment_time() );
                                ?>
                            </time>
                        </a>
                        <?php edit_comment_link( esc_html__( 'Edit', 'ketowp' ), '<span class="edit-link ml-2">', '</span>' ); ?>
                    </div><!-- .comment-metadata -->
                </footer><!-- .comment-meta -->

                <div class="comment-content prose max-w-none">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->

                <?php
                comment_reply_link(
                    array_merge(
                        $args,
                        array(
                            'add_below' => 'div-comment',
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth'],
                            'before'    => '<div class="reply mt-4">',
                            'after'     => '</div>',
                            'class'     => 'inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors',
                        )
                    )
                );
                ?>
            </article><!-- .comment-body -->

        <?php
        endif;
    }
endif; // ends check for ketowp_comment()

if ( ! function_exists( 'ketowp_the_posts_navigation' ) ) :
    /**
     * Display navigation to next/previous set of posts when applicable.
     */
    function ketowp_the_posts_navigation() {
        the_posts_pagination(
            array(
                'mid_size'  => 1,
                'prev_text' => sprintf(
                    '%s <span class="nav-prev-text">%s</span>',
                    '<span class="iconify" data-icon="ri:arrow-left-line"></span>',
                    esc_html__( 'Newer posts', 'ketowp' )
                ),
                'next_text' => sprintf(
                    '<span class="nav-next-text">%s</span> %s',
                    esc_html__( 'Older posts', 'ketowp' ),
                    '<span class="iconify" data-icon="ri:arrow-right-line"></span>'
                ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'ketowp' ) . ' </span>',
            )
        );
    }
endif;