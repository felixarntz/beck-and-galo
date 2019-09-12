<?php
/**
 * WP_Rig\WP_Rig\Starter_Content\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Starter_Content;

use WP_Rig\WP_Rig\Component_Interface;
use function add_action;
use function add_theme_support;

/**
 * Class for adding theme starter content.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'starter_content';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', [ $this, 'action_add_starter_content' ] );
	}

	/**
	 * Adds theme support for starter content.
	 */
	public function action_add_starter_content() {
		$our_story_content = '<!-- wp:paragraph {"dropCap":true} -->
<p class="has-drop-cap">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus suscipit dictum. Duis posuere magna eget congue sodales. Maecenas auctor, ipsum at convallis tincidunt, nibh sem feugiat purus, et dapibus justo metus sit amet ante. Sed eu turpis sodales, convallis orci vel, congue tortor. Ut in ornare eros. Mauris nec faucibus libero. Pellentesque in magna justo. Aenean varius eleifend ante vel euismod.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Nulla egestas est in dui iaculis, at placerat nibh tincidunt. Curabitur at elit sit amet magna finibus congue. Donec non ante bibendum, tempus mauris at, pharetra lorem. Pellentesque lobortis in eros ac tincidunt. Praesent eu nisl sit amet massa suscipit faucibus a eu augue. Donec ipsum est, interdum non blandit vitae, bibendum vitae tellus. Suspendisse ultrices mollis elit, in hendrerit tellus pharetra vitae. Proin sed lectus maximus mauris tristique bibendum id vel sem. Curabitur sollicitudin ligula et purus dictum euismod. Donec tempus lacus in iaculis iaculis.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Suspendisse eu aliquet libero. Aenean malesuada vestibulum iaculis. Curabitur vitae ipsum interdum, feugiat odio non, lacinia nibh. Nulla vitae volutpat massa. Curabitur porttitor viverra massa, id lacinia est ornare non. Aliquam erat volutpat. Integer lobortis dictum dolor, at convallis nulla lacinia vitae. Cras sit amet placerat lectus. Vestibulum pulvinar finibus dui eget egestas. Quisque et sagittis urna. Nulla facilisi. Nunc malesuada, arcu quis volutpat hendrerit, dui libero eleifend ipsum, sit amet hendrerit dui ligula nec enim. Nunc dictum efficitur tempus. Fusce suscipit feugiat tellus, ac</p>
<!-- /wp:paragraph -->

<!-- wp:image -->
<figure class="wp-block-image"><img src="' . get_template_directory_uri() . '/assets/images/bar.jpg" alt=""/><figcaption>' . _x( 'Happy Hour: Mon-Fri 5PM', 'starter content', 'wp-rig' ) . '</figcaption></figure>
<!-- /wp:image -->';

		$extra_items = '<!-- wp:heading {"level":4} -->
<h4>' . _x( 'Blueberry Pancakes', 'starter content', 'wp-rig' ) . '</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . _x( 'A stack of four fluffy pancakes filled with blueberries, topped with warm blueberry compote and whipped cream.', 'starter content', 'wp-rig' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>' . _x( 'Two Eggs Any Style W/Housemade Sausage', 'starter content', 'wp-rig' ) . '</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . _x( 'Choice of Pork-Lime Sausage or Chicken-Curry Sausage or Turkey Sausage.', 'starter content', 'wp-rig' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>' . _x( 'Spinach &amp; Mushroom Omelette', 'starter content', 'wp-rig' ) . '</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . _x( 'Fresh spinach, mushrooms, onions and Swiss cheese, rolled into fluffy omelette and topped with hollandaise and fresh diced tomatoes.', 'starter content', 'wp-rig' ) . '</p>
<!-- /wp:paragraph -->';

		$menu_content = '<!-- wp:heading -->
<h2>' . _x( 'Breakfast', 'starter content', 'wp-rig' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . _x( "Chef's Pick", 'starter content', 'wp-rig' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:image -->
<figure class="wp-block-image"><img src="' . get_template_directory_uri() . '/assets/images/waffles.jpg" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3>' . _x( 'Caramel Banana Waffles', 'starter content', 'wp-rig' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . _x( 'Belgian waffles topped with fresh banana slices, caramel sauce and powdered sugar.', 'starter content', 'wp-rig' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator"/>
<!-- /wp:separator -->

' . $extra_items . '

<!-- wp:heading -->
<h2>' . _x( 'Soup &amp; Salad', 'starter content', 'wp-rig' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . _x( "Chef's Pick", 'starter content', 'wp-rig' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:image -->
<figure class="wp-block-image"><img src="' . get_template_directory_uri() . '/assets/images/soup.jpg" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3>' . _x( 'Pumpkin Soup', 'starter content', 'wp-rig' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . _x( 'Roasted Pumpkin and aromatic vegetables blended to a silky puree, with a touch of cream and a dash of cinnamon, nutmeg and allspice.', 'starter content', 'wp-rig' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator"/>
<!-- /wp:separator -->

' . $extra_items . '

<!-- wp:heading -->
<h2>' . _x( 'Entrees', 'starter content', 'wp-rig' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . _x( "Chef's Pick", 'starter content', 'wp-rig' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:image -->
<figure class="wp-block-image"><img src="' . get_template_directory_uri() . '/assets/images/steak.jpg" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3>' . _x( 'Steak', 'starter content', 'wp-rig' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . _x( 'Roasted Pumpkin and aromatic vegetables blended to a silky puree, with a touch of cream and a dash of cinnamon, nutmeg and allspice.', 'starter content', 'wp-rig' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator"/>
<!-- /wp:separator -->

' . $extra_items . '

<!-- wp:heading -->
<h2>' . _x( 'Desserts', 'starter content', 'wp-rig' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . _x( "Chef's Pick", 'starter content', 'wp-rig' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:image -->
<figure class="wp-block-image"><img src="' . get_template_directory_uri() . '/assets/images/pie.jpg" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3>' . _x( 'Key Lime Pie', 'starter content', 'wp-rig' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . _x( 'Roasted Pumpkin and aromatic vegetables blended to a silky puree, with a touch of cream and a dash of cinnamon, nutmeg and allspice.', 'starter content', 'wp-rig' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator"/>
<!-- /wp:separator -->

' . $extra_items;

		add_theme_support(
			'starter-content',
			[
				'posts'       => [
					'our-story' => [
						'post_type'    => 'page',
						'post_title'   => _x( 'Our Story', 'starter content', 'wp-rig' ),
						'post_content' => $our_story_content,
					],
					'menu'      => [
						'post_type'    => 'page',
						'post_title'   => _x( 'Menu', 'starter content', 'wp-rig' ),
						'post_content' => $menu_content,
					],
					'blog',
					'contact',
				],
				'attachments' => [
					'image-bar'     => [
						'post_title' => _x( 'Bar', 'starter content image', 'wp-rig' ),
						'file'       => 'assets/images/bar.jpg',
					],
					'image-pie'     => [
						'post_title' => _x( 'Pie', 'starter content image', 'wp-rig' ),
						'file'       => 'assets/images/pie.jpg',
					],
					'image-soup'    => [
						'post_title' => _x( 'Soup', 'starter content image', 'wp-rig' ),
						'file'       => 'assets/images/soup.jpg',
					],
					'image-steak'   => [
						'post_title' => _x( 'Steak', 'starter content image', 'wp-rig' ),
						'file'       => 'assets/images/steak.jpg',
					],
					'image-waffles' => [
						'post_title' => _x( 'Waffles', 'starter content image', 'wp-rig' ),
						'file'       => 'assets/images/waffles.jpg',
					],
				],
				'options'     => [
					'show_on_front'  => 'page',
					'page_on_front'  => '{{our-story}}',
					'page_for_posts' => '{{blog}}',
				],
				'theme_mods'  => [
					'cta[label]'                               => _x( 'View Menu', 'starter content', 'wp-rig' ),
					'cta[id]'                                  => '{{menu}}',
					'footer_info'                              => '&copy; ' . get_bloginfo( 'name' ),
					'text_transform_uppercase_branding'        => true,
					'text_transform_uppercase_main_navigation' => true,
				],
				'nav_menus'   => [
					'primary' => [
						'name'  => _x( 'Primary Menu', 'starter content', 'wp-rig' ),
						'items' => [
							'link_home',
							'page_menu' => [
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{menu}}',
							],
							'page_blog',
							'page_contact',
						],
					],
					'social'  => [
						'name'  => _x( 'Social Menu', 'starter content', 'wp-rig' ),
						'items' => [
							'link_twitter',
							'link_facebook',
							'link_instagram',
							'link_pinterest',
							'link_email',
						],
					],
					'footer'  => [
						'name'  => _x( 'Footer Menu', 'starter content', 'wp-rig' ),
						'items' => [
							'page_contact',
						],
					],
				],
				'widgets'     => [
					'footer-1' => [
						'text_location_1' => [
							'text',
							[
								'title' => _x( 'Locations &amp; Hours', 'starter content', 'wp-rig' ),
								'text'  => implode(
									'',
									[
										'<h3>' . _x( 'San Francisco', 'starter content', 'wp-rig' ) . '</h3>' . "\n",
										_x( '123 E Somewhere St.,', 'starter content', 'wp-rig' ) . "\n" . _x( 'San Francisco, CA', 'starter content', 'wp-rig' ) . "\n",
										_x( 'Mon-Thu 11am-2pm, 4pm-9pm', 'starter content', 'wp-rig' ) . "\n",
										_x( 'Fri-Sun 11am-3pm, 4pm-12am', 'starter content', 'wp-rig' ) . "\n",
									]
								),
								'filter' => true,
								'visual' => true,
							],
						],
					],
					'footer-2' => [
						'text_location_2' => [
							'text',
							[
								'title' => '&nbsp;',
								'text'  => implode(
									'',
									[
										'<h3>' . _x( 'San Jose', 'starter content', 'wp-rig' ) . '</h3>' . "\n",
										_x( '123 S Elsewhere St.,', 'starter content', 'wp-rig' ) . "\n" . _x( 'San Jose, CA', 'starter content', 'wp-rig' ) . "\n",
										_x( 'Mon-Thu 11am-2pm, 4pm-9pm', 'starter content', 'wp-rig' ) . "\n",
										_x( 'Fri-Sun 11am-3pm, 4pm-11pm', 'starter content', 'wp-rig' ) . "\n",
									]
								),
								'filter' => true,
								'visual' => true,
							],
						],
					],
				],
			]
		);
	}
}
