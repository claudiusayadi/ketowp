<?php

// Shortcode for business phone
function business_phone_shortcode()
{
    $phone = get_theme_mod("business_phone");
    return esc_html($phone);
}
add_shortcode("phone", "business_phone_shortcode");

// Shortcode for business email
function business_email_shortcode()
{
    $email = get_theme_mod("business_email");
    return esc_html($email);
}
add_shortcode("email", "business_email_shortcode");

// Shortcode for business address
function business_address_shortcode()
{
    $address = get_theme_mod("business_address");
    return esc_html($address);
}
add_shortcode("address", "business_address_shortcode");
