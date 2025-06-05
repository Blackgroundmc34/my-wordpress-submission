<?php
/**
 * Breadcrumbs Block Template.
 * @package Custom_Theme
 */
// Block classes (optional, but good for consistency)
$block_class = 'wp-block-custom-breadcrumbs-block'; 
if ( ! empty( $block['className'] ) ) {
    $block_class .= ' ' . $block['className'];
}
?>
<div class="<?php echo esc_attr( $block_class ); ?>">
    <?php
    // We want breadcrumbs to show even on the front page if this block is used.
    // The custom_theme_breadcrumbs function itself has logic to handle front page display.
    if ( function_exists( 'custom_theme_breadcrumbs' ) ) {
        // The custom_theme_breadcrumbs function should output its own <div class="breadcrumbs-container">
        custom_theme_breadcrumbs();
    } elseif ( $is_preview ) { // Check if $is_preview is defined if this is needed
        esc_html_e( 'Breadcrumbs function not found.', 'custom-theme' );
    }
    ?>
</div>