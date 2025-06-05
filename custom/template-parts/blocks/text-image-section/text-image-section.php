<?php
/**
 * Text and Image Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Custom_Theme
 */

// Block ID
$block_id = 'text-image-section-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Block classes
$block_class = 'wp-block-custom-text-image-section';
if ( ! empty( $block['className'] ) ) {
	$block_class .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$block_class .= ' align' . $block['align'];
}

// Get ACF fields - ensure these field names match your ACF Field Group setup
$heading        = custom_safe_get_field( 'text_image_heading' );
$content_text   = custom_safe_get_field( 'text_image_content' ); // WYSIWYG or Text Area
$button_text    = custom_safe_get_field( 'text_image_button_text' );
$button_link_arr = custom_safe_get_field( 'text_image_button_link' ); // ACF Link field returns an array
$image_arr      = custom_safe_get_field( 'text_image_image' );     // Image field (Return Format: Array)
$image_position = custom_safe_get_field( 'text_image_image_position', false, true, 'right' ); // Default to 'right'

// Add image position class
$block_class .= ' image-position-' . esc_attr( $image_position );

// Prepare button link
$button_url   = '';
$button_title = '';
$button_target = '';
if ( is_array( $button_link_arr ) ) {
	$button_url    = isset( $button_link_arr['url'] ) ? $button_link_arr['url'] : '';
	$button_title  = isset( $button_link_arr['title'] ) ? $button_link_arr['title'] : '';
	$button_target = isset( $button_link_arr['target'] ) ? $button_link_arr['target'] : '';
}

?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $block_class ); ?>">
	<div class="container text-image-section-inner">
		<div class="text-image-content-column">
			<?php if ( $heading ) : ?>
				<h2 class="text-image-heading"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>

			<?php if ( $content_text ) : ?>
				<div class="text-image-text">
					<?php echo wp_kses_post( $content_text ); // Use wp_kses_post for WYSIWYG content ?>
				</div>
			<?php endif; ?>

			<?php if ( $button_text && $button_url ) : ?>
				<div class="text-image-button-wrap">
					<a href="<?php echo esc_url( $button_url ); ?>" class="button button-learn-more" <?php echo $button_target ? 'target="' . esc_attr( $button_target ) . '" rel="noopener noreferrer"' : ''; ?>>
						<?php echo esc_html( $button_text ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( $image_arr && isset( $image_arr['url'] ) ) : ?>
			<div class="text-image-image-column">
				<img src="<?php echo esc_url( $image_arr['url'] ); ?>" alt="<?php echo esc_attr( $image_arr['alt'] ? $image_arr['alt'] : $heading ); // Fallback alt text ?>" loading="lazy" />
			</div>
		<?php endif; ?>
	</div>
</section>
