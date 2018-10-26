<?php
/**
 * Paradox.
 *
 * This file adds functions to the Paradox Theme.
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'paradox_localization_setup' );
/**
 * Sets localization (do not remove).
 */
function paradox_localization_setup() {

	load_child_theme_textdomain( 'paradox', get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds the theme header functions.
require_once get_stylesheet_directory() . '/lib/header-functions.php';

// Adds the theme title functions.
require_once get_stylesheet_directory() . '/lib/title-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customizer/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/customizer/output.php';

// Defines the child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Paradox' );
define( 'CHILD_THEME_URL', 'https://www.brandedkc.com/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

add_action( 'wp_enqueue_scripts', 'paradox_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 */
function paradox_enqueue_scripts_styles() {

	wp_enqueue_style(
		'paradox-fonts',
		'//fonts.googleapis.com/css?family=Lato:300,300italic,400,400italic,700',
		array(),
		CHILD_THEME_VERSION
	);
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script(
		'paradox-responsive-menu',
		get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js",
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);
	wp_localize_script(
		'paradox-responsive-menu',
		'genesis_responsive_menu',
		paradox_responsive_menu_settings()
	);

	wp_enqueue_script(
		'paradox-match-height',
		get_stylesheet_directory_uri() . '/js/jquery.matchHeight.min.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);
	wp_add_inline_script(
		'paradox-match-height',
		"jQuery(document).ready( function() { jQuery( '.half-width-entries .content .entry, .flexible-widgets .entry > div' ).matchHeight(); });"
	);
	wp_add_inline_script(
		'paradox-match-height',
		"jQuery(document).ready( function() { jQuery( '.content' ).matchHeight({ property: 'min-height' }); });"
	);

	wp_enqueue_script(
		'paradox',
		get_stylesheet_directory_uri() . '/js/paradox.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

}

/**
 * Defines responsive menu settings.
 */
function paradox_responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( 'Menu', 'paradox' ),
		'menuIconClass'    => 'dashicons-before dashicons-menu',
		'subMenu'          => __( 'Submenu', 'paradox' ),
		'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Sets the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

// Adds support for HTML5 markup structure.
add_theme_support(
	'html5', array(
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
	)
);

// Adds support for accessibility.
add_theme_support(
	'genesis-accessibility', array(
		'404-page',
		'drop-down-menu',
		'headings',
		'rems',
		'search-form',
		'skip-links',
	)
);

// Adds viewport meta tag for mobile browsers.
add_theme_support(
	'genesis-responsive-viewport'
);

// Adds custom logo in Customizer > Site Identity.
add_theme_support(
	'custom-logo', array(
		'height'      => 120,
		'width'       => 700,
		'flex-height' => true,
		'flex-width'  => true,
	)
);

// Displays custom logo.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Adds support for custom header.
add_theme_support(
	'custom-header', array(
		'default-image'    => paradox_get_default_hero_background_image(),
		'header-text'      => false,
		'header-selector'  => '.header-hero',
		'flex-height'      => true,
		'flex-width'       => true,
		'height'           => 800,
		'width'            => 1600,
		'wp-head-callback' => 'paradox_header_style',
	)
);

// Registers default header image.
register_default_headers(
	array(
		'child' => array(
			'url'           => paradox_get_default_hero_background_image(),
			'thumbnail_url' => paradox_get_default_hero_background_image(),
			'description'   => __( 'Paradox Header Image', 'paradox' ),
		),
	)
);

// Change order of main stylesheet to override plugin styles.
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 99 );

// Adds support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Adds image sizes.
add_image_size( 'sidebar-featured-thumb', 70, 60, true );
add_image_size( 'featured-image', 800, 400, true );
add_image_size( 'header-hero', 1600, 800, true );

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Remove sidebars.
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

// Remove site layouts.
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Adds support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Enable shortcodes in text widgets.
add_filter( 'widget_text', 'do_shortcode' );

// Reposition footer widgets inside site footer.
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_footer', 'genesis_footer_widget_areas', 14 );

// Remove footer credits.
remove_action( 'genesis_footer', 'genesis_do_footer' );

// Force full-width-content layout setting.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove layout section from Theme Customizer.
add_action( 'customize_register', 'paradox_customize_register', 16 );
function paradox_customize_register( $wp_customize ) {
	$wp_customize->remove_section( 'genesis_layout' );
}

// Removes output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

add_action( 'genesis_theme_settings_metaboxes', 'paradox_remove_metaboxes' );
/**
 * Removes output of unused admin settings metaboxes.
 *
 * @param string $_genesis_admin_settings The admin screen to remove meta boxes from.
 */
function paradox_remove_metaboxes( $_genesis_admin_settings ) {

	remove_meta_box( 'genesis-theme-settings-header', $_genesis_admin_settings, 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_admin_settings, 'main' );

}

// Renames primary and secondary navigation menus.
add_theme_support(
	'genesis-menus', array(
		'primary'   => __( 'Header Menu', 'paradox' ),
		'secondary' => __( 'Footer Menu', 'paradox' ),
	)
);

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

add_filter( 'wp_nav_menu_args', 'paradox_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function paradox_secondary_menu_args( $args ) {

	if ( 'secondary' !== $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;
	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'paradox_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function paradox_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'paradox_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function paradox_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}

// Moves image above post title.
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );

// Removes the entry footer.
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

add_filter( 'genesis_post_info', 'paradox_modify_post_info' );
// /**
//  * Modifies the meta information in the entry header.
//  *
//  * @param string $post_info Current post info.
//  * @return string New post info.
//  */
function paradox_modify_post_info( $post_info ) {

	global $post;

	setup_postdata( $post );

		$post_info = '<p>Published on </p>[post_date]';
	
	return $post_info;

}

// Setup widget counts.
function paradox_count_widgets( $id ) {

	$sidebars_widgets = wp_get_sidebars_widgets();

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

/**
 * Gives class name based on widget count.
 *
 * @param string $id The widget ID.
 * @return string The class.
 */
function paradox_widget_area_class( $id ) {

	$count = paradox_count_widgets( $id );

	$class = '';

	if ( 1 === $count ) {
		$class .= ' widget-full';
	} elseif ( 0 === $count % 3 ) {
		$class .= ' widget-thirds';
	} elseif ( 0 === $count % 4 ) {
		$class .= ' widget-fourths';
	} elseif ( 1 === $count % 2 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;

}

/**
 * Helper function to handle outputting widget markup and classes.
 *
 * @param string $id The id of the widget area.
 */
function paradox_do_widget( $id ) {

	$count   = paradox_count_widgets( $id );
	$columns = paradox_widget_area_class( $id );

	genesis_widget_area(
		$id, array(
			'before' => "<div id=\"$id\" class=\"$id\"><div class=\"flexible-widgets widget-area $columns\"><div class=\"wrap\">",
			'after'  => '</div></div></div>',
		)
	);

}


// Register widget areas.
genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Front Page 1', 'paradox' ),
	'description' => __( 'This is the Services section on the home page.', 'paradox' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'paradox' ),
	'description' => __( 'This is the About and Testimonial section on the home page.', 'paradox' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'paradox' ),
	'description' => __( 'This is the Recent Case Studies section on the home page.', 'paradox' ),
) );
genesis_register_sidebar( array(
	'id'          => 'services-page',
	'name'        => __( 'Services Page', 'paradox' ),
	'description' => __( 'Services page widget area.', 'paradox' ),
) );
genesis_register_sidebar( array(
	'id'          => 'before-footer',
	'name'        => __( 'Before Footer', 'paradox' ),
	'description' => __( 'This is the call-to-action section.', 'paradox' ),
) );
genesis_register_sidebar( array(
	'id'          => 'footer-credits',
	'name'        => __( 'Footer Credits', 'paradox' ),
	'description' => __( 'Footer Credits widget area.', 'paradox' ),
) );

//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );

add_action( 'genesis_footer', 'paradox_before_footer' );
/**
 * Display Before Footer widget area.
 *
 * This widget area is hooked to the before footer wrap, inside of the
 * site-footer element and outside of the site-footer wrap creating
 * a full-width section above the footer widgets, keeping it all
 * semantically valid inside of the site-footer element scope.
 */
function paradox_before_footer() {

	genesis_widget_area( 'before-footer', array(
		'before' => '<div class="before-footer widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

add_action( 'genesis_footer', 'paradox_footer_credits', 14 );
/**
 * Display Footer Credits widget area.
 *
 * This widget area is hooked to the before footer wrap, inside of the
 * site-footer element and outside of the site-footer wrap creating
 * a full-width section above the footer widgets, keeping it all
 * semantically valid inside of the site-footer element scope.
 */
function paradox_footer_credits() {

	if ( is_active_sidebar( 'footer-credits' ) ) {
		paradox_do_widget( 'footer-credits' );
	}

}

