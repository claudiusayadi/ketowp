<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "keto-content" main tag.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package adun_studio
 * @subpackage KetoWP
 * @since KetoWP 1.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo("charset"); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="https://gmpg.org/xfn/11" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <a class="skip-link screen-reader-text" href="#keto-content">
    <?php _e(
        "Skip to content",
        "ketowp",
    ); ?>
  </a>

  <?php ketowp_notification_bar(); ?>

  <header id="site-header">
    <div class="bg-alt/60 text-action-800 hidden md:block">
      <div class="container">
        <div class="grid grid-cols-3 items-center gap-m py-2 text-sm min-h-[3.7rem]">
          <nav aria-label="Social Links">
            <?php ketowp_social_links(); ?>
          </nav>

          <div class="justify-self-center">
            <?php ketowp_business_info(); ?>
          </div>
            <div class="max-w-fit"><?php echo do_shortcode(
                "[adsw_currency_switcher title=]",
              if ( has_nav_menu( 'secondary' ) ) {
                wp_nav_menu(
                  array(
                    'theme_location' => 'secondary',
                    'menu_class'     => 'flex gap-4',
                    'container'      => false,
                    'fallback_cb'    => false,
                  )
                );
              }
              ]); ?>
            </nav>
          </div>
        </div>
      </div>
            <?php ketowp_site_branding(); ?>
            <p><?php echo $description; ?></p>
            <figcaption class="screen-reader-text">Home</figcaption>
          </div>
          <?php endif;
            if ( has_nav_menu( 'primary' ) ) {
              wp_nav_menu(
                array(
                  'theme_location' => 'primary',
                  'menu_class'     => 'flex items-center gap-6 p-0 m-0',
                  'container'      => false,
                  'fallback_cb'    => false,
                )
              );
            }
            ]); ?>
          </nav>

          <nav class="hidden md:block justify-self-end" aria-label="User Menu">
            <ul class="flex items-center gap-m">
              <li>
                <?php 
                if ( ketowp_is_woocommerce_activated() ) {
                  get_product_search_form();
                } else {
                  get_search_form();
                }
                ?>
              </li>
              <?php if ( ketowp_is_woocommerce_activated() ) : ?>
              <li>
                <a href="<?php echo esc_url(
                <?php ketowp_woocommerce_header_cart(); ?>
              </li>
              <?php endif; ?>
            </ul>
          </nav>

          <div class="md:hidden justify-self-end">
            <button class="p-2" aria-label="Open mobile menu">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </header>
  