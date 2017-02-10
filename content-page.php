<?php
/**
 * The content template for a page
 *
 * @package Premise Simplicity
 */
?>

<article <?php post_class( 'pwps-page' ); ?>>

	<?php if ( has_post_thumbnail()
		 && ! (boolean) premise_get_value( 'pwps_page_options[hide-thumbnail]', 'post' ) ) : ?>
		<div class="pwps-post-thumbnail">
			<?php the_post_thumbnail( 'pwps-thumbnail', array( 'class' => 'premise-responsive' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="pwps-post-content">
		<?php the_content(); ?>
	</div>

	<div class="pwps-posts-navigation">
		<p><?php posts_nav_link(); ?></p>
	</div>

</article>