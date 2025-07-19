<?php
/**
 * KetoWP functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KetoWP
 * @subpackage KetoWP
 * @since KetoWP 1.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define theme constants
define( 'KETOWP_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'KETOWP_THEME_DIR', get_template_directory() );
define( 'KETOWP_THEME_URI', get_template_directory_uri() );

/**
 * KetoWP Theme Setup
 */
if ( ! function_exists( 'ketowp_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function ketowp_setup() {
        // Make theme available for translation
        load_theme_textdomain( 'ketowp', KETOWP_THEME_DIR . '/languages' );

        // Add default posts and comments RSS feed links to head
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages
        add_theme_support( 'post-thumbnails' );

        // Set default thumbnail size
        set_post_thumbnail_size( 300, 300, true );

        // Add additional image sizes
        add_image_size( 'ketowp-hero', 1920, 800, true );
        add_image_size( 'ketowp-featured', 600, 400, true );
        add_image_size( 'ketowp-thumbnail', 150, 150, true );

        // Register navigation menus
        register_nav_menus( array(
            'primary'    => esc_html__( 'Primary Menu', 'ketowp' ),
            'secondary'  => esc_html__( 'Secondary Menu', 'ketowp' ),
            'footer'     => esc_html__( 'Footer Menu', 'ketowp' ),
            'social'     => esc_html__( 'Social Links', 'ketowp' ),
        ) );

        // Switch default core markup for search form, comment form, and comments
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ) );

        // Add theme support for selective refresh for widgets
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Add support for core custom logo
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );

        // Add support for custom header
        add_theme_support( 'custom-header', array(
            'default-image'      => '',
            'default-text-color' => '000000',
            'width'              => 1920,
            'height'             => 800,
            'flex-width'         => true,
            'flex-height'        => true,
        ) );

        // Add support for custom background
        add_theme_support( 'custom-background', array(
            'default-color' => 'ffffff',
        ) );

        // Add support for editor styles
        add_theme_support( 'editor-styles' );
        add_editor_style( 'assets/css/editor-style.css' );

        // Add support for responsive embeds
        add_theme_support( 'responsive-embeds' );

        // Add support for WooCommerce
        add_theme_support( 'woocommerce', array(
            'thumbnail_image_width' => 300,
            'single_image_width'    => 600,
            'product_grid'          => array(
                'default_rows'    => 4,
                'min_rows'        => 2,
                'max_rows'        => 8,
                'default_columns' => 3,
                'min_columns'     => 1,
                'max_columns'     => 6,
            ),
        ) );

        // Add WooCommerce features
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
endif;
add_action( 'after_setup_theme', 'ketowp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function ketowp_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'ketowp_content_width', 1200 );
}
add_action( 'after_setup_theme', 'ketowp_content_width', 0 );

/**
 * Register widget areas
 */
