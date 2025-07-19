<?php
/**
 * Template Name: Homepage
 * 
 * The front page template file
 *
 * @package KetoWP
 */

get_header(); ?>

<main id="primary" class="site-main">

    <?php
    // Hero Section
    if ( get_theme_mod( 'ketowp_hero_enable', true ) ) :
        $hero_bg_image = get_theme_mod( 'ketowp_hero_bg_image' );
        $hero_title = get_theme_mod( 'ketowp_hero_title', esc_html__( 'Welcome to Our Store', 'ketowp' ) );
        $hero_subtitle = get_theme_mod( 'ketowp_hero_subtitle', esc_html__( 'Discover amazing products at great prices', 'ketowp' ) );
        $hero_button_text = get_theme_mod( 'ketowp_hero_button_text', esc_html__( 'Shop Now', 'ketowp' ) );
        $hero_button_url = get_theme_mod( 'ketowp_hero_button_url', '' );
        
        $hero_bg_style = '';
        if ( $hero_bg_image ) {
            $hero_bg_url = wp_get_attachment_image_url( $hero_bg_image, 'ketowp-hero' );
            if ( $hero_bg_url ) {
                $hero_bg_style = 'background-image: url(' . esc_url( $hero_bg_url ) . ');';
            }
        }
    ?>
    <section class="hero-section relative bg-yellow-400 py-20 bg-cover bg-center" style="<?php echo esc_attr( $hero_bg_style ); ?>">
        <?php if ( $hero_bg_image ) : ?>
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <?php endif; ?>
        <div class="container relative z-10">
            <div class="max-w-4xl mx-auto text-center <?php echo $hero_bg_image ? 'text-white' : 'text-black'; ?>">
                <?php if ( $hero_title ) : ?>
                    <h1 class="text-4xl md:text-6xl font-bold mb-6"><?php echo esc_html( $hero_title ); ?></h1>
                <?php endif; ?>
                
                <?php if ( $hero_subtitle ) : ?>
                    <p class="text-xl md:text-2xl mb-8 opacity-90"><?php echo esc_html( $hero_subtitle ); ?></p>
                <?php endif; ?>
                
                <?php if ( $hero_button_text ) : ?>
                    <a href="<?php echo esc_url( $hero_button_url ? $hero_button_url : wc_get_page_permalink( 'shop' ) ); ?>" 
                       class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors text-lg">
                        <?php echo esc_html( $hero_button_text ); ?>
                        <span class="iconify ml-2" data-icon="ri:arrow-right-line"></span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // Featured Products Section
    if ( get_theme_mod( 'ketowp_featured_products_enable', true ) && ketowp_is_woocommerce_activated() ) :
        $featured_title = get_theme_mod( 'ketowp_featured_products_title', esc_html__( 'Featured Products', 'ketowp' ) );
        $featured_count = get_theme_mod( 'ketowp_featured_products_count', 8 );
        $featured_products = ketowp_get_featured_products( $featured_count );
    ?>
    <section class="featured-products py-16">
        <div class="container">
            <?php if ( $featured_title ) : ?>
                <h2 class="text-3xl font-bold text-center mb-12"><?php echo esc_html( $featured_title ); ?></h2>
            <?php endif; ?>
            
            <?php if ( ! empty( $featured_products ) ) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php foreach ( $featured_products as $featured_product ) : 
                        $product = wc_get_product( $featured_product->ID );
                        if ( ! $product ) continue;
                    ?>
                        <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <a href="<?php echo esc_url( get_permalink( $featured_product->ID ) ); ?>" class="block">
                                <div class="aspect-square overflow-hidden">
                                    <?php echo get_the_post_thumbnail( $featured_product->ID, 'medium', array( 'class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300' ) ); ?>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg mb-2 line-clamp-2"><?php echo esc_html( get_the_title( $featured_product->ID ) ); ?></h3>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xl font-bold text-blue-600"><?php echo $product->get_price_html(); ?></span>
                                        <?php if ( $product->is_on_sale() ) : ?>
                                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">Sale</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="text-center mt-12">
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                       class="inline-flex items-center px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-colors">
                        <?php esc_html_e( 'View All Products', 'ketowp' ); ?>
                        <span class="iconify ml-2" data-icon="ri:arrow-right-line"></span>
                    </a>
                </div>
            <?php else : ?>
                <p class="text-center text-gray-600"><?php esc_html_e( 'No featured products found.', 'ketowp' ); ?></p>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // Product Categories Section
    if ( get_theme_mod( 'ketowp_categories_enable', true ) && ketowp_is_woocommerce_activated() ) :
        $categories_title = get_theme_mod( 'ketowp_categories_title', esc_html__( 'Shop by Category', 'ketowp' ) );
        $categories_count = get_theme_mod( 'ketowp_categories_count', 6 );
        $product_categories = ketowp_get_product_categories( $categories_count );
    ?>
    <section class="product-categories py-16 bg-gray-50">
        <div class="container">
            <?php if ( $categories_title ) : ?>
                <h2 class="text-3xl font-bold text-center mb-12"><?php echo esc_html( $categories_title ); ?></h2>
            <?php endif; ?>
            
            <?php if ( ! empty( $product_categories ) ) : ?>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                    <?php foreach ( $product_categories as $category ) : 
                        $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                        $image_url = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'medium' ) : wc_placeholder_img_src();
                    ?>
                        <div class="category-card text-center">
                            <a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="block group">
                                <div class="aspect-square rounded-full overflow-hidden mb-4 mx-auto w-24 h-24 bg-white shadow-lg group-hover:shadow-xl transition-shadow">
                                    <img src="<?php echo esc_url( $image_url ); ?>" 
                                         alt="<?php echo esc_attr( $category->name ); ?>"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                </div>
                                <h3 class="font-semibold text-lg group-hover:text-blue-600 transition-colors"><?php echo esc_html( $category->name ); ?></h3>
                                <p class="text-sm text-gray-600"><?php echo esc_html( sprintf( _n( '%d product', '%d products', $category->count, 'ketowp' ), $category->count ) ); ?></p>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="text-center text-gray-600"><?php esc_html_e( 'No product categories found.', 'ketowp' ); ?></p>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // Additional content from page editor
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            if ( get_the_content() ) :
    ?>
    <section class="page-content py-16">
        <div class="container">
            <div class="prose max-w-none mx-auto">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
    <?php
            endif;
        endwhile;
    endif;
    ?>

</main><!-- #primary -->

<?php
get_footer();