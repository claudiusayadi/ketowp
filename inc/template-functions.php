<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package KetoWP
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ketowp_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    // Add class for WooCommerce pages
    if ( class_exists( 'WooCommerce' ) ) {
        if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
            $classes[] = 'woocommerce-page';
        }
    }

    return $classes;
}
add_filter( 'body_class', 'ketowp_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ketowp_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'ketowp_pingback_header' );

/**
 * Custom excerpt length
 */
function ketowp_excerpt_length( $length ) {
    if ( is_admin() ) {
        return $length;
    }
    return 20;
}
add_filter( 'excerpt_length', 'ketowp_excerpt_length', 999 );

/**
 * Custom excerpt more
 */
function ketowp_excerpt_more( $more ) {
    if ( is_admin() ) {
        return $more;
    }
    return '...';
}
add_filter( 'excerpt_more', 'ketowp_excerpt_more' );

/**
 * Add preconnect for Google Fonts.
 */
function ketowp_resource_hints( $urls, $relation_type ) {
    if ( wp_style_is( 'ketowp-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter( 'wp_resource_hints', 'ketowp_resource_hints', 10, 2 );

/**
 * Enqueue supplemental block editor styles.
 */
function ketowp_editor_customizer_styles() {
    wp_enqueue_style( 'ketowp-editor-customizer-styles', KETOWP_THEME_URI . '/assets/css/style-editor-customizer.css', false, KETOWP_VERSION, 'all' );

    if ( is_admin() ) {
        wp_add_inline_style( 'ketowp-editor-customizer-styles', ketowp_get_custom_css() );
    }
}
add_action( 'enqueue_block_editor_assets', 'ketowp_editor_customizer_styles' );

/**
 * Display notification bar if enabled
 */
function ketowp_notification_bar() {
    if ( get_theme_mod( 'ketowp_notification_enable', false ) ) {
        $notification_text = get_theme_mod( 'ketowp_notification_text', '' );
        if ( ! empty( $notification_text ) ) {
            echo '<div class="notification-bar bg-yellow-400 text-black text-center py-2 text-sm">';
            echo '<div class="container">';
            echo esc_html( $notification_text );
            echo '</div>';
            echo '</div>';
        }
    }
}

/**
 * Get social links
 */
function ketowp_get_social_links() {
    $social_networks = array(
        'facebook'  => array(
            'icon' => 'ri:facebook-fill',
            'label' => esc_html__( 'Facebook', 'ketowp' ),
        ),
        'twitter'   => array(
            'icon' => 'ri:twitter-fill',
            'label' => esc_html__( 'Twitter', 'ketowp' ),
        ),
        'instagram' => array(
            'icon' => 'ri:instagram-line',
            'label' => esc_html__( 'Instagram', 'ketowp' ),
        ),
        'linkedin'  => array(
            'icon' => 'ri:linkedin-fill',
            'label' => esc_html__( 'LinkedIn', 'ketowp' ),
        ),
        'youtube'   => array(
            'icon' => 'ri:youtube-fill',
            'label' => esc_html__( 'YouTube', 'ketowp' ),
        ),
        'pinterest' => array(
            'icon' => 'ri:pinterest-fill',
            'label' => esc_html__( 'Pinterest', 'ketowp' ),
        ),
    );

    $social_links = array();

    foreach ( $social_networks as $network => $data ) {
        $url = get_theme_mod( "ketowp_social_{$network}", '' );
        if ( ! empty( $url ) ) {
            $social_links[ $network ] = array(
                'url'   => esc_url( $url ),
                'icon'  => $data['icon'],
                'label' => $data['label'],
            );
        }
    }

    return $social_links;
}

/**
 * Display social links
 */
function ketowp_social_links() {
    $social_links = ketowp_get_social_links();

    if ( ! empty( $social_links ) ) {
        echo '<ul class="social-links flex gap-4">';
        foreach ( $social_links as $network => $data ) {
            printf(
                '<li><a href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s" class="text-current hover:text-blue-600 transition-colors"><span class="iconify text-xl" data-icon="%s"></span></a></li>',
                esc_url( $data['url'] ),
                esc_attr( $data['label'] ),
                esc_attr( $data['icon'] )
            );
        }
        echo '</ul>';
    }
}

/**
 * Get business contact information
 */
function ketowp_get_business_info() {
    return array(
        'phone'   => get_theme_mod( 'ketowp_business_phone', '' ),
        'email'   => get_theme_mod( 'ketowp_business_email', '' ),
        'address' => get_theme_mod( 'ketowp_business_address', '' ),
    );
}

/**
 * Display business contact information
 */
function ketowp_business_info() {
    $business_info = ketowp_get_business_info();

    if ( ! empty( $business_info['phone'] ) ) {
        printf(
            '<a href="tel:%s" class="business-phone text-current hover:text-blue-600 transition-colors">%s</a>',
            esc_attr( $business_info['phone'] ),
            esc_html( $business_info['phone'] )
        );
    }

    if ( ! empty( $business_info['email'] ) ) {
        printf(
            '<a href="mailto:%s" class="business-email text-current hover:text-blue-600 transition-colors">%s</a>',
            esc_attr( $business_info['email'] ),
            esc_html( $business_info['email'] )
        );
    }
}

/**
 * Custom logo or site title
 */
function ketowp_site_branding() {
    if ( has_custom_logo() ) {
        the_custom_logo();
    } else {
        if ( is_front_page() && is_home() ) : ?>
            <h1 class="site-title text-2xl font-bold">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="text-current no-underline">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </h1>
        <?php else : ?>
            <p class="site-title text-2xl font-bold">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="text-current no-underline">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </p>
        <?php endif;

        $ketowp_description = get_bloginfo( 'description', 'display' );
        if ( $ketowp_description || is_customize_preview() ) : ?>
            <p class="site-description text-sm text-gray-600"><?php echo $ketowp_description; ?></p>
        <?php endif;
    }
}

/**
 * Get reading time for posts
 */
function ketowp_get_reading_time( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    $content = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / 200 ); // Average reading speed: 200 words per minute

    return $reading_time;
}

/**
 * Display reading time
 */
function ketowp_reading_time( $post_id = null ) {
    $reading_time = ketowp_get_reading_time( $post_id );
    
    if ( $reading_time === 1 ) {
        printf( esc_html__( '%d min read', 'ketowp' ), $reading_time );
    } else {
        printf( esc_html__( '%d mins read', 'ketowp' ), $reading_time );
    }
}

/**
 * Check if WooCommerce is active
 */
function ketowp_is_woocommerce_activated() {
    return class_exists( 'WooCommerce' );
}

/**
 * Get featured products for homepage
 */
function ketowp_get_featured_products( $limit = 8 ) {
    if ( ! ketowp_is_woocommerce_activated() ) {
        return array();
    }

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $limit,
        'meta_query'     => array(
            array(
                'key'   => '_featured',
                'value' => 'yes',
            ),
        ),
    );

    return get_posts( $args );
}

/**
 * Get product categories for homepage
 */
function ketowp_get_product_categories( $limit = 6 ) {
    if ( ! ketowp_is_woocommerce_activated() ) {
        return array();
    }

    $args = array(
        'taxonomy'   => 'product_cat',
        'orderby'    => 'count',
        'order'      => 'DESC',
        'number'     => $limit,
        'hide_empty' => true,
        'exclude'    => array( get_option( 'default_product_cat' ) ), // Exclude uncategorized
    );

    return get_terms( $args );
}