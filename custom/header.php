<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * or a similar main content wrapper.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Custom_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>


<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
	
	<?php wp_head(); // Crucial WordPress hook for styles, scripts, and other head elements. ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); // Hook for content right after the opening body tag. ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content">
		<?php esc_html_e( 'Skip to content', 'custom-theme' ); ?>
	</a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-header-inner">
			<div class="site-branding">
				<?php
				// Display the custom logo from assets/images/logo.png first, then fallback.
				$custom_logo_path = CUSTOM_THEME_DIR . '/assets/images/logo.png';
				$custom_logo_url  = CUSTOM_THEME_URI . '/assets/images/logo.png';

				if ( file_exists( $custom_logo_path ) ) :
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="custom-logo-link">
						<img src="<?php echo esc_url( $custom_logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> Logo" class="site-logo custom-logo">
					</a>
					<?php
				elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) :
					// Fallback to WordPress Customizer logo if assets/images/logo.png doesn't exist.
					the_custom_logo();
				else :
					// Fallback to site title if no logo is found.
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$custom_theme_description = get_bloginfo( 'description', 'display' );
					if ( $custom_theme_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo esc_html( $custom_theme_description ); ?></p>
					<?php endif; ?>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'custom-theme' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary', // This is the key: tells WordPress which menu location to use.
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'primary-menu-ul nav-items',
						'container'      => false,             // Don't wrap in a div.
						'fallback_cb'    => false,             // Important: if no menu assigned or location not registered, show nothing.
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						// 'depth'       => 1, // Uncomment if your design only shows top-level items here.
					)
				);
				?>
			</nav><!-- #site-navigation -->

			<div class="header-actions">
				<a href="<?php echo esc_url( home_url( '/register' ) ); // TODO: Replace with actual registration page URL or make dynamic. ?>" class="button button-register">
					<?php esc_html_e( 'Register', 'custom-theme' ); ?>
				</a>
			</div>

			<button class="menu-toggle" aria-controls="primary-menu mobile-primary-menu" aria-expanded="false">
				<span class="menu-toggle-icon"></span>
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'custom-theme' ); ?></span>
			</button>
		</div><!-- .site-header-inner -->
	</header><!-- #masthead -->

	<?php // Mobile menu panel - will be hidden by default and shown via JS ?>
	<div id="mobile-menu-panel" class="mobile-menu-panel" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="mobile-menu-heading">
		<button class="close-mobile-menu" aria-label="<?php esc_attr_e( 'Close menu', 'custom-theme' ); ?>">&times;</button>
		<h2 id="mobile-menu-heading" class="screen-reader-text"><?php esc_html_e('Mobile Navigation Menu', 'custom-theme'); ?></h2>
		<nav class="mobile-navigation" aria-label="<?php esc_attr_e( 'Mobile Menu', 'custom-theme' ); ?>">
			<?php
			// You can use the same 'primary' menu or register a separate 'mobile' menu location.
			wp_nav_menu(
				array(
					'theme_location' => 'primary', // Or 'mobile' if you create a separate one.
					'menu_id'        => 'mobile-primary-menu',
					'menu_class'     => 'mobile-primary-menu-ul',
					'container'      => false,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>
		<div class="mobile-header-actions">
			<a href="<?php echo esc_url( home_url( '/register' ) );  ?>" class="button button-register">
				<?php esc_html_e( 'Register', 'custom-theme' ); ?>
			</a>
		</div>
	</div>
	<div class="mobile-menu-overlay" aria-hidden="true"></div>


	<?php 

	
	?>
