<?php
/**
 * WP_Rig\WP_Rig\CTA\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\CTA;

use WP_Rig\WP_Rig\Component_Interface;
use WP_Rig\WP_Rig\Templating_Component_Interface;
use WP_Customize_Manager;
use function add_action;
use function get_theme_mod;

/**
 * Class for managing a CTA button.
 *
 * Exposes template tags:
 * * `wp_rig()->display_cta()`
 * * `wp_rig()->has_cta()`
 */
class Component implements Component_Interface, Templating_Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'cta';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'customize_register', [ $this, 'action_customize_register' ] );
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
			'display_cta' => [ $this, 'display_cta' ],
			'has_cta'     => [ $this, 'has_cta' ],
		];
	}

	/**
	 * Adds Customizer settings and controls for modifying the CTA.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	public function action_customize_register( WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_setting(
			'cta[label]',
			[
				'default' => '',
			]
		);
		$wp_customize->add_control(
			'cta[label]',
			[
				'type'           => 'text',
				'label'          => __( 'CTA Button Label', 'wp-rig' ),
				'description'    => __( 'Enter a text to add a call-to-action button to your site.', 'wp-rig' ),
				'section'        => 'header_image',
				'priority'       => 80,
				'theme_supports' => 'custom-header',
			]
		);

		$wp_customize->add_setting(
			'cta[id]',
			[
				'default' => '',
			]
		);
		$wp_customize->add_control(
			'cta[id]',
			[
				'type'           => 'dropdown-pages',
				'label'          => __( 'CTA Button Link', 'wp-rig' ),
				'description'    => __( 'Choose a page the button should link to.', 'wp-rig' ),
				'section'        => 'header_image',
				'priority'       => 80,
				'theme_supports' => 'custom-header',
				'allow_addition' => true,
			]
		);

		$wp_customize->add_setting(
			'cta[url]',
			[
				'default' => '',
			]
		);
		$wp_customize->add_control(
			'cta[url]',
			[
				'type'           => 'url',
				'label'          => __( 'CTA Button URL', 'wp-rig' ),
				'description'    => __( 'Alternatively, enter a URL the button should link to.', 'wp-rig' ),
				'section'        => 'header_image',
				'priority'       => 80,
				'theme_supports' => 'custom-header',
			]
		);
	}

	/**
	 * Displays the CTA button.
	 */
	public function display_cta() {
		$cta = (array) get_theme_mod( 'cta', [] );
		if ( empty( $cta['label'] ) ) {
			return;
		}

		if ( ! empty( $cta['id'] ) ) {
			$cta['url'] = get_permalink( $cta['id'] );
		}

		if ( empty( $cta['url'] ) ) {
			echo '<button type="button" class="cta-button">' . esc_html( $cta['label'] ) . '</button>';
			return;
		}

		echo '<a href="' . esc_url( $cta['url'] ) . '" class="button cta-button">' . esc_html( $cta['label'] ) . '</a>';
	}

	/**
	 * Checks whether a CTA button should be displayed.
	 *
	 * @return bool True if CTA should be displayed, false otherwise.
	 */
	public function has_cta() {
		$cta = (array) get_theme_mod( 'cta', [] );
		return ! empty( $cta['label'] );
	}
}
