<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * This template is called by index.php, archive.php, search.php, etc., when no posts are found.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Custom_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'custom-theme' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : // If on home page and user can publish.
			?>
			<p>
				<?php
				printf(
					wp_kses(
						/* translators: 1: Link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'custom-theme' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>
		<?php elseif ( is_search() ) : // If on a search results page. ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'custom-theme' ); ?></p>
			<?php get_search_form(); // Display the search form. ?>
		<?php else : // For all other cases (empty archives, etc.). ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'custom-theme' ); ?></p>
			<?php get_search_form(); // Display the search form. ?>
		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
