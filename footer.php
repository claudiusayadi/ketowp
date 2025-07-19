<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
* @package Adun_Studio
 * @subpackage KetoWP
 * @since KetoWP 1.0
 */
?>

<footer id="site-footer" class="site-footer bg-gray-900 text-white mt-auto">
  <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
  <section class="footer-widgets py-12">
    <div class="container">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
          <div class="footer-widget-area">
            <?php dynamic_sidebar( 'footer-1' ); ?>
          </div>
        <?php endif; ?>
        
        <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
          <div class="footer-widget-area">
            <?php dynamic_sidebar( 'footer-2' ); ?>
          </div>
        <?php endif; ?>
        
        <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
          <div class="footer-widget-area">
            <?php dynamic_sidebar( 'footer-3' ); ?>
          </div>
        <?php endif; ?>
        
        <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
          <div class="footer-widget-area">
            <?php dynamic_sidebar( 'footer-4' ); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="footer-bottom py-6 border-t border-gray-700">
    <div class="container">
      <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="copyright text-sm text-gray-400">
          <?php
          $copyright_text = get_theme_mod( 'ketowp_footer_copyright', sprintf( esc_html__( '© %s %s. All rights reserved.', 'ketowp' ), date( 'Y' ), get_bloginfo( 'name' ) ) );
          echo wp_kses_post( $copyright_text );
          ?>
        </div>
        
        <?php if ( has_nav_menu( 'footer' ) ) : ?>
          <nav class="footer-navigation" aria-label="Footer Menu">
            <?php
            wp_nav_menu(
              array(
                'theme_location' => 'footer',
                'menu_class'     => 'flex gap-6 text-sm',
                'container'      => false,
                'fallback_cb'    => false,
              )
            );
            ?>
          </nav>
        <?php endif; ?>
        
        <div class="social-links">
          <?php ketowp_social_links(); ?>
        </div>
      </div>
    </div>
  </section>
</footer>

<?php wp_footer(); ?>

</body>
</html>
