<?php
/**
 * WP_Rig\WP_Rig\Custom_Header\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Custom_Header;

use WP_Rig\WP_Rig\Component_Interface;
use function WP_Rig\WP_Rig\wp_rig;
use WP_Customize_Manager;
use function add_filter;
use function add_action;
use function add_theme_support;
use function apply_filters;
use function get_header_textcolor;
use function get_theme_support;
use function display_header_text;
use function esc_attr;

/**
 * Class for adding custom header support.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'custom_header';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_filter( 'get_header_image_tag', [ $this, 'prepare_attributes_for_amp' ] );
		add_action( 'after_setup_theme', [ $this, 'action_add_custom_header_support' ] );
		add_action( 'customize_register', [ $this, 'action_customize_register' ] );
	}

	/**
	 * Adds support for the Custom Logo feature.
	 */
	public function action_add_custom_header_support() {
		add_theme_support(
			'custom-header',
			apply_filters(
				'wp_rig_custom_header_args',
				[
					'default-image'      => get_template_directory_uri() . '/assets/images/hero.jpg',
					'default-text-color' => 'ffffff',
					'width'              => 1800,
					'height'             => 720,
					'flex-height'        => true,
					'wp-head-callback'   => [ $this, 'wp_head_callback' ],
				]
			)
		);
	}

	/**
	 * Outputs extra styles for the custom header, if necessary.
	 */
	public function wp_head_callback() {
		$header_text_color = get_header_textcolor();

		echo '<style type="text/css">';

		echo '.header-image { position: relative; } .header-image figcaption { position: absolute; top: 0; right: 0; bottom: 0; left: 0; }';
		echo '.header-image footer { position: absolute; right: 0; bottom: 0; left: 0; text-align: center }';
		echo '.header-image .cta-button { display: inline-block; margin: 1.5rem; }';

		echo '.header-image > amp-img, .header-image > img { display: block; max-height: calc(100vh - 3.5rem); overflow: hidden; }';
		echo '.header-image > img { height: 720px; object-fit: cover; }';
		echo '.header-image > amp-img img { object-fit: cover; }';

		if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color ) {
			if ( ! display_header_text() ) {
				echo '.header-image .site-title, .header-image .site-description { position: absolute; clip: rect(1px, 1px, 1px, 1px); }';
			} else {
				echo '.header-image .site-title a, .header-image .site-description { color: #' . esc_attr( $header_text_color ) . '; }';
			}
		}

		echo '</style>';
	}

	/**
	 * Ensures the Customizer section for the custom header only appears on the front page.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	public function action_customize_register( WP_Customize_Manager $wp_customize ) {
		$wp_customize->get_section( 'header_image' )->active_callback = 'is_front_page';
	}

	/**
	 * Prepares the custom header HTML attributes for AMP, enforcing height and layout.
	 *
	 * @param string $html The HTML image tag markup.
	 * @return string Filtered $html.
	 */
	public function prepare_attributes_for_amp( $html ) {
		if ( wp_rig()->is_amp() ) {
			$html = preg_replace( [ '/ width="(\d+)"/', '/ height="(\d+)"/' ], [ ' layout="fixed-height"', ' height="720"' ], $html );
		}

		return $html;
	}
}
