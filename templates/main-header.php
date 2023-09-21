<?php
/**
 * Displays header site branding
 *
 * @package Adun_Studio
 * @subpackage KetoWP
 * @since KetoWP 1.0
 */

if ( ! empty( $site_name ) ) : ?>
<?php if ( is_front_page() && is_home() ) : ?>
<h1 class="site-title"><a href="<?php echo $home; ?>" rel="home"
    aria-label='Home'><?php $site_name; ?></a></h1>
<?php else : ?>
<h1 class="site-title"><a href="<?php echo $home; ?>" rel="home"
    aria-label='Home'><?php $site_name; ?></a></h1>
<?php endif; ?>
<?php endif; ?>

<?php
	if ( $description || is_customize_preview() ) :
		?>
<p class="description">
  <?php echo $description; ?>
</p>
<?php endif; ?>