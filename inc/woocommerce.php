<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package KetoWP
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function ketowp_woocommerce_setup() {
    add_theme_support(
        'woocommerce',
        array(
            'thumbnail_image_width' => 150,
            'single_image_width'    => 300,
            'product_grid'          => array(
                'default_rows'    => 3,
                'min_rows'        => 1,
                'max_rows'        => 10,
                'default_columns' => 4,
                'min_columns'     => 1,
                'max_columns'     => 6,
            ),
        )
    );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'ketowp_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function ketowp_woocommerce_scripts() {
    wp_enqueue_style( 'ketowp-woocommerce-style', KETOWP_THEME_URI . '/woocommerce.css', array(), KETOWP_VERSION );

    $font_path   = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
            font-family: "star";
            src: url("' . $font_path . 'star.eot");
            src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
                url("' . $font_path . 'star.woff") format("woff"),
                url("' . $font_path . 'star.ttf") format("truetype"),
                url("' . $font_path . 'star.svg#star") format("svg");
            font-weight: normal;
            font-style: normal;
        }';

    wp_add_inline_style( 'ketowp-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'ketowp_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function ketowp_woocommerce_active_body_class( $classes ) {
    $classes[] = 'woocommerce-active';

    return $classes;
}
add_filter( 'body_class', 'ketowp_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function ketowp_woocommerce_related_products_args( $args ) {
    $defaults = array(
        'posts_per_page' => 3,
        'columns'        => 3,
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'ketowp_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'ketowp_woocommerce_wrapper_before' ) ) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function ketowp_woocommerce_wrapper_before() {
        ?>
            <main id="primary" class="site-main">
        <?php
    }
}
add_action( 'woocommerce_before_main_content', 'ketowp_woocommerce_wrapper_before' );

if ( ! function_exists( 'ketowp_woocommerce_wrapper_after' ) ) {
    /**
     * After Content.
     *
     * Closes the wrapping divs.
     *
     * @return void
     */
    function ketowp_woocommerce_wrapper_after() {
        ?>
            </main><!-- #main -->
        <?php
    }
}
add_action( 'woocommerce_after_main_content', 'ketowp_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
    <?php
        if ( function_exists( 'ketowp_woocommerce_header_cart' ) ) {
            ketowp_woocommerce_header_cart();
        }
    ?>
 */

if ( ! function_exists( 'ketowp_woocommerce_cart_link_fragment' ) ) {
    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    function ketowp_woocommerce_cart_link_fragment( $fragments ) {
        ob_start();
        ketowp_woocommerce_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ketowp_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'ketowp_woocommerce_cart_link' ) ) {
    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    function ketowp_woocommerce_cart_link() {
        ?>
        <a class="cart-contents flex items-center gap-2 text-current hover:text-blue-600 transition-colors" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'ketowp' ); ?>">
            <span class="iconify text-xl" data-icon="ri:shopping-cart-line"></span>
            <span class="amount font-medium"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span>
            <span class="count bg-blue-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"><?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'ketowp' ), WC()->cart->get_cart_contents_count() ) ); ?></span>
        </a>
        <?php
    }
}

if ( ! function_exists( 'ketowp_woocommerce_header_cart' ) ) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function ketowp_woocommerce_header_cart() {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <ul id="site-header-cart" class="site-header-cart">
            <li class="<?php echo esc_attr( $class ); ?>">
                <?php ketowp_woocommerce_cart_link(); ?>
            </li>
            <li>
                <?php
                $instance = array(
                    'title' => '',
                );

                the_widget( 'WC_Widget_Cart', $instance );
                ?>
            </li>
        </ul>
        <?php
    }
}

/**
 * Customize WooCommerce breadcrumbs
 */
