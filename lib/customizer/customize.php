<?php
/**
 * Paradox.
 *
 * This file adds the Customizer additions to the Paradox Theme.
 */

add_action( 'customize_register', 'paradox_customizer_register' );
/**
 * Registers settings and controls with the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function paradox_customizer_register( $wp_customize ) {

	// Adds custom heading controls to WordPress Theme Customizer.
	require_once get_stylesheet_directory() . '/lib/customizer/controls.php';

	// Main settings panel.
	$wp_customize->add_panel(
		'paradox-settings', array(
			'description' => __( 'Set up the theme hero section.', 'paradox' ),
			'priority'    => 80,
			'title'       => __( 'Hero Section', 'paradox' ),
		)
	);

	$wp_customize->add_section(
		'header_image', array(
			'title'       => __( 'Hero Image', 'paradox' ),
			'description' => sprintf( '<p><strong>%1$s</strong></p><p>%2$s</p>', __( 'The default hero image is displayed on the front page and all posts and pages where a unique featured image is not available.', 'paradox' ), __( 'A default image is included, but you may choose a different default image below.', 'paradox' ) ),
			'panel'       => 'paradox-settings',
		)
	);

	// Hero Section.
	$wp_customize->add_section(
		'paradox-front-page-hero-section', array(
			'active_callback' => 'is_front_page',
			'description'     => sprintf( '<strong>%s</strong>', __( 'Modify the text for the front page hero section.', 'paradox' ) ),
			'title'           => __( 'Hero Text', 'paradox' ),
			'panel'           => 'paradox-settings',
		)
	);

	// Hero Title.
	$wp_customize->add_setting(
		'paradox-hero-title-text', array(
			'default'           => paradox_get_default_hero_title_text(),
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh',
		)
	);

	$wp_customize->add_control(
		'paradox-hero-title-text', array(
			'description' => __( 'Change the title text for the front page hero section.', 'paradox' ),
			'label'       => __( 'Hero Title', 'paradox' ),
			'section'     => 'paradox-front-page-hero-section',
			'settings'    => 'paradox-hero-title-text',
			'type'        => 'textarea',
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'paradox-hero-title-text', array(
				'selector'        => '.hero-title',
				'settings'        => array( 'paradox-hero-title-text' ),
				'render_callback' => function() {
					return get_theme_mod( 'paradox-hero-title-text' );
				},
			)
		);
	}

	// Hero Intro Paragraph.
	$wp_customize->add_setting(
		'paradox-hero-description-text', array(
			'default'           => paradox_get_default_hero_desc_text(),
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh',
		)
	);

	$wp_customize->add_control(
		'paradox-hero-description-text', array(
			'description' => __( 'Change the description text for the front page hero section.', 'paradox' ),
			'label'       => __( 'Hero Intro Paragraph', 'paradox' ),
			'section'     => 'paradox-front-page-hero-section',
			'settings'    => 'paradox-hero-description-text',
			'type'        => 'textarea',
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'paradox-hero-description-text', array(
				'selector'        => '.hero-description',
				'settings'        => array( 'paradox-hero-description-text' ),
				'render_callback' => function() {
					return get_theme_mod( 'paradox-hero-description-text' );
				},
			)
		);
	}

	$wp_customize->add_setting(
		'paradox_logo_width',
		array(
			'default'           => 350,
			'sanitize_callback' => 'absint',
		)
	);

	// Add a control for the logo size.
	$wp_customize->add_control(
		'paradox_logo_width',
		array(
			'label'       => __( 'Logo Width', 'paradox' ),
			'description' => __( 'The maximum width of the logo in pixels.', 'paradox' ),
			'priority'    => 9,
			'section'     => 'title_tagline',
			'settings'    => 'paradox_logo_width',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 100,
			),

		)
	);

}

add_action( 'customize_preview_init', 'paradox_customizer_preview_scripts' );
/**
 * Enqueue Customizer preview scripts.
 */
function paradox_customizer_preview_scripts() {

	// Include the regular customizer preview script file.
	wp_enqueue_script( 'paradox-preview-scripts', get_stylesheet_directory_uri() . '/lib/customizer/customize.js', array( 'jquery' ), '1.0.0', true );

}

