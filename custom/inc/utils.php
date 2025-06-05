<?php
/**
 * Utility functions for the theme.
 *
 * This file is for general helper functions that can be used throughout the theme.
 *
 * @package Custom_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Function to determine if minified assets should be used.
 */
if ( ! function_exists( 'custom_theme_use_minified_assets' ) ) {
	function custom_theme_use_minified_assets() {
		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			return false;
		}
		return true;
	}
}

/**
 * Safe way to get ACF field values.
 */
if ( ! function_exists( 'custom_safe_get_field' ) ) {
	function custom_safe_get_field( $selector, $post_id = false, $format_value = true, $default_value = null ) {
		if ( class_exists( 'ACF' ) && function_exists( 'get_field' ) ) {
			$value = get_field( $selector, $post_id, $format_value );
			if ( $value === null || $value === '' ) {
				return $default_value;
			}
			return $value;
		}
		return $default_value;
	}
}

/**
 * Safe way to echo ACF field values using the_field.
 */
if ( ! function_exists( 'custom_safe_the_field' ) ) {
	function custom_safe_the_field( $selector, $post_id = false, $default_content = '' ) {
		if ( class_exists( 'ACF' ) && function_exists( 'get_field' ) ) {
			$value = get_field( $selector, $post_id );
			if ( $value ) {
				the_field( $selector, $post_id );
			} elseif ( $default_content !== '' ) {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $default_content;
			}
		} elseif ( $default_content !== '' ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $default_content;
		}
	}
}

/**
 * Safe way to get ACF sub_field values.
 */
if ( ! function_exists( 'custom_safe_get_sub_field' ) ) {
	function custom_safe_get_sub_field( $selector, $format_value = true, $default_value = null ) {
		if ( class_exists( 'ACF' ) && function_exists( 'get_sub_field' ) ) {
			$value = get_sub_field( $selector, $format_value );
			if ( $value === null || $value === '' ) {
				return $default_value;
			}
			return $value;
		}
		return $default_value;
	}
}

/**
 * Safe way to echo ACF sub_field values using the_sub_field.
 */
if ( ! function_exists( 'custom_safe_the_sub_field' ) ) {
	function custom_safe_the_sub_field( $selector, $default_content = '' ) {
		if ( class_exists( 'ACF' ) && function_exists( 'get_sub_field' ) ) {
			$value = get_sub_field( $selector );
			if ( $value ) {
				the_sub_field( $selector );
			} elseif ( $default_content !== '' ) {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $default_content;
			}
		} elseif ( $default_content !== '' ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $default_content;
		}
	}
}

/**
 * Custom function to get the theme logo with fallback to site title.
 */
