<?php
/**
 * Content Related Posts Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-related-post span5' ); ?>>

	<div class="pwps-post-title">
		<a href="<?php the_permalink(); ?>">
			<h2><?php the_title(); ?></h2>
		</a>
	</div>

	<?php if ( has_post_thumbnail() ) : ?>
		<!-- <div class="pwps-post-thumbnail">
			<a href="<?php the_permalink(); ?>" class="premise-block">
				<?php the_post_thumbnail( 'pwps-thumbnail', array( 'class' => 'premise-responsive' ) ); ?>
			</a>
		</div> -->
	<?php endif; ?>

	<!-- <div class="pwps-post-excerpt">
		<?php the_excerpt(); ?>
	</div> -->

	<?php pwps_the_post_meta(); ?>

</article>