<?php
/**
 * Content Related Posts Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-related-post col4' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'pwps-thumbnail', array( 'class' => 'premise-responsive' ) ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="post-title">
		<a href="<?php the_permalink(); ?>">
			<h3><?php the_title(); ?></h3>
		</a>
	</div>

	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="post-meta">
			<!-- Add post meta -->
		</div>
	<?php endif; ?>

</article>