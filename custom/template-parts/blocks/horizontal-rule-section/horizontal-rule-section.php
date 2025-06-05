<?php
/**
 * Horizontal Rule Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Custom_Theme
 */

// Block classes
$block_class = 'wp-block-custom-horizontal-rule-section';
if ( ! empty( $block['className'] ) ) {
	$block_class .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$block_class .= ' align' . $block['align'];
}

?>
<div class="<?php echo esc_attr( $block_class ); ?>">
	<div class="horizontal-rule-section-inner-container">
		<hr class="custom-styled-horizontal-rule" />
	</div>
</div>
