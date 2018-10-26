<?php
/**
 * Paradox
 *
 * This file adds the header wrapper functions to the theme.
 */

/**
 * Opens the hero image section.
 */
function paradox_header_hero_start() {

	genesis_markup(
		array(
			'open'    => '<div %s>',
			'context' => 'header-hero',
		)
	);

}

/**
 * Closes the hero image section.
 */
function paradox_header_hero_end() {

	genesis_markup(
		array(
			'close'   => '</div>',
			'context' => 'header-hero',
		)
	);

}

add_filter( 'genesis_customizer_theme_settings_config', 'paradox_remove_customizer_settings' );
// *
//  * Removes output of genesis header settings in the Customizer.
//  *
//  * @param array $config Original Customizer items.
//  * @return array Filtered Customizer items.
 
function paradox_remove_customizer_settings( $config ) {

	unset( $config['genesis']['sections']['genesis_header'] );
	return $config;

}

/**
 * Modifies the default CSS output for custom-header.
 */

function paradox_header_style() {

	$output   = '';
	$bg_image = '';


	if ( has_post_thumbnail() ) {
		$bg_image = genesis_get_image(
			array(
				'format' => 'url',
				'size'   => 'header-hero',
			)
		);
	} 
	
	if ( ! $bg_image ) {
		$bg_image = get_header_image();
	}

	if ( $bg_image ) {
		$output = '<style type="text/css">.header-hero { background-image: linear-gradient(0deg, rgba(0,0,0,0.5) 50%, rgba(0,0,0,0.85) 100%), url(' . esc_url( $bg_image ) . '); }</style>';
	}

	echo $output;

}









