<?php
/**
 * Accordion Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Custom_Theme
 */

// Block ID
$block_id = 'accordion-section-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Block classes
$block_class = 'wp-block-custom-accordion-section';
if ( ! empty( $block['className'] ) ) {
	$block_class .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$block_class .= ' align' . $block['align'];
}

// Get ACF fields
$main_heading   = custom_safe_get_field( 'accordion_main_heading' );
$accordion_items = custom_safe_get_field( 'accordion_items' ); // This is the repeater field

?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $block_class ); ?>">
	<div class="container accordion-section-inner">
		<?php if ( $main_heading ) : ?>
			<h2 class="accordion-main-heading"><?php echo esc_html( $main_heading ); ?></h2>
		<?php endif; ?>

		<?php if ( have_rows( 'accordion_items' ) ) : // Check if the repeater has rows ?>
			<div class="accordion-items-wrapper">
				<?php
				$item_index = 0; // For unique IDs if needed
				while ( have_rows( 'accordion_items' ) ) :
					the_row();
					$item_title   = get_sub_field( 'accordion_item_title' ); // Use get_sub_field for repeater subfields
					$item_content = get_sub_field( 'accordion_item_content' );
					$item_id      = $block_id . '-item-' . $item_index;
					$content_id   = $block_id . '-content-' . $item_index;
					?>
					<div class="accordion-item">
						<h3 class="accordion-item-title">
							<button
								type="button"
								aria-expanded="false"
								class="accordion-item-trigger"
								aria-controls="<?php echo esc_attr( $content_id ); ?>"
								id="<?php echo esc_attr( $item_id ); ?>"
							>
								<span class="accordion-item-title-text"><?php echo esc_html( $item_title ); ?></span>
								<span class="accordion-item-icon" aria-hidden="true"></span> <?php // Icon will be CSS-driven (+/-) ?>
							</button>
						</h3>
						<div
							id="<?php echo esc_attr( $content_id ); ?>"
							role="region"
							aria-labelledby="<?php echo esc_attr( $item_id ); ?>"
							class="accordion-item-content"
							hidden
						>
							<div class="accordion-item-content-inner">
								<?php echo wp_kses_post( $item_content ); ?>
							</div>
						</div>
					</div>
					<?php
					$item_index++;
				endwhile;
				?>
			</div><!-- .accordion-items-wrapper -->
		<?php elseif ( $is_preview ) : ?>
			<p><?php esc_html_e( 'Please add some accordion items.', 'custom-theme' ); ?></p>
		<?php endif; ?>
	</div><!-- .container -->
</section>
