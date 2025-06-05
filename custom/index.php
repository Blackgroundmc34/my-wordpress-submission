<?php
/**
 * The main template file.
 *
 * @package Custom_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>



<main id="content" class="site-content" role="main">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php if ( is_singular() ) : // For single posts, pages, CPTs ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
					// For pages, the_content() outputs block editor content including Hero block
					the_content();
					?>
				</article>

				<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>

			<?php else : // For archive views (blog index, category, etc.) ?>

				<?php
				get_template_part(
					'template-parts/content/content',
					get_post_format() ?: 'standard'
				);
				?>

			<?php endif; ?>

		<?php endwhile; ?>

		<?php
		// Pagination for archive views
		if ( ! is_singular() ) :
			the_posts_pagination(
				array(
					'prev_text'          => esc_html__( 'Previous', 'custom-theme' ),
					'next_text'          => esc_html__( 'Next', 'custom-theme' ),
					'before_page_number' => '<span class="screen-reader-text">' . esc_html__( 'Page', 'custom-theme' ) . ' </span>',
				)
			);
		endif;
		?>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content/content', 'none' ); ?>

	<?php endif; ?>
</main><?php
// get_sidebar();
get_footer();
?>
