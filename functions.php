<?php
/**
 * KetoWP functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Adun Studio
 * @subpackage KetoWP
 * @since KetoWP 1.0
 */

if (!defined("ABSPATH")) {
    exit();
}

if (!function_exists("ketowp_setup")):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function ketowp_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Twenty Nineteen, use a find and replace
         * to change 'ketowp' to the name of your theme in all the template files.
         */
        load_theme_textdomain(
            "ketowp",
            get_template_directory() . "/languages",
        );

        add_theme_support("woocommerce", [
            "thumbnail_image_width" => 255,
            "single_image_width" => 720,
            "product_grid" => [
                "default_rows" => 4,
                "min_row" => 3,
                "max_row" => 20,
                "default_columns" => 3,
                "min_columns" => 1,
                "max_columns" => 5,
            ],
        ]);

        require_once get_template_directory() . "/theme-options.php";

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support("title-tag");

        // /*
        //  * Enable support for Post Thumbnails on posts and pages.
        //  *
        //  * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        //  */
        // add_theme_support("post-thumbnails");
        // set_post_thumbnail_size(1568, 9999);

        // This theme uses wp_nav_menu() in four locations.
        register_nav_menus([
            "socials" => __("Social Links", "ketowp"),
            "top-links" => __("Top Links", "ketowp"),
            "main-menu" => __("Main Menu", "ketowp"),
            "mobile-menu" => __("Mobile Menu", "ketowp"),
        ]);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support("html5", [
            "search-form",
            "comment-form",
            "comment-list",
            "gallery",
            "caption",
            "script",
            "style",
            "navigation-widgets",
        ]);

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support("custom-logo", [
            "height" => 160,
            "width" => 160,
            "flex-width" => true,
            "flex-height" => true,
        ]);
    }
endif;

add_action("after_setup_theme", "ketowp_setup", 0);

// require_once get_template_directory() . "/woo-api.php";
require_once get_template_directory() . "/inc/title.php";
require_once get_template_directory() . "/widget.php";
require_once get_template_directory() . "/woocommerce/woo.php";
require_once get_template_directory() . "/shortcodes/business.php";
require_once get_template_directory() . "/inc/cleanup.php";

/**
 * Enqueue scripts and styles.
 */
function ketowp_scripts()
{
    wp_enqueue_style(
        "ketowp",
        get_stylesheet_directory_uri() . "/assets/css/keto.min.css",
        filemtime(get_template_directory() . "/assets/css/keto.min.css"),
        "all",
    );

    wp_enqueue_style(
        "ketowp-fonts",
        get_stylesheet_directory_uri() . "/assets/fonts/fonts.css",
        filemtime(get_template_directory() . "/assets/fonts/fonts.css"),
        "all",
    );

    wp_enqueue_script(
        "alpine",
        get_template_directory_uri() . "/assets/js/alpine.js",
        [],
        "3.13.0",
        true,
    );

    wp_enqueue_script(
        "iconify",
        "https://cdnjs.cloudflare.com/ajax/libs/iconify/3.1.1/iconify.min.js",
        [],
        "3.1.1",
        true,
    );
}
add_action("wp_enqueue_scripts", "ketowp_scripts");

// Dequeue jQuery Migrate
function dequeue_jquery_migrate($scripts)
{
    if (!is_admin() && !empty($scripts->registered["jquery"])) {
        $scripts->registered["jquery"]->deps = array_diff(
            $scripts->registered["jquery"]->deps,
            ["jquery-migrate"],
        );
    }
}
add_action("wp_default_scripts", "dequeue_jquery_migrate");

if (!function_exists("wp_get_list_item_separator")):
    /**
     * Retrieves the list item separator based on the locale.
     *
     * Added for backward compatibility to support pre-6.0.0 WordPress versions.
     *
     * @since 6.0.0
     */
    function wp_get_list_item_separator()
    {
        /* translators: Used between list items, there is a space after the comma. */
        return __(", ", "ketowp");
    }
endif;

function read_time()
{
    $content = the_content();
    $word = str_word_count(strip_tags($content));
    $m = floor($word / 200);
    $est = $m . " min read" . ($m == 1 ? "" : "s");
}
