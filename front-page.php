<?php
/**
 * Paradox.
 *
 * This file adds the front page to the Paradox Theme.
 */

add_action( 'genesis_meta', 'paradox_front_page_genesis_meta' );

/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function paradox_front_page_genesis_meta() {

	// Adds front page hero section.
	add_action( 'genesis_after_header', 'paradox_do_front_page_hero', 13 );

	// Removes the page header-title markup.
	remove_action( 'genesis_after_header', 'paradox_header_title_wrap', 90 );
	remove_action( 'genesis_after_header', 'paradox_header_title_end_wrap', 98 );

	// Enqueues scripts.
	add_action( 'wp_enqueue_scripts', 'paradox_enqueue_front_script_styles' );

	// Adds the front-page body class.
	add_filter( 'body_class', 'paradox_front_body_class' );

	// Adds screen reader text.
	add_action( 'genesis_before_loop', 'paradox_print_screen_reader' );

	// Adds front page widgets.
	add_action( 'genesis_loop', 'paradox_front_page_widgets' );

	// Removes the default Genesis loop.
	remove_action( 'genesis_loop', 'genesis_do_loop' );

	// Removes structural wrap from site-inner.
		add_theme_support(
			'genesis-structural-wraps', array(
				'header',
				'menu-primary',
				'menu-secondary',
				'footer-widgets',
				'footer',
			)
		);

}

/**
 * Adds hero section to the front page.
 */
function paradox_do_front_page_hero() {

	get_template_part( '/lib/templates/hero', 'section' );

}

// Add front page scripts.
function paradox_enqueue_front_script_styles() {

	wp_enqueue_style( 'paradox-front-styles', get_stylesheet_directory_uri() . '/style-front.css' );

}

// Define front-page body class.
function paradox_front_body_class( $classes ) {

	$classes[] = 'front-page';

	return $classes;

}

/**
 * Defines function to output the accessible screen reader header for the content.
 */
function paradox_print_screen_reader() {

	echo '<h3 class="screen-reader-text">' . __( 'Main Content', 'paradox' ) . '</h3>';

}

/**
 * Adds markup for front page widgets.
 */
function paradox_front_page_widgets() {

	if ( is_active_sidebar( 'front-page-1' ) ) {
		paradox_do_widget( 'front-page-1' );
	}

	if ( is_active_sidebar( 'front-page-2' ) ) {
		paradox_do_widget( 'front-page-2' );
	}

	if ( is_active_sidebar( 'front-page-3' ) ) {
		paradox_do_widget( 'front-page-3' );
	}

}

// Runs the Genesis loop.
genesis();