function ketowp_woocommerce_breadcrumbs() {
    return array(
        'delimiter'   => ' <span class="breadcrumb-separator mx-2 text-gray-400">/</span> ',
        'wrap_before' => '<nav class="woocommerce-breadcrumb text-sm text-gray-600 mb-4" aria-label="' . esc_attr__( 'Breadcrumb', 'ketowp' ) . '">',
        'wrap_after'  => '</nav>',
        'before'      => '',
        'after'       => '',
        'home'        => _x( 'Home', 'breadcrumb', 'ketowp' ),
    );
}
add_filter( 'woocommerce_breadcrumb_defaults', 'ketowp_woocommerce_breadcrumbs' );

/**
 * Customize WooCommerce pagination
 */
function ketowp_woocommerce_pagination_args( $args ) {
    $args['prev_text'] = '<span class="iconify" data-icon="ri:arrow-left-line"></span> ' . esc_html__( 'Previous', 'ketowp' );
    $args['next_text'] = esc_html__( 'Next', 'ketowp' ) . ' <span class="iconify" data-icon="ri:arrow-right-line"></span>';
    return $args;
}
add_filter( 'woocommerce_pagination_args', 'ketowp_woocommerce_pagination_args' );

/**
 * Change number of products per row to 3
 */
function ketowp_woocommerce_loop_columns() {
    return 3;
}
add_filter( 'loop_shop_columns', 'ketowp_woocommerce_loop_columns' );

/**
 * Customize WooCommerce product loop
 */
function ketowp_woocommerce_product_loop_start() {
    echo '<ul class="products grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">';
}

function ketowp_woocommerce_product_loop_end() {
    echo '</ul>';
}

add_filter( 'woocommerce_product_loop_start', 'ketowp_woocommerce_product_loop_start' );
add_filter( 'woocommerce_product_loop_end', 'ketowp_woocommerce_product_loop_end' );

/**
 * Remove WooCommerce sidebar on shop pages
 */
function ketowp_remove_woocommerce_sidebar() {
    if ( is_shop() || is_product_category() || is_product_tag() ) {
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    }
}
add_action( 'wp', 'ketowp_remove_woocommerce_sidebar' );

/**
 * Customize WooCommerce single product image size
 */
function ketowp_woocommerce_single_product_image_thumbnail_html( $html, $post_thumbnail_id ) {
    return str_replace( 'class="', 'class="w-full h-auto rounded-lg ', $html );
}
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'ketowp_woocommerce_single_product_image_thumbnail_html', 10, 2 );

/**
 * Add custom fields to products
 */
function ketowp_add_custom_product_fields() {
    global $woocommerce, $post;

    echo '<div class="product_custom_field">';
    
    // Custom field example
    woocommerce_wp_text_input(
        array(
            'id'          => '_custom_product_text_field',
            'label'       => __( 'Custom Text Field', 'ketowp' ),
            'placeholder' => 'Custom text',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the custom text here.', 'ketowp' ),
        )
    );
    
    echo '</div>';
}
add_action( 'woocommerce_product_options_general_product_data', 'ketowp_add_custom_product_fields' );

/**
 * Save custom product fields
 */
function ketowp_save_custom_product_fields( $post_id ) {
    $custom_text_field = $_POST['_custom_product_text_field'];
    if ( ! empty( $custom_text_field ) ) {
        update_post_meta( $post_id, '_custom_product_text_field', esc_attr( $custom_text_field ) );
    }
}
add_action( 'woocommerce_process_product_meta', 'ketowp_save_custom_product_fields' );

/**
 * Display custom product fields on single product page
 */
function ketowp_display_custom_product_fields() {
    global $post;

    $custom_text = get_post_meta( $post->ID, '_custom_product_text_field', true );

    if ( ! empty( $custom_text ) ) {
        echo '<div class="custom-field mt-4 p-4 bg-gray-100 rounded-lg">';
        echo '<h4 class="font-semibold mb-2">' . esc_html__( 'Additional Information', 'ketowp' ) . '</h4>';
        echo '<p>' . esc_html( $custom_text ) . '</p>';
        echo '</div>';
    }
}
add_action( 'woocommerce_single_product_summary', 'ketowp_display_custom_product_fields', 25 );