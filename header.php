<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php
	if ( ! wp_rig()->is_amp() ) {
		?>
		<script>document.documentElement.classList.remove( 'no-js' );</script>
		<?php
	}
	?>

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'site' ); ?>>
<?php wp_body_open(); ?>
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wp-rig' ); ?></a>

	<header id="masthead" class="site-header">
		<?php get_template_part( 'template-parts/header/navigation' ); ?>

		<?php
		if ( is_front_page() ) {
			get_template_part( 'template-parts/header/custom_header' );
			get_template_part( 'template-parts/header/branding' );
		}
		?>
	</header><!-- #masthead -->

	<?php
	// For non-AMP, this sidebar is printed in the header/navigation.php template part.
	// amp-sidebar usage is currently commented out because of an AMP plugin bug (see https://github.com/ampproject/amp-wp/pull/2926).
	// phpcs:ignore Squiz.Commenting
	/*if ( ( wp_rig()->is_primary_nav_menu_active() || wp_rig()->is_social_nav_menu_active() ) && wp_rig()->using_sidebar_navigation() && wp_rig()->is_amp() ) {
		?>
		<amp-sidebar id="site-sidebar" class="site-sidebar" layout="nodisplay" side="left" on="sidebarClose:AMP.setState( { siteNavigationMenu: { expanded: false } } )" data-close-button-aria-label="<?php esc_attr_e( 'Close Menu', 'wp-rig' ); ?>">
			<?php get_template_part( 'template-parts/header/main_navigation' ); ?>
		</amp-sidebar>
		<?php
	}*/
	?>
