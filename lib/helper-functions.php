<?php
/**
 * Paradox.
 *
 * This file adds the required helper functions used in the Paradox Theme.
 */

/**
 * Gets default link color for Customizer.
 * Abstracted here since at least two functions use it.
 *
 * @return string Hex color code for link color.
 */
function paradox_customizer_get_default_link_color() {

	return '#0073e5';

}

/**
 * Get default hero section background image.
 *
 * @return string image url.
 */
function paradox_get_default_hero_background_image() {

	return get_stylesheet_directory_uri() . '/images/hero.jpg';

}

/**
 * Get default hero section title.
 *
 * @return string Text to use in the title.
 */
function paradox_get_default_hero_title_text() {

	return __( 'Elevate', 'paradox' );

}

/**
 * Get default hero section description.
 *
 * @return string Text to use in the description.
 */
function paradox_get_default_hero_desc_text() {

	return __( '', 'paradox' );

}

/**
 * Gets default accent color for Customizer.
 * Abstracted here since at least two functions use it.
 *
 * @return string Hex color code for accent color.
 */
function paradox_customizer_get_default_accent_color() {

	return '#0073e5';

}

/**
 * Calculates if white or gray would contrast more with the provided color.
 *
 * @param string $color A color in hex format.
 * @return string The hex code for the most contrasting color: dark grey or white.
 */
function paradox_color_contrast( $color ) {

	$hexcolor = str_replace( '#', '', $color );
	$red      = hexdec( substr( $hexcolor, 0, 2 ) );
	$green    = hexdec( substr( $hexcolor, 2, 2 ) );
	$blue     = hexdec( substr( $hexcolor, 4, 2 ) );

	$luminosity = ( ( $red * 0.2126 ) + ( $green * 0.7152 ) + ( $blue * 0.0722 ) );

	return ( $luminosity > 128 ) ? '#333333' : '#ffffff';

}

/**
 * Generates a lighter or darker color from a starting color.
 * Used to generate complementary hover tints from user-chosen colors.
 *
 * @param string $color A color in hex format.
 * @param int    $change The amount to reduce or increase brightness by.
 * @return string Hex code for the adjusted color brightness.
 */
function paradox_color_brightness( $color, $change ) {

	$hexcolor = str_replace( '#', '', $color );

	$red   = hexdec( substr( $hexcolor, 0, 2 ) );
	$green = hexdec( substr( $hexcolor, 2, 2 ) );
	$blue  = hexdec( substr( $hexcolor, 4, 2 ) );

	$red   = max( 0, min( 255, $red + $change ) );
	$green = max( 0, min( 255, $green + $change ) );
	$blue  = max( 0, min( 255, $blue + $change ) );

	return '#' . dechex( $red ) . dechex( $green ) . dechex( $blue );

}
