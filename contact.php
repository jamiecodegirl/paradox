<?php
/**
 * Paradox.
 *
 * This file adds the contact page template to the Paradox Theme.
 *
 * Template Name: Contact
 *
 * @package Paradox
 */

// Forces full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Removes before footer widget.
remove_action( 'genesis_footer', 'paradox_before_footer' );

// Runs the Genesis loop.
genesis();
