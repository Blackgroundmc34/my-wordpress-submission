<?php

/**
 * Hero Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Custom_Theme
 */


// Block ID
$block_id = 'hero-section-' . $block['id'];
if (! empty($block['anchor'])) {
    $block_id = $block['anchor'];
}

// Block class
$block_class = 'wp-block-custom-hero-section';
if (! empty($block['className'])) {
    $block_class .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
    $block_class .= ' align' . $block['align'];
}

// Get ACF fields
$background_image_data = custom_safe_get_field('hero_background_image'); // Get the raw data first


$background_image_url = ''; // Initialize
// Determine the URL based on the expected return type (adjust based on your ACF field setting)
if (is_array($background_image_data) && isset($background_image_data['url'])) {
    // If Return Format is "Image Array"
    $background_image_url = $background_image_data['url'];
} elseif (is_numeric($background_image_data)) {
    // If Return Format is "Image ID"
    $image_src = wp_get_attachment_image_src($background_image_data, 'full'); // Or another appropriate size
    if ($image_src) {
        $background_image_url = $image_src[0];
    }
} elseif (is_string($background_image_data)) {
    // If Return Format is "Image URL"
    $background_image_url = $background_image_data;
}



$heading              = custom_safe_get_field('hero_heading');
$subheading           = custom_safe_get_field('hero_subheading');
$min_height           = custom_safe_get_field('hero_min_height', false, true, '400');
$text_color           = custom_safe_get_field('hero_text_color', false, true, '#FFFFFF');
$enable_overlay       = custom_safe_get_field('hero_enable_overlay');
$overlay_color        = custom_safe_get_field('hero_overlay_color', false, true, 'rgba(0,0,0,0.3)');

// Inline styles
$styles = array();
$overlay_styles = array();

if (!empty($background_image_url)) { // Use the processed URL
    $styles[] = 'background-image: url(\'' . esc_url($background_image_url) . '\');';
}
// ... (rest of your style generation code remains the same)
if ($min_height) {
    $styles[] = 'min-height: ' . esc_attr(intval($min_height)) . 'px;';
}
if ($text_color) {
    $styles[] = 'color: ' . esc_attr($text_color) . ';';
}

if ($enable_overlay && $overlay_color) {
    $overlay_styles[] = 'background-color: ' . esc_attr($overlay_color) . ';';
}

$style_attribute = ! empty($styles) ? 'style="' . esc_attr(implode(' ', $styles)) . '"' : '';
$overlay_style_attribute = ! empty($overlay_styles) ? 'style="' . esc_attr(implode(' ', $overlay_styles)) . '"' : '';

?>
<section id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($block_class); ?>" <?php echo $style_attribute; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                    ?>>
    <?php if ($enable_overlay && !empty($overlay_styles)) : ?>
        <div class="hero-section-overlay" <?php echo $overlay_style_attribute; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                            ?>></div>
    <?php endif; ?>

    <div class="hero-section-content container">


        <?php if ($heading) : ?>
            <h1 class="hero-heading"><?php echo wp_kses_post($heading); ?></h1>
        <?php endif; ?>

        <?php if ($subheading) : ?>
            <div class="hero-subheading">
                <?php echo wp_kses_post($subheading); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php 
