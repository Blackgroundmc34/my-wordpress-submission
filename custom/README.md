# Custom Theme for WordPress

**Version:** 1.0.0
**Author:** Innocent (Candidate)

This theme was developed as part of a WordPress Senior Developer practical assessment. It is a custom, modular WordPress theme built from scratch, designed to adhere to modern development practices and based on the provided design specifications.

## Setup Steps

1.  **Prerequisites:**
    * A working WordPress installation (latest stable version recommended).
    * **ACF PRO plugin:** Must be installed and activated. This theme relies heavily on ACF PRO for its custom block functionality.
    * **`custom-utility` plugin:** The companion plugin (located in the `custom-utility` folder) should be installed and activated from the WordPress admin (`Plugins > Add New > Upload Plugin`, then Activate).

2.  **Theme Installation:**
    * Place the `custom` theme directory into your WordPress installation's `wp-content/themes/` folder.
    * Alternatively, zip the `custom` theme directory and upload it via the WordPress admin dashboard: "Appearance" > "Themes" > "Add New" > "Upload Theme".

3.  **Theme Activation:**
    * In the WordPress admin dashboard, navigate to "Appearance" > "Themes".
    * Locate the "Custom Theme" and click "Activate".

4.  **ACF JSON Synchronization:**
    * After activating the theme and ensuring ACF PRO is active, navigate to "Custom Fields" > "Field Groups" in the WordPress admin.
    * ACF PRO should automatically detect the JSON field group files located in the theme's `acf-json/` directory.
    * If you see a "Sync available" notice, click it to import/synchronize the field groups. This makes all custom fields for the blocks available.

5.  **Menu Setup:**
    * Navigate to "Appearance" > "Menus".
    * Create a new menu (or select an existing one).
    * Assign this menu to the "Primary Menu" theme location for the main site navigation.

6.  **Homepage Setup (Example):**
    * Create a new page (e.g., named "Home" or "Homepage").
    * In the WordPress editor, add the custom blocks created (e.g., "Hero Section", "Intro Text Section", "Text and Image Section", "Latest Blogs Section", "Accordion Section", "Breadcrumbs Block") to build the homepage layout as per the design.
    * Populate the fields for each block with your desired content.
    * Go to "Settings" > "Reading" in the WordPress admin.
    * Set "Your homepage displays" to "A static page".
    * Select your newly created page as the "Homepage".
    * Save changes.

7.  **Permalink Settings:**
    * It's generally recommended to set permalinks to "Post name" or another SEO-friendly structure under "Settings" > "Permalinks".

## Features Implemented

* **Custom Theme Structure:** Follows WordPress standards with `style.css`, `functions.php`, `index.php`, `header.php`, `footer.php`, `404.php`, `theme.json`, and an organized folder structure (`inc/`, `assets/css/`, `assets/js/`, `template-parts/blocks/`, `template-parts/content/`, `acf-json/`).
* **`theme.json` Integration:** For global settings, styles (colors, typography, layout), and block editor enhancements.
* **Modular, Component-Based Architecture with ACF Blocks:**
    * **Hero Section Block (`custom/hero-section`):** Full-width section with background image, heading, subheading, optional overlay, and integrated breadcrumbs. Configurable via ACF fields.
    * **Intro Text Section Block (`custom/intro-text-section`):** Displays a prominent heading and a paragraph of introductory text, typically centered.
    * **Text and Image Section Block (`custom/text-image-section`):** Displays text content (heading, paragraph, optional button) alongside an image, with configurable image position (left/right).
    * **Latest Blogs Section Block (`custom/latest-blogs-section`):** Shows a grid of recent blog posts, configurable for title, post count, and category filtering.
    * **Accordion Section Block (`custom/accordion-section`):** Creates an FAQ-style section with expandable/collapsible items, each having a title and rich text content.
    * **Breadcrumbs Block (`custom/breadcrumbs-block`):** A simple block to display breadcrumb navigation trail.
* **ACF JSON Synchronization:** Custom field groups for blocks are stored in the `acf-json/` directory for version control and deployment.
* **Responsive Design:** Styles in `assets/css/main.css` are structured to adapt the layout for desktop, tablet, and mobile devices based on the provided design.
* **Asset Management:**
    * CSS and JavaScript files are organized and enqueued correctly via `inc/theme-styles.php` and `inc/theme-scripts.php`.
    * Includes a function to toggle loading of minified assets (based on `SCRIPT_DEBUG`).
* **Helper Functions (`inc/utils.php`):**
    * `custom_safe_get_field()`: For safely retrieving ACF field values.
    * `custom_theme_breadcrumbs()`: Generates and displays breadcrumb navigation.
    * Other utilities as developed.
* **Basic Template Hierarchy:** Includes `index.php`, page/post content display via `template-parts/content/content.php` and `content-none.php`.
* **Accessibility:** Basic considerations such as semantic HTML, ARIA attributes for interactive elements (mobile menu, accordion), and skip links are included.

## How to Modify or Extend Functionality

### Theme Options & Styling:
* **Global Styles (Colors, Typography, Layout):** Modify `theme.json` for theme-wide design tokens and settings.
* **Component-Specific Styles:** Edit `assets/css/main.css`. Styles are generally organized by block or section.
* **JavaScript Interactivity:** Modify or add scripts in `assets/js/main.js` (e.g., for new interactive components). Remember to enqueue new JS files in `inc/theme-scripts.php`.

### ACF Blocks:
1.  **Modify Existing Blocks:**
    * **Fields:** Edit the corresponding field group in "Custom Fields" > "Field Groups". Sync JSON to `acf-json/`.
    * **Template:** Modify the block's PHP template in the `template-parts/blocks/BLOCK-NAME/BLOCK-NAME.php` file.
    * **Styles:** Adjust CSS in `assets/css/main.css`.
2.  **Add New ACF Blocks:**
    * **Define Fields:** Create a new ACF Field Group for your new block.
    * **Register Block:** In `inc/acf-blocks.php`, add a new `acf_register_block_type()` array. Define `name`, `title`, `render_template`, `category`, `icon`, `keywords`, `supports`, and `example` data.
    * **Create Template:** Create the PHP file specified in `render_template` (e.g., `template-parts/blocks/new-block/new-block.php`). Use `custom_safe_get_field()` or standard ACF functions to get field values and output HTML.
    * **Add CSS:** Style your new block in `assets/css/main.css`.
    * **Link Field Group:** Set the Location Rule for your new ACF Field Group to `Block` is equal to `Your New Block Title`.

### Theme Functionality:
* **Theme Setup (Supports, Menus, Image Sizes):** Modify `inc/theme-setup.php`.
* **Custom PHP Functions/Hooks:** Add to `inc/utils.php` or create new files in the `inc/` directory and include them in `functions.php`.

### Child Theming:
* For significant modifications or to ensure easier updates of the base "Custom Theme" in a real-world scenario, creating a WordPress Child Theme is the recommended approach.

