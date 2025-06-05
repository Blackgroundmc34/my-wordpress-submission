<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the main content area and all content after.
 * It should also include the wp_footer() hook.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Custom_Theme
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>

<?php // Closing the main content wrapper, typically opened in index.php, page.php etc. 
?>
<?php // Example: </div><!-- #content --> 
?>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="footer-inner">
		<div class="footer-top">
			<div class="footer-logo">
				<?php
				// Display the custom logo or site title.

				$custom_logo_url = CUSTOM_THEME_URI . '/assets/images/footer_logo.png'; // Consider a footer-specific logo if needed
				if (file_exists(CUSTOM_THEME_DIR . '/assets/images/footer_logo.png')) :
				?>
					<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
						<img src="<?php echo esc_url($custom_logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?> Logo" class="site-logo-footer">
					</a>
					<?php
				elseif (function_exists('the_custom_logo') && has_custom_logo()) :
					// This will output the logo with its own wrapping <a> tag and classes.
					// We might need to adjust styling if this is used.
					the_custom_logo();
				else :
					if (get_bloginfo('name')) :
					?>
						<p class="site-title-footer"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
				<?php
					endif;
				endif;
				?>
			</div>
			<div class="footer-social-icons">
				<a href="#" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Facebook', 'custom-theme'); ?>">
					<i class="fab fa-facebook-f"></i>
				</a>
				<a href="#" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Instagram', 'custom-theme'); ?>">
					<i class="fab fa-instagram"></i>
				</a>
				<a href="#" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Twitter / X', 'custom-theme'); ?>">
					<i class="fab fa-x-twitter"></i> <?php // Use 'fa-twitter' for older FA versions 
														?>
				</a>
			</div>

		</div>

		<div class="footer-text">
			<?php // Placeholder text similar to the design. Replace with dynamic content or theme options if needed. 
			?>
			<p>Cursus commodo vitae faucibus hac. Sem pretium lacus nunc urna commodo feugiat lacus.</p>
			<p>Massa a faucibus porttitor est maecenas aliquet.</p>
		</div>

		<!--
<div class="site-info">
    <?php
	// Standard copyright info
	/*
    $site_name = get_bloginfo( 'name' );
    printf(
        esc_html__( 'Copyright &copy; %1$s %2$s. All Rights Reserved.', 'custom-theme' ),
        esc_html( date_i18n( 'Y' ) ),
        '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( $site_name ) . '</a>'
    );
    */
	?>
</div>
-->

	</div><!-- .footer-inner -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); // This hook is essential for WordPress functionality, scripts, and the admin bar. 
?>

</body>

</html>