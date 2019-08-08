<?php
/**
 * WP_Rig\WP_Rig\Customizer\Headerbar class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Customizer;

use WP_Customize_Manager;
use function add_filter;
use function add_action;
use function get_theme_mod;

/**
 * Class for managing Customizer support for controlling header bar behavior.
 */
class Headerbar {

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_filter( 'wp_rig_css_files', [ $this, 'filter_wp_rig_css_files' ] );
		add_action( 'customize_register', [ $this, 'action_customize_register' ] );
	}

	/**
	 * Filters the theme CSS files to load.
	 *
	 * @param array $css_files List of CSS files.
	 * @return array Filtered $css_files.
	 */
	public function filter_wp_rig_css_files( array $css_files ) {
		if ( get_theme_mod( 'auto_expand_main_navigation', false ) ) {
			$css_files['wp-rig-wide-screens-show-menu'] = [
				'file'   => 'wide-screens-show-menu.min.css',
				'global' => true,
			];
		}

		return $css_files;
	}

	/**
	 * Adds Customizer settings and controls for modifying header bar behavior.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	public function action_customize_register( WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_setting(
			'auto_expand_main_navigation',
			[
				'default'              => false,
				'sanitize_callback'    => 'rest_sanitize_boolean',
				'sanitize_js_callback' => 'rest_sanitize_boolean',
			]
		);
		$wp_customize->add_control(
			'auto_expand_main_navigation',
			[
				'type'        => 'checkbox',
				'label'       => __( 'Always show main navigation on wide screens?', 'wp-rig' ),
				'description' => __( 'If not, the main navigation and social navigation can be toggled with the menu button.', 'wp-rig' ),
				'section'     => 'theme_options',
				'priority'    => 5,
			]
		);
	}
}
