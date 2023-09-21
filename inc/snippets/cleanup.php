<?php

if (!defined("ABSPATH")) {
	exit();
}

// Remove WP Version

add_filter("the_generator", function () {
	return "";
});

// Remove the WordPress generator tag.
remove_action("wp_head", "wp_generator");

// Remove RSD link.
remove_action("wp_head", "rsd_link");

// Remove RSS feed links.
remove_action("wp_head", "feed_links", 2);
remove_action("wp_head", "feed_links_extra", 3);

// Remove the link to the Windows Live Writer manifest file.
remove_action("wp_head", "wlwmanifest_link");

// Remove index, alternate, and post links
remove_action("wp_head", "index_rel_link");
remove_action("wp_head", "rel_alternate");
remove_action("wp_head", "start_post_rel_link", 10, 0);
remove_action("wp_head", "parent_post_rel_link", 10, 0);
remove_action("wp_head", "adjacent_posts_rel_link", 10, 0);
remove_action("wp_head", "adjacent_posts_rel_link_wp_head", 10, 0);

// Removes the WordPress shortlink for post.
remove_action("wp_head", "wp_shortlink_wp_head", 10, 0);

// Remove emoji detection scripts.
remove_action("wp_head", "print_emoji_detection_script", 7);
remove_action("wp_print_styles", "print_emoji_styles");

// Remove WordPress version (Admin Footer)
remove_filter("update_footer", "core_update_footer");

//  Disable XMLRPC
add_filter("xmlrpc_enabled", "__return_false");

// Disable self-pingbacks
function stop_self_ping(&$links)
{
	$home = get_option("home");
	foreach ($links as $l => $link) {
		if (0 === strpos($link, $home)) {
			unset($links[$l]);
		}
	}
}

add_action("pre_ping", "stop_self_ping");

// Remove Global CSS
remove_action("wp_enqueue_scripts", "wp_enqueue_global_styles");
remove_action("wp_body_open", "wp_global_styles_render_svg_filters");

// Hide Admin Bar for Non-admins
function hide_admin_bar()
{
	if (!current_user_can("administrator")) {
		show_admin_bar(false);
	}
}

add_action("init", "hide_admin_bar", 9);

// Disable Theme & Plugin Edit
define("DISALLOW_FILE_EDIT", true);

// Remove WooCommerce default styles
add_filter("woocommerce_enqueue_styles", "__return_empty_array");