function ketowp_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Primary Sidebar', 'ketowp' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'ketowp' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Shop Sidebar', 'ketowp' ),
        'id'            => 'sidebar-shop',
        'description'   => esc_html__( 'Add shop widgets here.', 'ketowp' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 1', 'ketowp' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add footer widgets here.', 'ketowp' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 2', 'ketowp' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add footer widgets here.', 'ketowp' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 3', 'ketowp' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add footer widgets here.', 'ketowp' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 4', 'ketowp' ),
        'id'            => 'footer-4',
        'description'   => esc_html__( 'Add footer widgets here.', 'ketowp' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'ketowp_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function ketowp_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style( 
        'ketowp-style', 
        KETOWP_THEME_URI . '/assets/css/style.css', 
        array(), 
        KETOWP_VERSION 
    );

    // Enqueue fonts
    wp_enqueue_style( 
        'ketowp-fonts', 
        KETOWP_THEME_URI . '/assets/fonts/fonts.css', 
        array(), 
        KETOWP_VERSION 
    );

    // Enqueue Alpine.js
    wp_enqueue_script( 
        'ketowp-alpine', 
        KETOWP_THEME_URI . '/assets/js/alpine.js', 
        array(), 
        '3.13.0', 
        true 
    );

    // Enqueue Iconify
    wp_enqueue_script( 
        'ketowp-iconify', 
        'https://code.iconify.design/3/3.1.1/iconify.min.js', 
        array(), 
        '3.1.1', 
        true 
    );

    // Enqueue comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Add inline styles for customizer options
    $custom_css = ketowp_get_custom_css();
    if ( $custom_css ) {
        wp_add_inline_style( 'ketowp-style', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'ketowp_scripts' );

/**
 * Generate custom CSS from theme options
 */
function ketowp_get_custom_css() {
    $css = '';
    
    // Primary color
    $primary_color = get_theme_mod( 'ketowp_primary_color', '#f9d400' );
    if ( $primary_color !== '#f9d400' ) {
        $css .= ':root { --color-primary: ' . esc_attr( $primary_color ) . '; }';
    }
    
    // Secondary color
    $secondary_color = get_theme_mod( 'ketowp_secondary_color', '#e44650' );
    if ( $secondary_color !== '#e44650' ) {
        $css .= ':root { --color-secondary: ' . esc_attr( $secondary_color ) . '; }';
    }
    
    // Accent color
    $accent_color = get_theme_mod( 'ketowp_accent_color', '#004aad' );
    if ( $accent_color !== '#004aad' ) {
        $css .= ':root { --color-accent: ' . esc_attr( $accent_color ) . '; }';
    }
    
    return $css;
}

/**
 * Include required files
 */
require_once KETOWP_THEME_DIR . '/inc/customizer.php';
require_once KETOWP_THEME_DIR . '/inc/template-functions.php';
require_once KETOWP_THEME_DIR . '/inc/template-tags.php';
require_once KETOWP_THEME_DIR . '/inc/woocommerce.php';
require_once KETOWP_THEME_DIR . '/inc/performance.php';
require_once KETOWP_THEME_DIR . '/inc/security.php';
require_once KETOWP_THEME_DIR . '/inc/seo.php';

// Legacy includes (to be refactored)
require_once KETOWP_THEME_DIR . '/inc/title.php';
require_once KETOWP_THEME_DIR . '/inc/cleanup.php';
require_once KETOWP_THEME_DIR . '/inc/ajax-mini.php';
require_once KETOWP_THEME_DIR . '/shortcodes/business.php';

/**
 * Add editor styles
 */
function ketowp_add_editor_styles() {
    add_editor_style( 'assets/css/editor-style.css' );
}
add_action( 'admin_init', 'ketowp_add_editor_styles' );

/**
 * Improve WordPress defaults
 */
function ketowp_improve_defaults() {
    // Remove unnecessary WordPress features
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'rsd_link' );
    
    // Disable WordPress embeds
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    
    // Remove WordPress version from scripts and styles
    add_filter( 'style_loader_src', 'ketowp_remove_version_scripts_styles', 9999 );
    add_filter( 'script_loader_src', 'ketowp_remove_version_scripts_styles', 9999 );
}
add_action( 'init', 'ketowp_improve_defaults' );

/**
 * Remove version from scripts and styles
 */
function ketowp_remove_version_scripts_styles( $src ) {
    if ( strpos( $src, 'ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}

/**
 * Add structured data for SEO
 */
function ketowp_structured_data() {
    if ( is_front_page() ) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => get_bloginfo( 'name' ),
            'description' => get_bloginfo( 'description' ),
            'url' => home_url(),
            'potentialAction' => array(
                '@type' => 'SearchAction',
                'target' => home_url( '/?s={search_term_string}' ),
                'query-input' => 'required name=search_term_string'
            )
        );
        echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>';
    }
}
add_action( 'wp_head', 'ketowp_structured_data' );

/**
 * Dequeue jQuery Migrate
 */
function ketowp_dequeue_jquery_migrate( $scripts ) {
    if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
        $scripts->registered['jquery']->deps = array_diff(
            $scripts->registered['jquery']->deps,
            array( 'jquery-migrate' )
        );
    }
}
add_action( 'wp_default_scripts', 'ketowp_dequeue_jquery_migrate' );

/**
 * Backward compatibility function
 */
if ( ! function_exists( 'wp_get_list_item_separator' ) ) :
    /**
     * Retrieves the list item separator based on the locale.
     *
     * @since 6.0.0
     */
    function wp_get_list_item_separator() {
        /* translators: Used between list items, there is a space after the comma. */
        return __( ', ', 'ketowp' );
    }
endif;