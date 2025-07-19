<?php
/**
 * SEO Enhancements
 */

if (!defined('ABSPATH')) {
    exit;
}

// Add Open Graph meta tags
function ketowp_add_og_meta() {
    if (is_singular()) {
        global $post;
        
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr(wp_trim_words(get_the_excerpt(), 20)) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
        
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<meta property="og:image" content="' . esc_url($image[0]) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'ketowp_add_og_meta');

// Add Twitter Card meta tags
function ketowp_add_twitter_meta() {
    if (is_singular()) {
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr(wp_trim_words(get_the_excerpt(), 20)) . '">' . "\n";
        
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<meta name="twitter:image" content="' . esc_url($image[0]) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'ketowp_add_twitter_meta');

// Improve title tags
function ketowp_custom_title($title) {
    if (is_front_page()) {
        return get_bloginfo('name') . ' - ' . get_bloginfo('description');
    } elseif (is_single() || is_page()) {
        return get_the_title() . ' - ' . get_bloginfo('name');
    } elseif (is_category()) {
        return 'Category: ' . single_cat_title('', false) . ' - ' . get_bloginfo('name');
    } elseif (is_tag()) {
        return 'Tag: ' . single_tag_title('', false) . ' - ' . get_bloginfo('name');
    }
    return $title;
}
add_filter('pre_get_document_title', 'ketowp_custom_title');

// Add canonical URLs
function ketowp_add_canonical() {
    if (is_singular()) {
        echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '">' . "\n";
    }
}
add_action('wp_head', 'ketowp_add_canonical');

// Add meta description
function ketowp_add_meta_description() {
    if (is_singular()) {
        $description = wp_trim_words(get_the_excerpt(), 25);
        if ($description) {
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        }
    } elseif (is_front_page()) {
        echo '<meta name="description" content="' . esc_attr(get_bloginfo('description')) . '">' . "\n";
    }
}
add_action('wp_head', 'ketowp_add_meta_description');