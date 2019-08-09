<?php
/**
 * Template part for displaying the header navigation menu
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

$main_navigation_active = wp_rig()->is_primary_nav_menu_active() || wp_rig()->is_social_nav_menu_active();
$toggle_controls        = wp_rig()->using_sidebar_navigation() ? 'site-sidebar' : 'site-navigation';

if ( $main_navigation_active && wp_rig()->is_amp() ) {
	?>
	<amp-state id="siteNavigationMenu">
		<script type="application/json">
			{
				"expanded": false
			}
		</script>
	</amp-state>
	<?php
}
?>
<div id="site-headerbar" class="site-headerbar nav--toggle-sub nav--toggle-small"
	<?php
	if ( $main_navigation_active && wp_rig()->is_amp() ) {
		?>
		[class]=" siteNavigationMenu.expanded ? 'site-headerbar nav--toggle-sub nav--toggle-small nav--toggled-on' : 'site-headerbar nav--toggle-sub nav--toggle-small' "
		<?php
	}
	?>
>
	<?php
	if ( $main_navigation_active ) {
		?>
		<button class="menu-toggle" aria-controls="<?php echo esc_attr( $toggle_controls ); ?>" aria-expanded="false"
			<?php
			if ( wp_rig()->is_amp() ) {
				// Once amp-sidebar can be used correctly, add 'site-sidebar.toggle' action here.
				?>
				on="tap:AMP.setState( { siteNavigationMenu: { expanded: ! siteNavigationMenu.expanded } } )"
				[aria-expanded]="siteNavigationMenu.expanded ? 'true' : 'false'"
				<?php
			}
			?>
		>
			<?php
			echo wp_rig()->get_svg_icon( 'bars', [ 'title' => __( 'Open Menu', 'wp-rig' ) ] ); // phpcs:ignore WordPress.Security.EscapeOutput
			echo wp_rig()->get_svg_icon( 'close', [ 'title' => __( 'Close Menu', 'wp-rig' ) ] ); // phpcs:ignore WordPress.Security.EscapeOutput
			?>
		</button>
		<?php
	}

	if ( ! is_front_page() ) {
		get_template_part( 'template-parts/header/branding' );
	}

	if ( $main_navigation_active && ( ! wp_rig()->using_sidebar_navigation() || wp_style_is( 'wp-rig-wide-screens-show-menu' ) ) ) {
		get_template_part( 'template-parts/header/main_navigation' );
	}
	?>
</div>

<?php
// For AMP, this uses amp-sidebar, which is therefore printed directly in header.php.
// This currently replaces amp-sidebar usage because of an AMP plugin bug (see https://github.com/ampproject/amp-wp/pull/2926).
if ( $main_navigation_active && wp_rig()->using_sidebar_navigation()/* && ! wp_rig()->is_amp()*/ ) {
	?>
	<div id="site-sidebar" class="site-sidebar site-sidebar-js">
		<?php get_template_part( 'template-parts/header/main_navigation' ); ?>
	</div>
	<?php
}

