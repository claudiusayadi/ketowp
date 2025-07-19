<?php
/**
 * KetoWP Theme Customizer
 *
 * @package KetoWP
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ketowp_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'ketowp_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'ketowp_customize_partial_blogdescription',
            )
        );
    }

    // Colors Panel
    $wp_customize->add_panel( 'ketowp_colors', array(
        'title'       => esc_html__( 'Theme Colors', 'ketowp' ),
        'description' => esc_html__( 'Customize the theme colors.', 'ketowp' ),
        'priority'    => 30,
    ) );

    // Primary Color Section
    $wp_customize->add_section( 'ketowp_primary_color_section', array(
        'title' => esc_html__( 'Primary Color', 'ketowp' ),
        'panel' => 'ketowp_colors',
    ) );

    $wp_customize->add_setting( 'ketowp_primary_color', array(
        'default'           => '#f9d400',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ketowp_primary_color', array(
        'label'   => esc_html__( 'Primary Color', 'ketowp' ),
        'section' => 'ketowp_primary_color_section',
    ) ) );

    // Secondary Color Section
    $wp_customize->add_section( 'ketowp_secondary_color_section', array(
        'title' => esc_html__( 'Secondary Color', 'ketowp' ),
        'panel' => 'ketowp_colors',
    ) );

    $wp_customize->add_setting( 'ketowp_secondary_color', array(
        'default'           => '#e44650',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ketowp_secondary_color', array(
        'label'   => esc_html__( 'Secondary Color', 'ketowp' ),
        'section' => 'ketowp_secondary_color_section',
    ) ) );

    // Accent Color Section
    $wp_customize->add_section( 'ketowp_accent_color_section', array(
        'title' => esc_html__( 'Accent Color', 'ketowp' ),
        'panel' => 'ketowp_colors',
    ) );

    $wp_customize->add_setting( 'ketowp_accent_color', array(
        'default'           => '#004aad',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ketowp_accent_color', array(
        'label'   => esc_html__( 'Accent Color', 'ketowp' ),
        'section' => 'ketowp_accent_color_section',
    ) ) );

    // Homepage Panel
    $wp_customize->add_panel( 'ketowp_homepage', array(
        'title'       => esc_html__( 'Homepage Settings', 'ketowp' ),
        'description' => esc_html__( 'Customize your homepage content.', 'ketowp' ),
        'priority'    => 25,
    ) );

    // Hero Section
    $wp_customize->add_section( 'ketowp_hero_section', array(
        'title' => esc_html__( 'Hero Section', 'ketowp' ),
        'panel' => 'ketowp_homepage',
    ) );

    // Hero Enable/Disable
    $wp_customize->add_setting( 'ketowp_hero_enable', array(
        'default'           => true,
        'sanitize_callback' => 'ketowp_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'ketowp_hero_enable', array(
        'label'   => esc_html__( 'Enable Hero Section', 'ketowp' ),
        'section' => 'ketowp_hero_section',
        'type'    => 'checkbox',
    ) );

    // Hero Background Image
    $wp_customize->add_setting( 'ketowp_hero_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ketowp_hero_bg_image', array(
        'label'     => esc_html__( 'Hero Background Image', 'ketowp' ),
        'section'   => 'ketowp_hero_section',
        'mime_type' => 'image',
    ) ) );

    // Hero Title
    $wp_customize->add_setting( 'ketowp_hero_title', array(
        'default'           => esc_html__( 'Welcome to Our Store', 'ketowp' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'ketowp_hero_title', array(
        'label'   => esc_html__( 'Hero Title', 'ketowp' ),
        'section' => 'ketowp_hero_section',
        'type'    => 'text',
    ) );

    // Hero Subtitle
    $wp_customize->add_setting( 'ketowp_hero_subtitle', array(
        'default'           => esc_html__( 'Discover amazing products at great prices', 'ketowp' ),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'ketowp_hero_subtitle', array(
        'label'   => esc_html__( 'Hero Subtitle', 'ketowp' ),
        'section' => 'ketowp_hero_section',
        'type'    => 'textarea',
    ) );

    // Hero Button Text
    $wp_customize->add_setting( 'ketowp_hero_button_text', array(
        'default'           => esc_html__( 'Shop Now', 'ketowp' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'ketowp_hero_button_text', array(
        'label'   => esc_html__( 'Hero Button Text', 'ketowp' ),
        'section' => 'ketowp_hero_section',
        'type'    => 'text',
    ) );

    // Hero Button URL
    $wp_customize->add_setting( 'ketowp_hero_button_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'ketowp_hero_button_url', array(
        'label'   => esc_html__( 'Hero Button URL', 'ketowp' ),
        'section' => 'ketowp_hero_section',
        'type'    => 'url',
    ) );

    // Featured Products Section
    $wp_customize->add_section( 'ketowp_featured_products', array(
        'title' => esc_html__( 'Featured Products', 'ketowp' ),
        'panel' => 'ketowp_homepage',
    ) );

    // Featured Products Enable/Disable
    $wp_customize->add_setting( 'ketowp_featured_products_enable', array(
        'default'           => true,
        'sanitize_callback' => 'ketowp_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'ketowp_featured_products_enable', array(
        'label'   => esc_html__( 'Enable Featured Products Section', 'ketowp' ),
        'section' => 'ketowp_featured_products',
        'type'    => 'checkbox',
    ) );

    // Featured Products Title
    $wp_customize->add_setting( 'ketowp_featured_products_title', array(
        'default'           => esc_html__( 'Featured Products', 'ketowp' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'ketowp_featured_products_title', array(
        'label'   => esc_html__( 'Featured Products Title', 'ketowp' ),
        'section' => 'ketowp_featured_products',
        'type'    => 'text',
    ) );

    // Featured Products Count
    $wp_customize->add_setting( 'ketowp_featured_products_count', array(
        'default'           => 8,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'ketowp_featured_products_count', array(
        'label'   => esc_html__( 'Number of Products to Show', 'ketowp' ),
        'section' => 'ketowp_featured_products',
        'type'    => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 20,
        ),
    ) );

    // Categories Section
    $wp_customize->add_section( 'ketowp_categories_section', array(
        'title' => esc_html__( 'Product Categories', 'ketowp' ),
        'panel' => 'ketowp_homepage',
    ) );

    // Categories Enable/Disable
    $wp_customize->add_setting( 'ketowp_categories_enable', array(
        'default'           => true,
        'sanitize_callback' => 'ketowp_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'ketowp_categories_enable', array(
        'label'   => esc_html__( 'Enable Categories Section', 'ketowp' ),
        'section' => 'ketowp_categories_section',
        'type'    => 'checkbox',
    ) );

    // Categories Title
    $wp_customize->add_setting( 'ketowp_categories_title', array(
        'default'           => esc_html__( 'Shop by Category', 'ketowp' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'ketowp_categories_title', array(
        'label'   => esc_html__( 'Categories Title', 'ketowp' ),
        'section' => 'ketowp_categories_section',
        'type'    => 'text',
    ) );

    // Categories Count
    $wp_customize->add_setting( 'ketowp_categories_count', array(
        'default'           => 6,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'ketowp_categories_count', array(
        'label'   => esc_html__( 'Number of Categories to Show', 'ketowp' ),
        'section' => 'ketowp_categories_section',
        'type'    => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 12,
        ),
    ) );

    // Business Information Panel
    $wp_customize->add_panel( 'ketowp_business_info', array(
        'title'       => esc_html__( 'Business Information', 'ketowp' ),
        'description' => esc_html__( 'Add your business contact information and social links.', 'ketowp' ),
        'priority'    => 35,
    ) );

    // Contact Information Section
    $wp_customize->add_section( 'ketowp_contact_info', array(
        'title' => esc_html__( 'Contact Information', 'ketowp' ),
        'panel' => 'ketowp_business_info',
    ) );

    // Business Phone
    $wp_customize->add_setting( 'ketowp_business_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'ketowp_business_phone', array(
        'label'   => esc_html__( 'Business Phone', 'ketowp' ),
        'section' => 'ketowp_contact_info',
        'type'    => 'tel',
    ) );

    // Business Email
    $wp_customize->add_setting( 'ketowp_business_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ) );

    $wp_customize->add_control( 'ketowp_business_email', array(
        'label'   => esc_html__( 'Business Email', 'ketowp' ),
        'section' => 'ketowp_contact_info',
        'type'    => 'email',
    ) );

    // Business Address
    $wp_customize->add_setting( 'ketowp_business_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );

    $wp_customize->add_control( 'ketowp_business_address', array(
        'label'   => esc_html__( 'Business Address', 'ketowp' ),
        'section' => 'ketowp_contact_info',
        'type'    => 'textarea',
    ) );

    // Social Links Section
    $wp_customize->add_section( 'ketowp_social_links', array(
        'title' => esc_html__( 'Social Links', 'ketowp' ),
        'panel' => 'ketowp_business_info',
    ) );

    $social_networks = array(
        'facebook'  => esc_html__( 'Facebook', 'ketowp' ),
        'twitter'   => esc_html__( 'Twitter', 'ketowp' ),
        'instagram' => esc_html__( 'Instagram', 'ketowp' ),
        'linkedin'  => esc_html__( 'LinkedIn', 'ketowp' ),
        'youtube'   => esc_html__( 'YouTube', 'ketowp' ),
        'pinterest' => esc_html__( 'Pinterest', 'ketowp' ),
    );

    foreach ( $social_networks as $network => $label ) {
        $wp_customize->add_setting( "ketowp_social_{$network}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_control( "ketowp_social_{$network}", array(
            'label'   => $label,
            'section' => 'ketowp_social_links',
            'type'    => 'url',
        ) );
    }

    // Notification Bar Section
    $wp_customize->add_section( 'ketowp_notification_bar', array(
        'title'       => esc_html__( 'Notification Bar', 'ketowp' ),
        'description' => esc_html__( 'Add a notification message at the top of your site.', 'ketowp' ),
        'priority'    => 40,
    ) );

    // Notification Enable/Disable
    $wp_customize->add_setting( 'ketowp_notification_enable', array(
        'default'           => false,
        'sanitize_callback' => 'ketowp_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'ketowp_notification_enable', array(
        'label'   => esc_html__( 'Enable Notification Bar', 'ketowp' ),
        'section' => 'ketowp_notification_bar',
        'type'    => 'checkbox',
    ) );

    // Notification Text
    $wp_customize->add_setting( 'ketowp_notification_text', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'ketowp_notification_text', array(
        'label'   => esc_html__( 'Notification Text', 'ketowp' ),
        'section' => 'ketowp_notification_bar',
        'type'    => 'text',
    ) );

    // Footer Section
    $wp_customize->add_section( 'ketowp_footer_settings', array(
        'title'       => esc_html__( 'Footer Settings', 'ketowp' ),
        'description' => esc_html__( 'Customize your footer content.', 'ketowp' ),
        'priority'    => 45,
    ) );

    // Footer Copyright Text
    $wp_customize->add_setting( 'ketowp_footer_copyright', array(
        'default'           => sprintf( esc_html__( '© %s %s. All rights reserved.', 'ketowp' ), date( 'Y' ), get_bloginfo( 'name' ) ),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'ketowp_footer_copyright', array(
        'label'   => esc_html__( 'Copyright Text', 'ketowp' ),
        'section' => 'ketowp_footer_settings',
        'type'    => 'textarea',
    ) );
}
add_action( 'customize_register', 'ketowp_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ketowp_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ketowp_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Sanitize checkbox values.
 */
function ketowp_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ketowp_customize_preview_js() {
    wp_enqueue_script( 'ketowp-customizer', KETOWP_THEME_URI . '/assets/js/customizer.js', array( 'customize-preview' ), KETOWP_VERSION, true );
}
add_action( 'customize_preview_init', 'ketowp_customize_preview_js' );