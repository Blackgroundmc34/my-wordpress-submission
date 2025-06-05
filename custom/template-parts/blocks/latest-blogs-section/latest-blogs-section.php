<?php
/**
 * Latest Blogs Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Custom_Theme
 */

// Block ID
$block_id = 'latest-blogs-section-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Block classes
$block_class = 'wp-block-custom-latest-blogs-section';
if ( ! empty( $block['className'] ) ) {
	$block_class .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$block_class .= ' align' . $block['align'];
}

// Get ACF fields
$section_heading = custom_safe_get_field( 'latest_blogs_heading', false, true, __( 'Latest blogs', 'custom-theme' ) );
$posts_count     = custom_safe_get_field( 'latest_blogs_count', false, true, 3 );
$display_style   = custom_safe_get_field( 'latest_blogs_style', false, true, 'grid' );
$category_id     = custom_safe_get_field( 'latest_blogs_category' ); // Term ID

// WP_Query arguments
$args = array(
	'post_type'      => 'post',
	'posts_per_page' => intval( $posts_count ),
	'post_status'    => 'publish',
	'orderby'        => 'date',
	'order'          => 'DESC',
);

if ( ! empty( $category_id ) && is_numeric( $category_id ) ) {
	$args['cat'] = intval( $category_id );
}

$latest_posts_query = new WP_Query( $args );

$block_class .= ' display-style-' . esc_attr( $display_style );

?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $block_class ); ?>">
	<div class="container latest-blogs-section-inner">
		<?php if ( $section_heading ) : ?>
			<h2 class="latest-blogs-main-heading"><?php echo esc_html( $section_heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $latest_posts_query->have_posts() ) : ?>
			<div class="latest-blogs-grid">
				<?php
				while ( $latest_posts_query->have_posts() ) :
					$latest_posts_query->the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'latest-blog-item' ); ?>>
						<div class="latest-blog-item-inner">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="latest-blog-thumbnail">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); // Keep for accessibility of the link ?>">
										<?php the_post_thumbnail( 'medium_large' ); ?>
									</a>
								</div>
							<?php else : ?>
								<div class="latest-blog-thumbnail placeholder">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<img src="https://placehold.co/600x400/e0e0e0/969696?text=<?php echo esc_attr_x( 'No+Image', 'Placeholder text for missing blog image', 'custom-theme' ); ?>" alt="<?php esc_attr_e( 'Placeholder Image', 'custom-theme' ); ?>" />
									</a>
								</div>
							<?php endif; ?>

							<?php // REMOVED entry-header and entry-title from here ?>

							<div class="entry-summary">
								<?php echo wp_kses_post( custom_get_excerpt( 20 ) ); // Display a custom length excerpt (e.g., 20 words from design) ?>
							</div></div></article><?php
				endwhile;
				wp_reset_postdata(); // Restore original Post Data
				?>
			</div><?php else : ?>
			<p><?php esc_html_e( 'No recent blog posts found.', 'custom-theme' ); ?></p>
		<?php endif; ?>
	</div></section>
