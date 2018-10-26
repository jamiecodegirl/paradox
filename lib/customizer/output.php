<?php
/**
 * Paradox.
 *
 * This file adds the required CSS to the front end to the Paradox Theme.
 */

add_action( 'wp_enqueue_scripts', 'paradox_css' );
/**
 * Checks the settings for the link color, and accent color.
 * If any of these value are set the appropriate CSS is output.
 */
function paradox_css() {

	$handle = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	// $color_link   = get_theme_mod( 'paradox_link_color', paradox_customizer_get_default_link_color() );
	// $color_accent = get_theme_mod( 'paradox_accent_color', paradox_customizer_get_default_accent_color() );
	$logo         = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );

	if ( $logo ) {
		$logo_height           = absint( $logo[2] );
		$logo_max_width        = get_theme_mod( 'paradox_logo_width', 350 );
		$logo_width            = absint( $logo[1] );
		$logo_ratio            = $logo_width / $logo_height;
		$logo_effective_height = min( $logo_width, $logo_max_width ) / $logo_ratio;
		$logo_padding          = max( 0, ( 60 - $logo_effective_height ) / 2 );
	}

	$css .= ( has_custom_logo() && ( 200 <= $logo_effective_height ) ) ?
		'
		.site-header {
			position: static;
		}
		'
	: '';

	$css .= ( has_custom_logo() && ( 350 !== $logo_max_width ) ) ? sprintf(
		'
		.wp-custom-logo .site-container .title-area {
			max-width: %spx;
		}
		', $logo_max_width
	) : '';

	// Place menu below logo and center logo once it gets big.
	$css .= ( has_custom_logo() && ( 600 <= $logo_max_width ) ) ?
		'
		.wp-custom-logo .title-area,
		.wp-custom-logo .menu-toggle,
		.wp-custom-logo .nav-primary {
			float: none;
		}

		.wp-custom-logo .title-area {
			margin: 0 auto;
			text-align: center;
		}

		@media only screen and (min-width: 960px) {
			.wp-custom-logo .nav-primary {
				text-align: center;
			}

			.wp-custom-logo .nav-primary .sub-menu {
				text-align: left;
			}
		}
		'
	: '';

	$css .= ( has_custom_logo() && $logo_padding ) ? sprintf(
		'
		.wp-custom-logo .title-area {
			padding-top: %spx;
		}
		', $logo_padding + 5
	) : '';

	if ( $css ) {
		wp_add_inline_style( $handle, $css );
	}

}
