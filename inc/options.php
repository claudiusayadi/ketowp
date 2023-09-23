<?php

if (!defined("ABSPATH")) {
	exit();
}

if (function_exists("acf_add_options_page")) {
	acf_add_options_page([
		"page_title" => "Site Owner General Settings",
		"menu_title" => "Owner Settings",
		"menu_slug" => "owner-settings",
		"capability" => "edit_posts",
	]);

	acf_add_options_sub_page([
		"page_title" => "Company Details",
		"menu_title" => "Company Details",
		"parent_slug" => "owner-settings",
	]);

	acf_add_options_sub_page([
		"page_title" => "Notifications",
		"menu_title" => "Notifications",
		"parent_slug" => "owner-settings",
	]);

	acf_add_options_sub_page([
		"page_title" => "Hero Texts",
		"menu_title" => "Hero Texts",
		"parent_slug" => "owner-settings",
	]);
}

function options_field($field_name)
{
	return get_field($field_name, "option");
}
