<?php
/**
 * Enqueue styles for the theme.
 *
 * @package Custom_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'custom_theme_styles' ) ) :
	/**
	 * Enqueue stylesheets for the front end.
	 *
	 * This function is hooked into 'wp_enqueue_scripts'.
	 */
	function custom_theme_styles() {

		$use_minified = function_exists('custom_theme_use_minified_assets') && custom_theme_use_minified_assets();
		$suffix       = $use_minified ? '.min' : '';

		wp_enqueue_style(
			'custom-theme-style', 
			get_stylesheet_uri(), 
			array(),              
			CUSTOM_THEME_VERSION  
		);

		wp_enqueue_style(
			'custom-theme-main-styles',
			CUSTOM_THEME_URI . '/assets/css/main' . $suffix . '.css', 
			array( 'custom-theme-style' ), 
			CUSTOM_THEME_VERSION         
		);

		
	}
endif;
add_action( 'wp_enqueue_scripts', 'custom_theme_styles' );


if ( ! function_exists( 'custom_theme_editor_styles' ) ) :
    /**
     * Enqueue styles for the block editor.
     
     */
    function custom_theme_editor_styles_advanced() {

    }
endif;
// add_action( 'enqueue_block_editor_assets', 'custom_theme_editor_styles_advanced' );

?>
