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
				$button_on = 'tap:AMP.setState( { siteNavigationMenu: { expanded: ! siteNavigationMenu.expanded } } )';
				if ( wp_rig()->using_sidebar_navigation() ) {
					$button_on .= ', site-sidebar.toggle';
				}
				?>
				on="<?php echo esc_attr( $button_on ); ?>"
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

	if ( wp_rig()->has_block_area( 'header' ) || ! has_header_image() || ! is_front_page() ) {
		get_template_part( 'template-parts/header/branding' );
	}

	if ( $main_navigation_active && ( ! wp_rig()->using_sidebar_navigation() || wp_style_is( 'wp-rig-wide-screens-show-menu' ) ) ) {
		get_template_part( 'template-parts/header/main_navigation' );
	}
	?>
</div>

<?php
// For AMP, this uses amp-sidebar, which is therefore printed directly in header.php.
if ( $main_navigation_active && wp_rig()->using_sidebar_navigation() ) {
	if ( wp_rig()->is_amp() ) {
		?>
		<amp-sidebar id="site-sidebar" class="site-sidebar" layout="nodisplay" side="left" on="sidebarClose:AMP.setState( { siteNavigationMenu: { expanded: false } } )" data-close-button-aria-label="<?php esc_attr_e( 'Close Menu', 'wp-rig' ); ?>">
			<?php get_template_part( 'template-parts/header/main_navigation' ); ?>
		</amp-sidebar>
		<?php
	} else {
		?>
		<div id="site-sidebar" class="site-sidebar site-sidebar-js">
			<?php get_template_part( 'template-parts/header/main_navigation' ); ?>
		</div>
		<?php
	}
}

