<?php
/**
 * Paradox.
 *
 * This file adds the services page template to the Paradox Theme.
 *
 * Template Name: Services
 *
 * @package Paradox
 */

// Forces full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

add_action( 'genesis_before_content', 'paradox_services_page', 14 );
/**
 * Display Services page widget area.
 */
function paradox_services_page() {

	if ( is_active_sidebar( 'services-page' ) ) {
		paradox_do_widget( 'services-page' );
	}

}
// Runs the Genesis loop.
genesis();
