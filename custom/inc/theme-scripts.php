<?php
/**
 * Enqueue scripts for the theme.
 *
 * @package Custom_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'custom_theme_scripts' ) ) :
	/**
	 * Enqueue scripts and styles.
	 *
	 * This function is hooked into 'wp_enqueue_scripts'.
	 */
	function custom_theme_scripts() {
		$use_minified = function_exists('custom_theme_use_minified_assets') && custom_theme_use_minified_assets();
		$suffix = $use_minified ? '.min' : '';

		wp_enqueue_script(
			'custom-theme-main', // Handle
			CUSTOM_THEME_URI . '/assets/js/main' . $suffix . '.js', // Path to the file
			array( 'jquery' ), // Dependencies (e.g., jQuery). Add others if needed.
			CUSTOM_THEME_VERSION, // Version number (defined in functions.php)
			true // Load in footer
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'custom_theme_scripts' );


if ( ! function_exists( 'custom_theme_editor_scripts' ) ) :
    function custom_theme_editor_scripts() {
    }
endif;
// add_action( 'enqueue_block_editor_assets', 'custom_theme_editor_scripts' );

/**

 * @return bool True to use minified assets, false otherwise.
 */
if ( ! function_exists( 'custom_theme_use_minified_assets' ) ) {
    function custom_theme_use_minified_assets() {
        return false; 
    }
}

?>
