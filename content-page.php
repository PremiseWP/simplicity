<?php
/**
 * The content template for a page
 *
 * @package Premise Simplicity
 */


if ( has_post_thumbnail()
	 && ! (boolean) premise_get_value( 'pwps_page_options[hide-thumbnail]', 'post' ) ) :

	?><div class="pwps-page-thumbnail"
	style="background-image: url(<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) ) ?>);"></div><?
endif; ?>

<div id="pwps-content" class="pwps-container">

<article <?php post_class( 'pwps-page' ); ?>>

	<?php if ( ! (boolean) premise_get_value( 'pwps_page_options[hide-title]', 'post' ) ) :
		?><div class="pwps-post-title">
			<h1><?php the_title(); ?></h1>
		</div><?
	endif; ?>

	<div class="pwps-post-content">
		<?php the_content(); ?>
	</div>

</article>

</div>