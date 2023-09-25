<?php

// Shortcode for Business Phone
function business_phone_shortcode()
{
    $phone = get_theme_mod("business_phone");
    return esc_url("mailto:" . $phone);
}
add_shortcode("phone", "business_phone_shortcode");

// Shortcode for Business Email
function business_email_shortcode()
{
    $email = get_theme_mod("business_email");
    return esc_url("mailto:" . $email);
}
add_shortcode("email", "business_email_shortcode");

// Shortcode for Business Address
function business_address_shortcode()
{
    $address = get_theme_mod("business_address");
    return esc_html("<address>" . $address . "</address>");
}
add_shortcode("address", "business_address_shortcode");

// Shortcode for Business Facebook
function business_facebook_shortcode()
{
    $facebook = get_theme_mod("facebook_link");
    if ($facebook) {
        $output =
            '<a href="' .
            esc_url($facebook) .
            '" aria-label="Follow us on Facebook" title="Follow us on Facebook" target="_blank" rel="noopener noreferrer"><span class="iconify" data-icon="ri:facebook-fill"></span></a>';
        return $output;
    }
    return "";
}
add_shortcode("facebook", "business_facebook_shortcode");

// Shortcode for Business Instagram
function business_instagram_shortcode()
{
    $instagram = get_theme_mod("instagram_link");
    if ($instagram) {
        $output =
            '<a href="' .
            esc_url($instagram) .
            '" aria-label="Follow us on Instagram" title="Follow us on Instagram" target="_blank" rel="noopener noreferrer"><span class="iconify" data-icon="ri:instagram-line"></span></a>';
        return $output;
    }
    return "";
}
add_shortcode("instagram", "business_instagram_shortcode");

// Shortcode for Business Twitter
function business_twitter_shortcode()
{
    $twitter = get_theme_mod("twitter_link");
    if ($twitter) {
        $output =
            '<a href="' .
            esc_url($twitter) .
            '" aria-label="Follow us on Twitter" title="Follow us on Twitter" target="_blank" rel="noopener noreferrer"><span class="iconify" data-icon="ri:twitter-line"></span></a>';
        return $output;
    }
    return "";
}
add_shortcode("twitter", "business_twitter_shortcode");

// Shortcode for Business Pinterest
function business_pinterest_shortcode()
{
    $pinterest = get_theme_mod("pinterest_link");
    if ($pinterest) {
        $output =
            '<a href="' .
            esc_url($pinterest) .
            '" aria-label="Follow us on Pinterest" title="Follow us on Pinterest" target="_blank" rel="noopener noreferrer"><span class="iconify" data-icon="ri:pinterest-line"></span></a>';
        return $output;
    }
    return "";
}
add_shortcode("pinterest", "business_pinterest_shortcode");

// Shortcode for Business YouTube
function business_youtube_shortcode()
{
    $youtube = get_theme_mod("youtube_link");
    if ($youtube) {
        $output =
            '<a href="' .
            esc_url($youtube) .
            '" aria-label="Follow us on YouTube" title="Follow us on YouTube" target="_blank" rel="noopener noreferrer"><span class="iconify" data-icon="ri:youtube-line"></span></a>';
        return $output;
    }
    return "";
}
add_shortcode("youtube", "business_youtube_shortcode");
