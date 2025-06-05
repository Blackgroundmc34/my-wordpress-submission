<?php
/**
 * Plugin Name:       Custom Utility Plugin
 * Plugin URI:        https://example.com/plugins/custom-utility/
 * Description:       Encapsulates reusable functionality, including a custom Call to Action button shortcode.
 * Version:           1.0.1
 * Author:            Innocent
 * Author URI:        https://example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       custom-utility
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Define plugin constants
 */
if ( ! defined( 'CUSTOM_UTILITY_PLUGIN_VERSION' ) ) {
    define( 'CUSTOM_UTILITY_PLUGIN_VERSION', '1.0.1' );
}
if ( ! defined( 'CUSTOM_UTILITY_PLUGIN_DIR' ) ) {
    define( 'CUSTOM_UTILITY_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'CUSTOM_UTILITY_PLUGIN_URL' ) ) {
    define( 'CUSTOM_UTILITY_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}


/**
 * Register the [custom_cta_button] shortcode.
 */
if ( ! function_exists( 'custom_utility_cta_button_shortcode' ) ) {
    function custom_utility_cta_button_shortcode( $atts ) {
        $atts = shortcode_atts(
            array(
                'text'    => esc_html__( 'Learn More', 'custom-utility' ),
                'link'    => '#',
                'class'   => '', 
                'new_tab' => false,
            ),
            $atts,
            'custom_cta_button'
        );

        $button_text = esc_html( $atts['text'] );
        $button_link = esc_url( $atts['link'] );
        // Add 'button' class for general theme button styling, and our specific class
        $button_classes = 'button custom-cta-button ' . esc_attr( $atts['class'] ); 
        $target_attr = filter_var($atts['new_tab'], FILTER_VALIDATE_BOOLEAN) ? ' target="_blank" rel="noopener noreferrer"' : '';

        $html = '<a href="' . $button_link . '" class="' . trim( $button_classes ) . '"' . $target_attr . '>';
        $html .= $button_text;
        $html .= '</a>';

        return $html;
    }
}
add_shortcode( 'custom_cta_button', 'custom_utility_cta_button_shortcode' );


/**
 * Enqueue a simple stylesheet for the plugin.
 * This will style the .custom-cta-button.
 */
function custom_utility_enqueue_styles() {
   wp_enqueue_style(
       'custom-utility-styles', // Handle
       CUSTOM_UTILITY_PLUGIN_URL . 'assets/css/custom-utility.css', // Path to CSS file
       array(), // Dependencies
       CUSTOM_UTILITY_PLUGIN_VERSION // Version
   );
}
add_action( 'wp_enqueue_scripts', 'custom_utility_enqueue_styles' ); // Hook to enqueue styles on front end

?>
