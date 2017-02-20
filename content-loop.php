<?php
/**
 * Content Loop Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-blog-post' ); ?>>

	<div class="pwps-post-title">
		<a href="<?php the_permalink(); ?>">
			<h1><?php the_title(); ?></h1>
		</a>
	</div>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="pwps-post-thumbnail">
			<a href="<?php the_permalink(); ?>" class="premise-block">
				<?php the_post_thumbnail( 'pwps-thumbnail', array( 'class' => 'premise-responsive' ) ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="pwps-post-content">
		<?php the_content(); ?>
	</div>

	<?php pwps_the_post_meta(); ?>

</article>