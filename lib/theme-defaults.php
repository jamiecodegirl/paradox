<?php
/**
 * Paradox.
 *
 * This file adds the default theme settings to the Paradox Theme.
 *
 * @package Paradox
 */

add_filter( 'genesis_theme_settings_defaults', 'paradox_theme_defaults' );
/**
 * Updates theme settings on reset.
 *
 * @param array $defaults Original theme settings defaults.
 * @return array Modified defaults.
 */
function paradox_theme_defaults( $defaults ) {

	$defaults['blog_cat_num']              = 6;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 0;
	$defaults['content_archive_thumbnail'] = 1;
	$defaults['image_alignment']           = 'aligncenter';
	$defaults['image_size']                = 'featured-image';
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'full-width-content';

	return $defaults;

}

add_action( 'after_switch_theme', 'paradox_theme_setting_defaults' );
/**
 * Updates theme settings on activation.
 */
function paradox_theme_setting_defaults() {

	if ( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings(
			array(
				'blog_cat_num'              => 6,
				'content_archive'           => 'full',
				'content_archive_limit'     => 0,
				'content_archive_thumbnail' => 1,
				'image_alignment'           => 'aligncenter',
				'image_size'                => 'featured-image',
				'posts_nav'                 => 'numeric',
				'site_layout'               => 'full-width-content',
			)
		);

	}

	update_option( 'posts_per_page', 6 );

}

add_filter( 'simple_social_default_styles', 'paradox_social_default_styles' );
/**
 * Set Simple Social Icon defaults.
 *
 * @param array $defaults Social style defaults.
 * @return array Modified social style defaults.
 */
function paradox_social_default_styles( $defaults ) {

	$args = array(
		'alignment'              => 'alignleft',
		'background_color'       => '#f5f5f5',
		'background_color_hover' => '#333333',
		'border_radius'          => 3,
		'border_width'           => 0,
		'icon_color'             => '#333333',
		'icon_color_hover'       => '#ffffff',
		'size'                   => 40,
	);

	$args = wp_parse_args( $args, $defaults );

	return $args;

}
