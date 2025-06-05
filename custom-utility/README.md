# Custom Utility Plugin

**Version:** 1.0.1
**Author:** Innocent (Candidate)
**License:** GPL v2 or later
**Requires WordPress Version:** 5.0 or higher
**Requires PHP Version:** 7.0 or higher

## Description

This plugin was developed as part of a WordPress Senior Developer practical assessment. It provides reusable utility functions and components, currently featuring a customizable Call to Action (CTA) button shortcode. It is designed to be lightweight and to complement the "Custom Theme" or be used independently.

## Setup Steps

1.  **Installation:**
    * Ensure you have a working WordPress installation.
    * Download or clone the `custom-utility` plugin directory.
    * Upload the entire `custom-utility` folder to your WordPress installation's `wp-content/plugins/` directory.
    * Alternatively, you can zip the `custom-utility` folder and upload it via the WordPress admin dashboard: "Plugins" > "Add New" > "Upload Plugin".

2.  **Activation:**
    * In the WordPress admin dashboard, navigate to the "Plugins" page.
    * Locate the "Custom Utility Plugin" in the list.
    * Click "Activate".

## Features Implemented

* **Call to Action (CTA) Button Shortcode:**
    * **Shortcode:** `[custom_cta_button]`
    * **Functionality:** Allows easy insertion of a styled button into posts, pages, or widgets that process shortcodes.
    * **Attributes:**
        * `text`: The text displayed on the button. (Default: "Learn More")
        * `link`: The URL the button links to. (Default: "#")
        * `class`: (Optional) Additional CSS classes to apply to the button for further custom styling (e.g., `is-style-outline`).
        * `new_tab`: (Optional) Set to `true` if the link should open in a new browser tab/window. (Default: `false`)
    * **Example Usage:**
        * Basic: `[custom_cta_button text="Discover More" link="/about-us"]`
        * With custom class and new tab: `[custom_cta_button text="Shop Now!" link="https://example.com/shop" class="shop-button large" new_tab="true"]`
* **Dedicated Stylesheet:**
    * The plugin enqueues its own stylesheet (`assets/css/custom-utility.css`) to provide default styling for the CTA button. This ensures a consistent base appearance.
* **Uninstall Logic:**
    * Includes a basic `uninstall.php` file. For current features, no specific data is stored that requires cleanup. The file serves as a best-practice placeholder for future enhancements.

## How to Modify or Extend Functionality

### Modifying the Existing Shortcode:
1.  **PHP Logic:**
    * Open `custom-utility.php`.
    * Locate the `custom_utility_cta_button_shortcode()` function.
    * You can change default attribute values in the `shortcode_atts()` array.
    * You can alter the generated HTML structure.
    * New attributes can be added to `shortcode_atts()` and then utilized within the function.
2.  **CSS Styling:**
    * Edit `assets/css/custom-utility.css` to change the appearance of the `.custom-cta-button` or add styles for new classes.

### Adding New Shortcodes:
1.  **Define Function:** In `custom-utility.php`, create a new PHP function that accepts an `$atts` array and returns your desired HTML string.
    ```php
    // Example for a new shortcode
    // function my_new_feature_shortcode_handler( $atts ) {
    //     $atts = shortcode_atts( array(
    //         'example_attr' => 'default_value',
    //     ), $atts, 'my_new_feature' );
    //     // ... your logic ...
    //     return "<div>My new feature with attribute: " . esc_html( $atts['example_attr'] ) . "</div>";
    // }
    ```
2.  **Register Shortcode:** Add a new line to register it with WordPress:
    ```php
    // add_shortcode( 'my_new_feature', 'my_new_feature_shortcode_handler' );
    ```

### Adding Other Functionalities (e.g., Admin Settings Page, Content Filter):
* **Admin Settings Page:**
    * Utilize the WordPress Settings API. Hook into `admin_menu` to add your page (e.g., `add_options_page()`). Hook into `admin_init` to register settings (`register_setting()`) and add fields (`add_settings_field()`, `add_settings_section()`).
* **Content Filter:**
    * Use `add_filter('the_content', 'your_filter_function');`. Your function will receive the content, modify it, and must return the modified content.
* All new PHP functions should be added within `custom-utility.php` or organized into included files if the plugin becomes more complex.

### Uninstall Process:
* If you add features that store plugin-specific options in the `wp_options` table or create custom database tables, update `uninstall.php` to include the necessary cleanup code (e.g., using `delete_option()` or `$wpdb->query("DROP TABLE ...")`).

