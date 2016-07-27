<?php
/**
 * Content Loop Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-blog-post' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="pwps-post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'pwps-thumbnail', array( 'class' => 'premise-responsive' ) ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="pwps-post-title">
		<a href="<?php the_permalink(); ?>">
			<h3><?php the_title(); ?></h3>
		</a>
	</div>

	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="pwps-post-meta">
			<div class="pwps-meta-item pwps-author-meta">
				<span>By: <?php the_author(); ?></span>
			</div>
			<div class="pwps-meta-item pwps-date-meta">
				<span>Date: <?php echo esc_html( get_post_time( 'j/n/y', true ) ); ?></span>
			</div>
			<div class="pwps-meta-item pwps-date-meta">
				<?php if ( function_exists( 'sharing_display' ) ) echo sharing_display(); ?>
			</div>
		</div>
	<?php endif; ?>

</article>