<?php
/**
 * ACF Blocks Registration.
 *
 * @package Custom_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'custom_theme_register_acf_blocks' ) ) {
	function custom_theme_register_acf_blocks() {
		if ( ! function_exists( 'acf_register_block_type' ) ) {
			return;
		}

		// Hero Section Block (Existing)
		acf_register_block_type(
			array(
				'name'            => 'custom/hero-section',
				'title'           => __( 'Hero Section', 'custom-theme' ),
				'description'     => __( 'A custom hero section with a background image, heading, and subheading.', 'custom-theme' ),
				'render_template' => 'template-parts/blocks/hero-section/hero-section.php',
				'category'        => 'custom-theme-category',
				'icon'            => 'format-image',
				'keywords'        => array( 'hero', 'banner', 'header', 'image', 'heading' ),
				'mode'            => 'preview',
				'align'           => 'full',
				'supports'        => array(
					'align'           => array( 'full', 'wide' ),
					'mode'            => true,
					'jsx'             => false,
					'anchor'          => true,
					'customClassName' => true,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'hero_heading'         => 'Inspiring Hero Heading Here',
							'hero_subheading'      => 'This is a compelling subheading that draws the user in.',
							'hero_background_image' => 'https://placehold.co/1920x600/0073aa/ffffff?text=Hero+Background',
							'hero_text_color'      => '#FFFFFF',
							'hero_min_height'      => 500,
							'hero_enable_overlay'  => true,
							'hero_overlay_color'   => 'rgba(0,0,0,0.3)',
						),
					),
				),
			)
		);

		// Intro Text Section Block (Existing)
		acf_register_block_type(
			array(
				'name'            => 'custom/intro-text-section',
				'title'           => __( 'Intro Text Section', 'custom-theme' ),
				'description'     => __( 'A section with a main heading and introductory text content.', 'custom-theme' ),
				'render_template' => 'template-parts/blocks/intro-text-section/intro-text-section.php',
				'category'        => 'custom-theme-category',
				'icon'            => 'text-page',
				'keywords'        => array( 'intro', 'text', 'heading', 'content', 'description' ),
				'mode'            => 'preview',
				'align'           => 'wide',
				'supports'        => array(
					'align'           => array( 'wide', 'full', 'center' ),
					'mode'            => true,
					'anchor'          => true,
					'customClassName' => true,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'intro_section_heading' => 'Nec accumsan massa pulvinar rhoncus dictum.',
							'intro_section_content' => 'Vel ultrices ornare arcu placerat viverra egestas sit. Cursus commodo vitae faucibus hac.',
						),
					),
				),
			)
		);

		// Text and Image Section Block (Existing)
		acf_register_block_type(
			array(
				'name'            => 'custom/text-image-section',
				'title'           => __( 'Text and Image Section', 'custom-theme' ),
				'description'     => __( 'A section with a heading, text, an optional button, and an image.', 'custom-theme' ),
				'render_template' => 'template-parts/blocks/text-image-section/text-image-section.php',
				'category'        => 'custom-theme-category',
				'icon'            => 'align-pull-left',
				'keywords'        => array( 'text', 'image', 'content', 'feature', 'button', 'column' ),
				'mode'            => 'preview',
				'align'           => '',
				'supports'        => array(
					'align'           => array( 'wide', 'full' ),
					'mode'            => true,
					'anchor'          => true,
					'customClassName' => true,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'text_image_heading'        => 'In molestie eros ac elit ac.',
							'text_image_content'        => 'Lorem ipsum dolor sit amet consectetur. Sapien aliquam morbi suspendisse velit commodo.',
							'text_image_button_text'    => 'Learn More',
							'text_image_button_link'    => array('url' => '#', 'title' => 'Learn More', 'target' => ''),
							'text_image_image'          => array('url' => 'https://placehold.co/600x400/cccccc/969696?text=Side+Image', 'alt' => 'Placeholder Image'),
							'text_image_image_position' => 'right',
						),
					),
				),
			)
		);

		// Latest Blogs Section Block (Existing)
		acf_register_block_type(
			array(
				'name'            => 'custom/latest-blogs-section',
				'title'           => __( 'Latest Blogs Section', 'custom-theme' ),
				'description'     => __( 'Displays a section with the latest blog posts.', 'custom-theme' ),
				'render_template' => 'template-parts/blocks/latest-blogs-section/latest-blogs-section.php',
				'category'        => 'custom-theme-category',
				'icon'            => 'admin-post',
				'keywords'        => array( 'posts', 'articles', 'news', 'latest', 'blogs', 'grid' ),
				'mode'            => 'preview',
				'align'           => 'wide',
				'supports'        => array(
					'align'           => array( 'wide', 'full' ),
					'mode'            => true,
					'anchor'          => true,
					'customClassName' => true,
				),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'latest_blogs_heading' => 'Latest blogs',
							'latest_blogs_count'   => 3,
							'latest_blogs_style'   => 'grid',
						),
					),
				),
			)
		);

		// NEW: Accordion Section Block
		acf_register_block_type(
			array(
				'name'            => 'custom/accordion-section', // Unique name for this block
				'title'           => __( 'Accordion Section', 'custom-theme' ), // Display title
				'description'     => __( 'Displays a section with expandable accordion items (FAQ style).', 'custom-theme' ),
				'render_template' => 'template-parts/blocks/accordion-section/accordion-section.php', // Path to the template file
				'category'        => 'custom-theme-category', // Assign to our custom category
				'icon'            => 'list-view', // Dashicon: https://developer.wordpress.org/resource/dashicons/#list-view or 'editor-ul'
				'keywords'        => array( 'accordion', 'faq', 'toggle', 'list', 'expandable' ),
				'mode'            => 'preview',
				'align'           => 'wide', // Default alignment
				'supports'        => array(
					'align'           => array( 'wide', 'full' ), // Supported alignments
					'mode'            => true,
					'anchor'          => true,
					'customClassName' => true,
				),
				'example'         => array( // Data for the block preview in the editor
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'accordion_main_heading' => 'Frequently Asked Questions',
							'accordion_items' => array(
								array(
									'accordion_item_title'   => 'What is the first question?',
									'accordion_item_content' => 'This is the answer to the first question. It can contain more details.',
								),
								array(
									'accordion_item_title'   => 'And what about the second item?',
									'accordion_item_content' => 'Here is the answer for the second item, providing further explanation.',
								),
							),
						),
					),
				),
			)
		);

	}
	//Breadcrumbs Block
acf_register_block_type(
    array(
        'name'            => 'custom/breadcrumbs-block',
        'title'           => __( 'Breadcrumbs', 'custom-theme' ),
        'description'     => __( 'Displays the breadcrumb navigation trail.', 'custom-theme' ),
        'render_template' => 'template-parts/blocks/breadcrumbs-block/breadcrumbs-block.php',
        'category'        => 'custom-theme-category', // Ensure this category is also registered
        'icon'            => 'ellipsis',
        'keywords'        => array( 'breadcrumbs', 'navigation', 'trail', 'path' ),
        'mode'            => 'preview',
        'supports'        => array(
            'align' => false,
            'mode'  => false,
            'jsx'   => false,
        ),
    )
);
//  Horizontal Rule Section Block
		acf_register_block_type(
			array(
				'name'            => 'custom/horizontal-rule-section',
				'title'           => __( 'Horizontal Rule Section', 'custom-theme' ),
				'description'     => __( 'Displays a styled horizontal rule within a padded section.', 'custom-theme' ),
				'render_template' => 'template-parts/blocks/horizontal-rule-section/horizontal-rule-section.php', // We created this template
				'category'        => 'custom-theme-category',
				'icon'            => 'minus', // Dashicon for a line
				'keywords'        => array( 'divider', 'separator', 'line', 'rule', 'hr' ),
				'mode'            => 'preview', // Shows a preview; 'edit' would show fields if any
				'supports'        => array(
					'align'           => array( 'wide', 'full' ), // Allow wide and full alignment for the section wrapper
					'mode'            => false, // No edit/preview mode switch needed for a simple display block
					'jsx'             => false,
					'anchor'          => true,  // Allow block-level anchors
					'customClassName' => true,
				),
				'example'         => array( // Shows a visual representation in the block inserter
					'attributes' => array(
						'mode' => 'preview',
						// No 'data' needed if there are no ACF fields for this block
						// If you add ACF fields later (e.g., for color, thickness), add them here.
					),
				),
			)
		);
}
add_action( 'acf/init', 'custom_theme_register_acf_blocks' );


// --- Category registration and JSON path functions (remain the same) ---
if ( ! function_exists( 'custom_theme_block_categories' ) ) {
	function custom_theme_block_categories( $categories, $editor_context ) {
		$is_post_context = ( $editor_context instanceof WP_Block_Editor_Context && $editor_context->post instanceof WP_Post ) || $editor_context instanceof WP_Post;

		if ( $is_post_context ) {
			$category_slugs = wp_list_pluck( $categories, 'slug' );
			if ( ! in_array( 'custom-theme-category', $category_slugs, true ) ) {
				$custom_category = array(
					'slug'  => 'custom-theme-category',
					'title' => __( 'Custom Theme Blocks', 'custom-theme' ),
					'icon'  => 'layout',
				);
				array_unshift( $categories, $custom_category );
			}
		}
		return $categories;
	}
}
if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
    add_filter( 'block_categories_all', 'custom_theme_block_categories', 10, 2 );
} else {
    add_filter( 'block_categories', 'custom_theme_block_categories', 10, 2 );
}

if ( ! function_exists( 'custom_acf_json_save_point' ) ) {
	function custom_acf_json_save_point( $path ) {
		$path = CUSTOM_THEME_DIR . '/acf-json';
		return $path;
	}
}
add_filter( 'acf/settings/save_json', 'custom_acf_json_save_point' );

if ( ! function_exists( 'custom_acf_json_load_point' ) ) {
	function custom_acf_json_load_point( $paths ) {
		$paths[] = CUSTOM_THEME_DIR . '/acf-json';
		return $paths;
	}
}
add_filter( 'acf/settings/load_json', 'custom_acf_json_load_point' );

?>