if ( ! function_exists( 'custom_theme_logo' ) ) {
	function custom_theme_logo( $linked = true, $size = 'full' ) {
		$output = '';
		$theme_asset_logo_path = CUSTOM_THEME_DIR . '/assets/images/logo.png';
		$theme_asset_logo_uri  = CUSTOM_THEME_URI . '/assets/images/logo.png';

		if ( file_exists( $theme_asset_logo_path ) ) {
			$site_title = get_bloginfo( 'name' );
			$output = '<img src="' . esc_url( $theme_asset_logo_uri ) . '" alt="' . esc_attr( $site_title ) . ' logo" class="site-logo custom-theme-asset-logo">';
			if ( $linked ) {
				$output = '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . $output . '</a>';
			}
		} elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			if ($linked) {
				$output = get_custom_logo();
			} else {
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$image_data = wp_get_attachment_image_src( $custom_logo_id, $size );
				if ($image_data) {
					$output = '<img src="' . esc_url( $image_data[0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . ' logo" width="' . esc_attr($image_data[1]) . '" height="' . esc_attr($image_data[2]) . '" class="custom-logo">';
				}
			}
		} elseif ( get_bloginfo( 'name' ) ) {
			$title_tag = ( is_front_page() && is_home() ) ? 'h1' : 'p';
			$output = sprintf(
				'<%1$s class="site-title"><a href="%2$s" rel="home">%3$s</a></%1$s>',
				tag_escape( $title_tag ),
				esc_url( home_url( '/' ) ),
				esc_html( get_bloginfo( 'name' ) )
			);
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) {
				$output .= '<p class="site-description">' . esc_html( $description ) . '</p>';
			}
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $output;
	}
}

/**
 * Generates custom excerpt with a specified length.
 */
if ( ! function_exists( 'custom_get_excerpt' ) ) {
    function custom_get_excerpt( $length = 55, $post_id = null ) {
        $post = get_post( $post_id );
        if ( ! $post ) {
            return '';
        }
        if ( has_excerpt( $post->ID ) ) {
            $excerpt = get_the_excerpt( $post->ID );
        } else {
            $excerpt = $post->post_content;
        }
        $excerpt = strip_shortcodes( $excerpt );
        $excerpt = function_exists('excerpt_remove_blocks') ? excerpt_remove_blocks( $excerpt ) : $excerpt;
        $excerpt = wp_strip_all_tags( $excerpt );
        $excerpt = wp_trim_words( $excerpt, $length, ' &hellip;' );
        return apply_filters( 'custom_get_excerpt', $excerpt, $post );
    }
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function custom_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'custom_theme_pingback_header' );


/**
 * Displays breadcrumbs for the current page.
 * Updated to allow display on a static front page.
 *
 * @param array $args Optional. Arguments to customize the breadcrumbs.
 */
if ( ! function_exists( 'custom_theme_breadcrumbs' ) ) {
	function custom_theme_breadcrumbs( $args = array() ) {

		$defaults = array(
			'separator_icon'     => '>',
			'home_title'         => esc_html__( 'Home', 'custom-theme' ),
			'container_before'   => '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumbs', 'custom-theme' ) . '"><ol itemscope itemtype="https://schema.org/BreadcrumbList">',
			'container_after'    => '</ol></nav>',
			'item_before'        => '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">',
			'item_after'         => '</li>',
			'link_before'        => '<span itemprop="name">',
			'link_after'         => '</span>',
			'current_item_before' => '<span itemprop="name" aria-current="page">',
			'current_item_after'  => '</span>',
		);
		$args = wp_parse_args( $args, $defaults );

		global $post;
		$items = array();
		$position = 1;

		// Add "Home" link unless it's the front page and its title IS "Home".
		if ( ! is_front_page() || (is_front_page() && get_the_title() && strtolower(get_the_title()) !== strtolower($args['home_title']) ) ) {
			$items[] = $args['item_before']
						. '<a itemprop="item" href="' . esc_url( home_url( '/' ) ) . '">'
						. $args['link_before'] . esc_html( $args['home_title'] ) . $args['link_after']
						. '</a><meta itemprop="position" content="' . $position++ . '" />'
						. $args['item_after'];
		}

		if ( is_front_page() ) {
			// For a static front page, if its title is not "Home", display its title as the current item.
			// If "Home" link was already added (because title isn't "Home"), this becomes the current item.
			// If "Home" link was NOT added (because title IS "Home"), this also becomes the current item.
			$front_page_title = get_the_title();
			if ($front_page_title) { // Only add if there's a title
				$items[] = $args['item_before']
							. $args['current_item_before'] . esc_html( $front_page_title ) . $args['current_item_after']
							. '<meta itemprop="position" content="' . $position++ . '" />'
							. $args['item_after'];
			}
		} elseif ( is_home() && ! is_front_page() ) { // Blog posts page
			$blog_page_id = get_option( 'page_for_posts' );
			if ( $blog_page_id ) {
				$items[] = $args['item_before']
							. $args['current_item_before'] . esc_html( get_the_title( $blog_page_id ) ) . $args['current_item_after']
							. '<meta itemprop="position" content="' . $position++ . '" />'
							. $args['item_after'];
			}
		} elseif ( is_page() && $post && $post->post_parent ) { // Page with ancestors
			$ancestors = get_post_ancestors( $post->ID );
			$ancestors = array_reverse( $ancestors );
			foreach ( $ancestors as $ancestor_id ) {
				$items[] = $args['item_before']
							. '<a itemprop="item" href="' . esc_url( get_permalink( $ancestor_id ) ) . '">'
							. $args['link_before'] . esc_html( get_the_title( $ancestor_id ) ) . $args['link_after']
							. '</a><meta itemprop="position" content="' . $position++ . '" />'
							. $args['item_after'];
			}
			if (get_the_title()) {
				$items[] = $args['item_before']
							. $args['current_item_before'] . esc_html( get_the_title() ) . $args['current_item_after']
							. '<meta itemprop="position" content="' . $position++ . '" />'
							. $args['item_after'];
			}
		} elseif ( is_singular() ) { // Single post, CPT, or page without parent (but not front page, handled above)
			$post_type = get_post_type_object( get_post_type() );
			if ( $post_type && $post_type->has_archive && !is_page() && isset($post_type->labels) ) {
				$items[] = $args['item_before']
							. '<a itemprop="item" href="' . esc_url( get_post_type_archive_link( get_post_type() ) ) . '">'
							. $args['link_before'] . esc_html( $post_type->labels->singular_name ) . $args['link_after']
							. '</a><meta itemprop="position" content="' . $position++ . '" />'
							. $args['item_after'];
			}
			if (get_the_title()) {
				$items[] = $args['item_before']
							. $args['current_item_before'] . esc_html( get_the_title() ) . $args['current_item_after']
							. '<meta itemprop="position" content="' . $position++ . '" />'
							. $args['item_after'];
			}
		} elseif ( is_category() || is_tag() || is_tax() ) {
			$term = get_queried_object();
			if ( $term ) {
				if ( $term->parent != 0 ) {
					$ancestors = get_ancestors( $term->term_id, $term->taxonomy );
					$ancestors = array_reverse( $ancestors );
					foreach ( $ancestors as $ancestor_id ) {
						$ancestor_term = get_term( $ancestor_id, $term->taxonomy );
						if ($ancestor_term && !is_wp_error($ancestor_term)) {
							$items[] = $args['item_before']
										. '<a itemprop="item" href="' . esc_url( get_term_link( $ancestor_term ) ) . '">'
										. $args['link_before'] . esc_html( $ancestor_term->name ) . $args['link_after']
										. '</a><meta itemprop="position" content="' . $position++ . '" />'
										. $args['item_after'];
						}
					}
				}
				$items[] = $args['item_before']
							. $args['current_item_before'] . esc_html( $term->name ) . $args['current_item_after']
							. '<meta itemprop="position" content="' . $position++ . '" />'
							. $args['item_after'];
			}
		} elseif ( is_search() ) {
			$items[] = $args['item_before']
						. $args['current_item_before'] . sprintf( esc_html__( 'Search results for "%s"', 'custom-theme' ), esc_html( get_search_query() ) ) . $args['current_item_after']
						. '<meta itemprop="position" content="' . $position++ . '" />'
						. $args['item_after'];
		} elseif ( is_404() ) {
			$items[] = $args['item_before']
						. $args['current_item_before'] . esc_html__( 'Error 404', 'custom-theme' ) . $args['current_item_after']
						. '<meta itemprop="position" content="' . $position++ . '" />'
						. $args['item_after'];
		}

		if ( !empty( $items ) ) {
			echo $args['container_before']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo implode( ' <span class="breadcrumb-separator">' . esc_html( $args['separator_icon'] ) . '</span> ', $items ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $args['container_after']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
?>
