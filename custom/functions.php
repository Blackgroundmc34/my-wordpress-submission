<?php
/**
 * Custom Theme functions and definitions
 *
 * This file is the main functions file for the "custom" theme.
 * It includes other necessary files from the /inc directory and sets up
 * core theme functionalities.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Custom_Theme
 * @folder  custom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly to prevent direct access to the file.
}

// Define Theme Version. Used for cache-busting of scripts and styles.
if ( ! defined( 'CUSTOM_THEME_VERSION' ) ) {
	// Get the theme data.
	$theme_data = wp_get_theme();
	// Use the theme's version from style.css, or fallback to 1.0.0.
	define( 'CUSTOM_THEME_VERSION', $theme_data->get( 'Version' ) ? $theme_data->get( 'Version' ) : '1.0.0' );
}

// Define Theme Directory Path. For referencing files within the theme.
if ( ! defined( 'CUSTOM_THEME_DIR' ) ) {
	define( 'CUSTOM_THEME_DIR', get_template_directory() );
}

// Define Theme Directory URI. For referencing assets like CSS, JS, images.
if ( ! defined( 'CUSTOM_THEME_URI' ) ) {
	define( 'CUSTOM_THEME_URI', get_template_directory_uri() );
}

// Define Theme Text Domain. Used for internationalization.
// This should match the "Text Domain" in style.css.
if ( ! defined( 'CUSTOM_THEME_TEXT_DOMAIN' ) ) {
	define( 'CUSTOM_THEME_TEXT_DOMAIN', 'custom-theme' );
}


/**
 * Theme bootstrapping.
 *
 * Includes all the necessary files for the theme to function correctly,
 * as specified in the project requirements.
 * The order of inclusion can be important for dependencies.
 * These files are located in the /inc/ directory.
 */
$custom_theme_required_files = array(
	'/inc/theme-setup.php',   // Core theme setup, supports, nav menus, etc.
	'/inc/theme-styles.php',  // Enqueue theme stylesheets.
	'/inc/theme-scripts.php', // Enqueue theme JavaScript files.
	'/inc/utils.php',         // Utility functions and helpers.
	'/inc/acf-blocks.php',    // ACF Blocks registration and functionality.
);

foreach ( $custom_theme_required_files as $file ) {
	$filepath = CUSTOM_THEME_DIR . $file;
	if ( file_exists( $filepath ) ) {
		require_once $filepath;
	} else {
		// Optionally, log an error or add an admin notice if a required file is missing,
		// especially during development. This can help identify if a file path is wrong or a file is missing.
		// error_log( "Error: Required theme file is missing: " . esc_html( $filepath ) );
		// if (is_admin()) { // Only show admin notices in the backend
		// add_action( 'admin_notices', function() use ( $filepath ) {
		// echo '<div class="notice notice-error"><p>Required theme file missing: ' . esc_html( basename( $filepath ) ) . '. Please check your theme installation in /inc/ directory.</p></div>';
		// });
		// }
	}
}


/**
 * Summary of custom_theme_enqueue_styles
 * @return void
 * calling font-awesome
 */
function custom_theme_enqueue_styles() {
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css' );
}
add_action( 'wp_enqueue_scripts', 'custom_theme_enqueue_styles' );



?>
