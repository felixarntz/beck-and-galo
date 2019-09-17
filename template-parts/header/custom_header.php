<?php
/**
 * Template part for displaying the custom header media
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( ! has_header_image() ) {
	return;
}

?>
<figure class="header-image">
	<?php the_header_image_tag(); ?>

	<figcaption>
		<header>
			<?php get_template_part( 'template-parts/header/branding' ); ?>
		</header>
		<?php
		if ( wp_rig()->has_cta() ) {
			?>
			<footer>
				<?php wp_rig()->display_cta(); ?>
			</footer>
			<?php
		}
		?>
	</figcaption>
</figure><!-- .header-image -->
