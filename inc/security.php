<?php
/**
 * Security Enhancements
 */

if (!defined('ABSPATH')) {
    exit;
}

// Hide WordPress version
function ketowp_remove_version() {
    return '';
}
add_filter('the_generator', 'ketowp_remove_version');

// Disable file editing
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

// Remove WordPress version from RSS feeds
function ketowp_remove_wp_version_rss() {
    return '';
}
add_filter('the_generator', 'ketowp_remove_wp_version_rss');

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Remove RSD link
remove_action('wp_head', 'rsd_link');

// Remove Windows Live Writer link
remove_action('wp_head', 'wlwmanifest_link');

// Disable pingbacks
function ketowp_disable_pingback(&$links) {
    foreach($links as $l => $link) {
        if (0 === strpos($link, get_option('home'))) {
            unset($links[$l]);
        }
    }
}
add_action('pre_ping', 'ketowp_disable_pingback');

// Add security headers
function ketowp_add_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
}
add_action('send_headers', 'ketowp_add_security_headers');

// Limit login attempts (basic implementation)
function ketowp_limit_login_attempts() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $attempts = get_transient('login_attempts_' . $ip);
    
    if ($attempts && $attempts >= 5) {
        wp_die('Too many login attempts. Please try again later.');
    }
}
add_action('wp_login_failed', function() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $attempts = get_transient('login_attempts_' . $ip) ?: 0;
    set_transient('login_attempts_' . $ip, $attempts + 1, 15 * MINUTE_IN_SECONDS);
});

// Clear attempts on successful login
add_action('wp_login', function() {
    $ip = $_SERVER['REMOTE_ADDR'];
    delete_transient('login_attempts_' . $ip);
});