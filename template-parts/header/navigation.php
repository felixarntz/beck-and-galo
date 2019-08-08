<?php
/**
 * Template part for displaying the header navigation menu
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

$primary_nav_active = wp_rig()->is_primary_nav_menu_active();

if ( $primary_nav_active && wp_rig()->is_amp() ) {
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
	if ( $primary_nav_active && wp_rig()->is_amp() ) {
		?>
		[class]=" siteNavigationMenu.expanded ? 'site-headerbar nav--toggle-sub nav--toggle-small nav--toggled-on' : 'site-headerbar nav--toggle-sub nav--toggle-small' "
		<?php
	}
	?>
>
	<?php
	if ( $primary_nav_active ) {
		?>
		<button class="menu-toggle" aria-label="<?php esc_attr_e( 'Open menu', 'wp-rig' ); ?>" aria-controls="site-navigation" aria-expanded="false"
			<?php
			if ( wp_rig()->is_amp() ) {
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

	if ( $primary_nav_active ) {
		?>
		<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Main menu', 'wp-rig' ); ?>">
			<div class="primary-menu-container">
				<?php wp_rig()->display_primary_nav_menu( [ 'menu_id' => 'primary-menu' ] ); ?>
			</div>
		</nav><!-- #site-navigation -->
		<?php
	}
	?>
</div>

