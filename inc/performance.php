<?php
/**
 * Performance Optimizations
 */

if (!defined('ABSPATH')) {
    exit;
}

// Lazy load images
function ketowp_add_lazy_loading($content) {
    if (is_admin() || is_feed() || is_preview()) {
        return $content;
    }
    
    $content = preg_replace('/<img(.*?)src=/i', '<img$1loading="lazy" src=', $content);
    return $content;
}
add_filter('the_content', 'ketowp_add_lazy_loading');
add_filter('post_thumbnail_html', 'ketowp_add_lazy_loading');

// Preload critical resources
function ketowp_preload_resources() {
    // Preload fonts
    echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/fonts/inter-400.woff2" as="font" type="font/woff2" crossorigin>';
    echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/fonts/inter-700.woff2" as="font" type="font/woff2" crossorigin>';
    
    // Preload critical CSS
    echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/css/style.css" as="style">';
}
add_action('wp_head', 'ketowp_preload_resources', 1);

// Optimize database queries
function ketowp_optimize_queries() {
    // Remove unnecessary queries
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);
    
    // Limit post revisions
    if (!defined('WP_POST_REVISIONS')) {
        define('WP_POST_REVISIONS', 3);
    }
}
add_action('init', 'ketowp_optimize_queries');

// Add cache headers
function ketowp_add_cache_headers() {
    if (!is_admin()) {
        header('Cache-Control: public, max-age=3600');
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
    }
}
add_action('send_headers', 'ketowp_add_cache_headers');

// Optimize WooCommerce
function ketowp_optimize_woocommerce() {
    if (class_exists('WooCommerce')) {
        // Remove WooCommerce scripts on non-shop pages
        if (!is_woocommerce() && !is_cart() && !is_checkout() && !is_account_page()) {
            wp_dequeue_style('woocommerce-general');
            wp_dequeue_style('woocommerce-layout');
            wp_dequeue_style('woocommerce-smallscreen');
            wp_dequeue_script('wc-cart-fragments');
            wp_dequeue_script('woocommerce');
        }
    }
}
add_action('wp_enqueue_scripts', 'ketowp_optimize_woocommerce', 99);