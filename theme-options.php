<?php

/**
 * Add Theme Options panel to the Customizer
 */

function ketowp_theme_options($wp_customize)
{
    $wp_customize->add_section("business_details", [
        "title" => __("Business Details", "ketowp"),
        "description" => __(
            "Add all your business details here. Should you need additional fields, kindly reach out.",
            "ketowp",
        ),
        "panel" => "",
        "priority" => 21,
        "capability" => "edit_theme_options",
        "theme_supports" => "",
    ]);

    // Phone number setting
    $wp_customize->add_setting("business_phone", [
        "default" => "",
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control("business_phone", [
        "type" => "tel",
        "section" => "business_details",
        "label" => __("Business Phone Number", "ketowp"),
        "input_attrs" => [
            "placeholder" => __("e.g. 234-703-439-9169", "ketowp"),
        ],
    ]);

    // Business email address setting
    $wp_customize->add_setting("business_email", [
        "default" => "",
        "sanitize_callback" => "sanitize_email",
        "transport" => "refresh",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control("business_email", [
        "type" => "email",
        "section" => "business_details",
        "label" => __("Business Email Address", "ketowp"),
        "input_attrs" => [
            "placeholder" => __("e.g. grow@adun.studio", "ketowp"),
        ],
    ]);

    // Business address setting
    $wp_customize->add_setting("business_address", [
        "default" => "",
        "sanitize_callback" => "sanitize_textarea_field",
        "transport" => "refresh",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control("business_address", [
        "type" => "textarea",
        "section" => "business_details",
        "label" => __("Business Address", "ketowp"),
        "input_attrs" => [
            "placeholder" => __(
                "e.g. 14, Benson Adu Avenue, Igando, Lagos.",
                "ketowp",
            ),
        ],
    ]);

    // Social Links (Facebook) setting
    $wp_customize->add_setting("facebook_link", [
        "default" => "",
        "sanitize_callback" => "sanitize_url",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control("facebook_link", [
        "type" => "url",
        "section" => "business_details",
        "label" => __("Facebook Business Page", "ketowp"),
        "input_attrs" => [
            "placeholder" => __(
                "e.g. https://facebook.com/page-name",
                "ketowp",
            ),
        ],
    ]);

    // Instagram Link
    $wp_customize->add_setting("instagram_link", [
        "default" => "",
        "sanitize_callback" => "sanitize_url",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control("instagram_link", [
        "type" => "url",
        "section" => "business_details",
        "label" => __("Instagram Business Page", "ketowp"),
        "input_attrs" => [
            "placeholder" => __(
                "e.g. https://instagram.com/page-name",
                "ketowp",
            ),
        ],
    ]);

    // Twitter Link
    $wp_customize->add_setting("twitter_link", [
        "default" => "",
        "sanitize_callback" => "sanitize_url",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control("twitter_link", [
        "type" => "url",
        "section" => "business_details",
        "label" => __("Twitter Business Page", "ketowp"),
        "input_attrs" => [
            "placeholder" => __("e.g. https://twitter.com/page-name", "ketowp"),
        ],
    ]);

    // Pinterest Link
    $wp_customize->add_setting("pinterest_link", [
        "default" => "",
        "sanitize_callback" => "sanitize_url",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control("pinterest_link", [
        "type" => "url",
        "section" => "business_details",
        "label" => __("Pinterest Business Page", "ketowp"),
        "input_attrs" => [
            "placeholder" => __(
                "e.g. https://pinterest.com/page-name",
                "ketowp",
            ),
        ],
    ]);

    // YouTube Link
    $wp_customize->add_setting("youtube_link", [
        "default" => "",
        "sanitize_callback" => "sanitize_url",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control("youtube_link", [
        "type" => "url",
        "section" => "business_details",
        "label" => __("YouTube Business Page", "ketowp"),
        "input_attrs" => [
            "placeholder" => __("e.g. https://youtube.com/page-name", "ketowp"),
        ],
    ]);

    // Sitewide Notification Section (Child Panel)
    $wp_customize->add_section("notifications", [
        "title" => __("Notifications", "ketowp"),
        "description" => __(
            "Got a message for your store visitors? Input the text here and it would display across the whole website.",
            "ketowp",
        ),
        "panel" => "",
        "priority" => 22,
        "capability" => "edit_theme_options",
        "theme_supports" => "",
    ]);

    // Notification Texts
    $wp_customize->add_setting("notification", [
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
        "transport" => "refresh",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control("notification", [
        "type" => "text",
        "section" => "notifications",
        "label" => __("Notification Text", "ketowp"),
        "input_attrs" => [
            "placeholder" => __(
                "e.g. 10% off your first order! 🎉🎉",
                "ketowp",
            ),
        ],
    ]);

    // Hero Section
    $wp_customize->add_section("hero", [
        "title" => __("Hero Section", "ketowp"),
        "description" => __(
            "Customize your homepage Hero Section here.",
            "ketowp",
        ),
        "panel" => "",
        "priority" => 23,
        "capability" => "edit_theme_options",
        "theme_supports" => "",
    ]);

    // Hero Heading
    $wp_customize->add_setting("hero_heading", [
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
        "transport" => "refresh",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control("hero_heading", [
        "type" => "text",
        "section" => "hero",
        "label" => __("Hero Heading", "ketowp"),
    ]);

    // Hero Subheading
    $wp_customize->add_setting("hero_subheading", [
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
        "transport" => "refresh",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control("hero_subheading", [
        "type" => "text",
        "section" => "hero",
        "label" => __("Hero Subheading", "ketowp"),
    ]);

    // Hero Button Text
    $wp_customize->add_setting("hero_button", [
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
        "transport" => "refresh",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control("hero_button", [
        "type" => "text",
        "section" => "hero",
        "label" => __("Hero Button Text", "ketowp"),
    ]);

    // Hero Video Background
    $wp_customize->add_setting("bg_video", [
        "default" => "",
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_mime_type",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control(
        new WP_Customize_Media_Control($wp_customize, "bg_video", [
            "label" => __("Hero Background Video", "ketowp"),
            "description" => __(
                "Upload, change, or remove the Hero Background Video.",
                "ketowp",
            ),
            "section" => "hero",
            "mime_type" => "video", // Required. Can be image, audio, video, application, text
            "button_labels" => [
                // Optional
                "default" => __("Default", "ketowp"),
                "select" => __("Select File", "ketowp"),
                "change" => __("Change", "ketowp"),
                "remove" => __("Remove", "ketowp"),
                "placeholder" => __("No file selected", "ketowp"),
                "frame_title" => __("Select File", "ketowp"),
                "frame_button" => __("Choose File", "ketowp"),
            ],
        ]),
    );

    // Promotional Slides
    $wp_customize->add_section("promotions", [
        "title" => __("Promotional Slides", "ketowp"),
        "description" => __(
            "Run special promotions with beautiful slides. Upload your promotional flyers here.",
        ),
        "panel" => "",
        "priority" => 24,
        "capability" => "edit_theme_options",
        "theme_supports" => "",
    ]);

    // Promotional Slide 1
    $wp_customize->add_setting("slide-1", [
        "default" => "",
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_mime_type",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control(
        new WP_Customize_Media_Control($wp_customize, "slide-1", [
            "label" => __("Promotional Slide 1", "ketowp"),
            "description" => __(
                "Upload, change, or remove your slide image.",
                "ketowp",
            ),
            "section" => "promotions",
            "mime_type" => "image", // Required. Can be image, audio, video, application, text
            "button_labels" => [
                // Optional
                "select" => __("Select Promotional Flyer 1", "ketowp"),
                "change" => __("Change", "ketowp"),
                "default" => __("Default", "ketowp"),
                "remove" => __("Remove", "ketowp"),
                "placeholder" => __("No file selected", "ketowp"),
                "frame_title" => __("Select Flyer", "ketowp"),
                "frame_button" => __("Choose Flyer", "ketowp"),
            ],
        ]),
    );

    // Promotional Slide 2
    $wp_customize->add_setting("slide-2", [
        "default" => "",
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_mime_type",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control(
        new WP_Customize_Media_Control($wp_customize, "slide-2", [
            "label" => __("Promotional Slide 2", "ketowp"),
            "description" => __(
                "Upload, change, or remove your slide image.",
                "ketowp",
            ),
            "section" => "promotions",
            "mime_type" => "image", // Required. Can be image, audio, video, application, text
            "button_labels" => [
                // Optional
                "select" => __("Select Promotional Flyer 2", "ketowp"),
                "change" => __("Change", "ketowp"),
                "default" => __("Default", "ketowp"),
                "remove" => __("Remove", "ketowp"),
                "placeholder" => __("No file selected", "ketowp"),
                "frame_title" => __("Select Flyer", "ketowp"),
                "frame_button" => __("Choose Flyer", "ketowp"),
            ],
        ]),
    );

    // Promotional Slide 3
    $wp_customize->add_setting("slide-3", [
        "default" => "",
        "transport" => "refresh",
        "sanitize_callback" => "sanitize_mime_type",
        "type" => "theme_mod",
    ]);

    $wp_customize->add_control(
        new WP_Customize_Media_Control($wp_customize, "slide-3", [
            "label" => __("Promotional Slide 3", "ketowp"),
            "description" => __(
                "Upload, change, or remove your slide image.",
                "ketowp",
            ),
            "section" => "promotions",
            "mime_type" => "image", // Required. Can be image, audio, video, application, text
            "button_labels" => [
                // Optional
                "select" => __("Select Promotional Flyer 3", "ketowp"),
                "change" => __("Change", "ketowp"),
                "default" => __("Default", "ketowp"),
                "remove" => __("Remove", "ketowp"),
                "placeholder" => __("No file selected", "ketowp"),
                "frame_title" => __("Select Flyer", "ketowp"),
                "frame_button" => __("Choose Flyer", "ketowp"),
            ],
        ]),
    );
}
add_action("customize_register", "ketowp_theme_options");
