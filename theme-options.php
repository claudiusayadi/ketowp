<?php

/**
 * Add Theme Options panel to the Customizer
 */
function ketowp_theme_options($wp_customize)
{
    // Add a new panel for Theme Options
    $wp_customize->add_panel("theme_options_panel", [
        "title" => __("Theme Options", "ketowp"),
        "priority" => 30,
    ]);

    // Add a description paragraph
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            "business_details_description",
            [
                "label" => __("Business Details Description", "ketowp"),
                "section" => "business_details_section",
                "settings" => [],
                "description" => __(
                    "Add/Edit all your business details here.",
                    "ketowp",
                ),
            ],
        ),
    );

    // Add Business Details section as a child panel
    $wp_customize->add_section("business_details_section", [
        "title" => __("Business Details", "ketowp"),
        "panel" => "theme_options_panel", // Set the parent panel
    ]);

    // Add phone number setting
    $wp_customize->add_setting("business_phone", [
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
    ]);

    $wp_customize->add_control("business_phone", [
        "label" => __("Phone Number", "ketowp"),
        "section" => "business_details_section",
        "type" => "text",
    ]);

    // Add email address setting
    $wp_customize->add_setting("business_email", [
        "default" => "",
        "sanitize_callback" => "sanitize_email",
    ]);

    $wp_customize->add_control("business_email", [
        "label" => __("Email Address", "ketowp"),
        "section" => "business_details_section",
        "type" => "email",
    ]);

    // Add business address setting
    $wp_customize->add_setting("business_address", [
        "default" => "",
        "sanitize_callback" => "sanitize_textarea_field",
    ]);

    $wp_customize->add_control("business_address", [
        "label" => __("Business Address", "ketowp"),
        "section" => "business_details_section",
        "type" => "textarea",
    ]);
}
add_action("customize_register", "ketowp_theme_options");
