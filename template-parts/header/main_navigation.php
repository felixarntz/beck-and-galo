<?php
/**
 * Template part for displaying the header main navigation
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>
<nav id="site-navigation" class="main-navigation<?php echo wp_rig()->using_sidebar_navigation() ? ' with-sidebar' : ''; ?>" aria-label="<?php esc_attr_e( 'Main menu', 'wp-rig' ); ?>">
	<?php
	if ( wp_rig()->is_primary_nav_menu_active() ) {
		?>
		<div class="primary-menu-container">
			<?php wp_rig()->display_primary_nav_menu( [ 'menu_id' => 'primary-menu' ] ); ?>
		</div>
		<?php
	}

	get_template_part( 'template-parts/header/social_navigation' );
	?>
</nav><!-- #site-navigation -->
