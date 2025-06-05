<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * This template is used when WordPress cannot find the requested page.
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Custom_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); // Loads the header.php template.
?>

	<main id="content" class="site-content error-404 not-found" role="main">

		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'custom-theme' ); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'custom-theme' ); ?></p>

			<?php
			get_search_form(); // Displays the WordPress search form.

			// Optional: Display recent posts.
			the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 5 ), array( 'before_title' => '<h2 class="widget-title">', 'after_title' => '</h2>' ) );
			?>

			<div class="widget widget_categories">
				<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'custom-theme' ); ?></h2>
				<ul>
					<?php
					wp_list_categories(
						array(
							'orderby'    => 'count',
							'order'      => 'DESC',
							'show_count' => 1,
							'title_li'   => '',
							'number'     => 10, // Show top 10 categories.
						)
					);
					?>
				</ul>
			</div><!-- .widget_categories -->

			<?php
			// Optional: Display an archive by month.
			/* translators: %s: smiley */
			$custom_theme_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %s', 'custom-theme' ), convert_smilies( ':)' ) ) . '</p>';
			the_widget( 'WP_Widget_Archives', array( 'dropdown' => 1, 'count' => 1 ), array( 'before_title' => '<h2 class="widget-title">', 'after_title' => '</h2>', 'after_widget' => $custom_theme_archive_content ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			// Optional: Display tag cloud.
			// the_widget( 'WP_Widget_Tag_Cloud' );
			?>

		</div><!-- .page-content -->
	</main><!-- #content -->

<?php
get_footer(); // Loads the footer.php template.
?>
