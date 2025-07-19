/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Hero section
	wp.customize( 'ketowp_hero_title', function( value ) {
		value.bind( function( to ) {
			$( '.hero-section h1' ).text( to );
		} );
	} );

	wp.customize( 'ketowp_hero_subtitle', function( value ) {
		value.bind( function( to ) {
			$( '.hero-section p' ).text( to );
		} );
	} );

	wp.customize( 'ketowp_hero_button_text', function( value ) {
		value.bind( function( to ) {
			$( '.hero-section .btn' ).text( to );
		} );
	} );

	// Featured products title
	wp.customize( 'ketowp_featured_products_title', function( value ) {
		value.bind( function( to ) {
			$( '.featured-products h2' ).text( to );
		} );
	} );

	// Categories title
	wp.customize( 'ketowp_categories_title', function( value ) {
		value.bind( function( to ) {
			$( '.product-categories h2' ).text( to );
		} );
	} );

	// Notification text
	wp.customize( 'ketowp_notification_text', function( value ) {
		value.bind( function( to ) {
			$( '.notification-bar' ).text( to );
		} );
	} );

	// Footer copyright
	wp.customize( 'ketowp_footer_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.copyright' ).html( to );
		} );
	} );

	// Colors
	wp.customize( 'ketowp_primary_color', function( value ) {
		value.bind( function( to ) {
			$( 'head' ).append( '<style>:root { --color-primary: ' + to + '; }</style>' );
		} );
	} );

	wp.customize( 'ketowp_secondary_color', function( value ) {
		value.bind( function( to ) {
			$( 'head' ).append( '<style>:root { --color-secondary: ' + to + '; }</style>' );
		} );
	} );

	wp.customize( 'ketowp_accent_color', function( value ) {
		value.bind( function( to ) {
			$( 'head' ).append( '<style>:root { --color-accent: ' + to + '; }</style>' );
		} );
	} );

} )( jQuery );