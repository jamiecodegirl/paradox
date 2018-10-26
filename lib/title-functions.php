<?php
/**
 * Paradox
 *
 * This file adds the title customizations to the theme.
 */

/**
 * Opens the hero title section.
 */
function paradox_header_title_wrap() {

	genesis_markup(
		array(
			'open'    => '<div %s><div class="wrap">',
			'context' => 'hero-page-title',
		)
	);

	do_action( 'paradox_entry_header' );

}

/**
 * Closes the hero title section.
 */
function paradox_header_title_end_wrap() {

	genesis_markup(
		array(
			'close'   => '</div></div>',
			'context' => 'hero-page-title',
		)
	);

}

add_filter( 'genesis_attr_hero-page-title', 'paradox_add_header_attributes' );
/**
 * Adds custom attributes for the header hero title.
 *
 * @param array $attributes The element attributes.
 * @return array $attributes The element attributes.
 */
function paradox_add_header_attributes( $attributes ) {

	// Adds id.
	$attributes['id'] = 'hero-page-title';

	// Returns the attributes.
	return $attributes;

}

add_filter( 'genesis_attr_entry', 'paradox_entry_attributes', 10, 3 );
/**
 * Add itemref attribute to link entry-title.
 *
 * @param  array $attributes Entry attributes.
 * @return array The new $attributes.
 */
function paradox_entry_attributes( $attributes, $context, $args ) {

	if ( is_singular() && ! is_front_page() && ! isset( $args['params']['is_widget'] ) ) {
		$attributes['itemref'] = 'hero-page-title';
	}

	return $attributes;

}

add_action( 'genesis_meta', 'paradox_page_hero_header' );
/**
 * Relocates page titles and adds header image wrapper.
 */
function paradox_page_hero_header() {

	add_action( 'genesis_before_header', 'paradox_header_hero_start' );
	add_action( 'genesis_after_header', 'paradox_header_title_wrap', 90 );
	add_action( 'genesis_after_header', 'paradox_header_title_end_wrap', 98 );
	add_action( 'genesis_after_header', 'paradox_header_hero_end', 99 );

	if ( is_single() || is_page() && ! is_front_page() && ! genesis_is_blog_template() ) {
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
		add_action( 'paradox_entry_header', 'genesis_entry_header_markup_open' );
		add_action( 'paradox_entry_header', 'genesis_do_post_title' );
		add_action( 'paradox_entry_header', 'genesis_entry_header_markup_close' );
	} elseif ( is_home() || is_tag() || is_category() || is_archive() || genesis_is_blog_template() ) {
		remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
		remove_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );
		remove_action( 'genesis_before_loop', 'genesis_do_author_box_archive', 15 );
		remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );
		remove_action( 'genesis_before_loop', 'genesis_do_date_archive_title' );
		remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
		remove_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );
		add_action( 'paradox_entry_header', 'genesis_do_blog_template_heading' );
		add_action( 'paradox_entry_header', 'genesis_do_taxonomy_title_description' );
		add_action( 'paradox_entry_header', 'genesis_do_author_title_description' );
		add_action( 'paradox_entry_header', 'genesis_do_author_box_archive' );
		add_action( 'paradox_entry_header', 'genesis_do_cpt_archive_title_description' );
		add_action( 'paradox_entry_header', 'genesis_do_date_archive_title' );
		add_action( 'paradox_entry_header', 'genesis_do_posts_page_heading' );
	} elseif ( is_search() ) {
		remove_action( 'genesis_before_loop', 'genesis_do_search_title' );
		add_action( 'paradox_entry_header', 'genesis_do_search_title' );
	}

}

add_action( 'genesis_loop', 'paradox_remove_404_title' );
/**
 * Removes default 404 entry title.
 */
function paradox_remove_404_title() {

	if ( ! is_404() ) {
		return;
	}

	add_filter( 'genesis_markup_entry-title_open', '__return_false' );
	add_filter( 'genesis_markup_entry-title_close', '__return_false' );
	add_filter( 'genesis_404_entry_title', '__return_false' );

}

add_action( 'paradox_entry_header', 'paradox_404_title', 96 );
/**
 * Defines 404 entry title.
 */
function paradox_404_title() {

	if ( ! is_404() ) {
		return;
	}

	genesis_markup(
		array(
			'open'    => '<h1 %s>',
			'close'   => '</h1>',
			'content' => apply_filters( 'genesis_404_entry_title', __( '404 Page Not Found', 'paradox' ) ),
			'context' => 'entry-title',
		)
	);

}

add_action( 'genesis_after_loop', 'paradox_remove_404_title_filters' );
/**
 * Removes 404 entry-title filters.
 */
function paradox_remove_404_title_filters() {

	remove_filter( 'genesis_markup_entry-title_open', '__return_false' );
	remove_filter( 'genesis_markup_entry-title_close', '__return_false' );

}

 add_action( 'be_title_toggle_remove', 'paradox_integrate_genesis_title_toggle' );
/**
 * Integrates with Genesis Title Toggle
 *
 * @see https://www.billerickson.net/code/genesis-title-toggle-theme-integration
 */
function paradox_integrate_genesis_title_toggle() {

	remove_action( 'genesis_after_header', 'paradox_header_title_wrap', 90 );
	remove_action( 'paradox_entry_header', 'genesis_entry_header_markup_open' );
	remove_action( 'paradox_entry_header', 'genesis_do_post_title' );
	remove_action( 'paradox_entry_header', 'genesis_entry_header_markup_close' );
	remove_action( 'genesis_after_header', 'paradox_header_title_end_wrap', 98 );

}
