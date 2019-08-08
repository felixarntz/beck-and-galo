<?php
/**
 * WP_Rig\WP_Rig\Headerbar\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Headerbar;

use WP_Rig\WP_Rig\Component_Interface;
use function add_action;
use function add_theme_support;
use function _admin_bar_bump_cb;

/**
 * Class for managing the header bar.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'headerbar';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', [ $this, 'action_register_admin_bar_style' ] );
	}

	/**
	 * Registers custom style rules for when the admin bar is active.
	 *
	 * These rules account for the fixed header bar.
	 */
	public function action_register_admin_bar_style() {
		add_theme_support(
			'admin-bar',
			array(
				'callback' => function() {
					?>
					<style type="text/css" media="screen">
						<?php
						ob_start();
						_admin_bar_bump_cb();
						echo str_replace( [ '<style type="text/css" media="screen">', '</style>' ], '', ob_get_clean() );
						?>
						.site-headerbar { top: 32px !important; }
						@media screen and ( max-width: 782px ) {
							.site-headerbar { top: 46px !important; }
						}
						@media screen and ( max-width: 600px ) {
							#wpadminbar { position: fixed !important; }
						}
					</style>
					<?php
				},
			)
		);
	}
}
