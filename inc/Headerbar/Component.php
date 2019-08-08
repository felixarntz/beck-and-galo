<?php
/**
 * WP_Rig\WP_Rig\Headerbar\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Headerbar;

use WP_Rig\WP_Rig\Component_Interface;
use WP_Rig\WP_Rig\Templating_Component_Interface;
use function add_action;
use function add_theme_support;
use function _admin_bar_bump_cb;
use function apply_filters;

/**
 * Class for managing the header bar.
 *
 * Exposes template tags:
 * * `wp_rig()->using_sidebar_navigation()`
 */
class Component implements Component_Interface, Templating_Component_Interface {

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
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `wp_rig()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags() : array {
		return [
			'using_sidebar_navigation' => [ $this, 'using_sidebar_navigation' ],
		];
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
						echo str_replace( [ '<style type="text/css" media="screen">', '</style>' ], '', ob_get_clean() ); // phpcs:ignore WordPress.Security.EscapeOutput
						?>
						@media screen and ( min-width: 783px ) {
							.site-headerbar { top: 32px !important; }
							.site-sidebar { top: calc( 32px + 3.5rem ) ! important; }
						}
						@media screen and ( max-width: 782px ) {
							.site-headerbar { top: 46px !important; }
							.site-sidebar { top: calc( 46px + 3.5rem ) ! important; }
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

	/**
	 * Checks whether the toggled main navigation should use a sidebar.
	 *
	 * @return bool True if a sidebar should be used for the navigation, false otherwise.
	 */
	public function using_sidebar_navigation() {
		/**
		 * Filters whether the toggled main navigation should use a sidebar.
		 *
		 * @param bool $use_sidebar Whether to use a sidebar for the navigation.
		 */
		return (bool) apply_filters( 'wp_rig_using_sidebar_navigation', true );
	}
}
