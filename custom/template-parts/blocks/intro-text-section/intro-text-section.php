<?php
/**
 * Intro Text Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Custom_Theme
 */

// Block ID
$block_id = 'intro-text-section-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Block class
$block_class = 'wp-block-custom-intro-text-section';
if ( ! empty( $block['className'] ) ) {
	$block_class .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$block_class .= ' align' . $block['align']; // e.g., alignwide, alignfull, aligncenter
}

// Get ACF fields
$heading = custom_safe_get_field( 'intro_section_heading' );
$content = custom_safe_get_field( 'intro_section_content' ); // This will be HTML if WYSIWYG

?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $block_class ); ?>">
	<div class="container intro-text-section-inner"> <?php // Standard container for content width ?>
		<?php if ( $heading ) : ?>
			<h2 class="intro-section-heading"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $content ) : ?>
			<div class="intro-section-content">
				<?php echo wp_kses_post( $content ); // Use wp_kses_post for WYSIWYG content ?>
			</div>
		<?php endif; ?>
	</div>
</section>
