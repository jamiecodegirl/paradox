<?php
/**
 * Paradox
 *
 * This file handles the logic and templating for outputting the Hero Section on the Front Page in the theme.
 */

// Sets up hero section content.
$title       = get_theme_mod( 'paradox-hero-title-text', paradox_get_default_hero_title_text() );
$description = get_theme_mod( 'paradox-hero-description-text', paradox_get_default_hero_desc_text() );
$bg_image    = get_theme_mod( 'paradox-hero-background-image', paradox_get_default_hero_background_image() );


if ( $title || $description || is_active_sidebar( 'hero-section' ) ) {

	// Opens the hero-section markup.
	genesis_markup(
		array(
			'open'    => '<div %s><div class="wrap">',
			'context' => 'hero-section',
		)
	);

	if ( $title ) {
		echo '<h2 class="hero-title">' . $title . '</h2>';
	}

	if ( $description ) {
		echo '<p class="hero-description">' . $description . '</p>';
	}

	// Closes the hero-section markup.
	genesis_markup(
		array(
			'close'   => '</div></div>',
			'context' => 'hero-section',
		)
	);

}

