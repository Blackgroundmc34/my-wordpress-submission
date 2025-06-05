<?php
/**
 * Theme setup functions.
 *
 * This file is included by functions.php and is responsible for
 * setting up theme defaults, registering theme support for various features,
 * and registering navigation menus.
 *
 * @package Custom_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'custom_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function custom_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( CUSTOM_THEME_TEXT_DOMAIN, CUSTOM_THEME_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		// set_post_thumbnail_size( 1200, 9999 ); // Optional: Set a default thumbnail size

		/**
		 * Register navigation menus.
		 * This is where we register the 'primary' menu location for the header.
		 */
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', CUSTOM_THEME_TEXT_DOMAIN ),
				// 'footer'  => esc_html__( 'Footer Menu', CUSTOM_THEME_TEXT_DOMAIN ), // Example for another menu
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style', // For <style> tags.
				'script', // For <script> tags.
			)
		);

		/*
		 * Enable support for Post Formats.
		 * @link https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		// add_theme_support(
		// 'post-formats',
		// array(
		// 'aside',
		// 'image',
		// 'video',
		// 'quote',
		// 'link',
		// 'gallery',
		// 'status',
		// 'audio',
		// 'chat',
		// )
		// );

		// Set up the WordPress core custom background feature (optional).
		// add_theme_support(
		// 'custom-background',
		// apply_filters(
		// 'custom_theme_custom_background_args',
		// array(
		// 'default-color' => 'ffffff',
		// 'default-image' => '',
		// )
		// )
		// );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100, // Example: Adjust to your logo's needs
				'width'       => 300, // Example: Adjust
				'flex-width'  => true,
				'flex-height' => true,
				// 'header-text' => array( 'site-title', 'site-description' ), // Display site title and tagline if no logo
			)
		);

		/**
		 * Add editor styles.
		 * This will be more effective when using theme.json or a specific editor-style.css.
		 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#editor-styles
		 */
		add_theme_support( 'editor-styles' );

		// add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Enable responsive embeds.
		 * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-media
		 */
		add_theme_support( 'responsive-embeds' );

		/**
		 * Enable wide and full alignments for Gutenberg blocks.
		 */
		add_theme_support( 'align-wide' );

		/**
		 * Default block editor styles.
		 * If you are using theme.json, many of these can be controlled from there.
		 */
		add_theme_support( 'wp-block-styles' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for custom units.
		add_theme_support( 'custom-units' );

		// Add support for link color control.
		add_theme_support( 'link-color' );

		// Add support for custom spacing.
		add_theme_support( 'custom-spacing' );

		// Remove core block patterns (optional, if you want full control or provide your own).
		// remove_theme_support( 'core-block-patterns' );

	}
endif; // custom_theme_setup
add_action( 'after_setup_theme', 'custom_theme_setup' );

/**

 * @global int $content_width
 */
if ( ! function_exists( 'custom_theme_content_width' ) ) {
	function custom_theme_content_width() {
	
		$GLOBALS['content_width'] = apply_filters( 'custom_theme_content_width', 800 ); // Default content width, adjust as needed
	}
}
add_action( 'after_setup_theme', 'custom_theme_content_width', 0 );

/**
 * Register widget area (optional).
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
?>
