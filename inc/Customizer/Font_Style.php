<?php
/**
 * WP_Rig\WP_Rig\Customizer\Font_Style class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Customizer;

use function WP_Rig\WP_Rig\wp_rig;
use WP_Customize_Manager;
use function add_filter;
use function add_action;
use function get_theme_mod;

/**
 * Class for managing Customizer support for controlling specific font styles.
 */
class Font_Style {

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_filter( 'body_class', [ $this, 'filter_body_class' ] );
		add_action( 'customize_register', [ $this, 'action_customize_register' ] );
	}

	/**
	 * Filters the CSS classes to add to the body tag.
	 *
	 * @param array $body_classes List of body classes.
	 * @return array Filtered $body_classes.
	 */
	public function filter_body_class( array $body_classes ) {
		if ( get_theme_mod( 'text_transform_uppercase_branding', true ) ) {
			$body_classes[] = 'has-uppercase-branding';
		}

		if ( get_theme_mod( 'text_transform_uppercase_main_navigation', false ) ) {
			$body_classes[] = 'has-uppercase-main-navigation';
		}

		return $body_classes;
	}

	/**
	 * Adds Customizer settings and controls for modifying font styles.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	public function action_customize_register( WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_setting(
			'text_transform_uppercase_branding',
			[
				'default'              => true,
				'sanitize_callback'    => 'rest_sanitize_boolean',
				'sanitize_js_callback' => 'rest_sanitize_boolean',
			]
		);
		$wp_customize->add_control(
			'text_transform_uppercase_branding',
			[
				'type'        => 'checkbox',
				'label'       => __( 'Transform site title and tagline to display in uppercase?', 'wp-rig' ),
				'section'     => 'fonts',
				'priority'    => 80,
			]
		);

		$wp_customize->add_setting(
			'text_transform_uppercase_main_navigation',
			[
				'default'              => false,
				'sanitize_callback'    => 'rest_sanitize_boolean',
				'sanitize_js_callback' => 'rest_sanitize_boolean',
			]
		);
		$wp_customize->add_control(
			'text_transform_uppercase_main_navigation',
			[
				'type'        => 'checkbox',
				'label'       => __( 'Transform primary navigation to display in uppercase?', 'wp-rig' ),
				'section'     => 'fonts',
				'priority'    => 80,
			]
		);
	}
}
