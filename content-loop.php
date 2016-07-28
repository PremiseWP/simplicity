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
			<h2><?php the_title(); ?></h2>
		</a>
	</div>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="pwps-post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'pwps-thumbnail', array( 'class' => 'premise-responsive' ) ); ?>
			</a>
		</div>
	<?php else : ?>
		<div class="pwps-post-excerpt">
			<?php the_excerpt(); ?>
		</div>
	<?php endif; ?>


	<?php if ( 'page' !== get_post_type() ) : ?>
		<div class="pwps-post-meta">
			<div class="pwps-meta-item pwps-date-meta">
				<span>Date: <?php echo esc_html( get_post_time( 'j/n/y', true ) ); ?></span>
			</div>
			<div class="pwps-meta-item pwps-author-meta">
				<span>By: <?php the_author(); ?></span>
			</div>
			<?php if ( $pwps_format = get_post_format() ) : ?>
				<div class="pwps-meta-item pwps-format-meta">
					<span class="pwps-meta-other"><?php echo esc_html( $pwps_format ); ?></span>
				</div>
			<?php endif; ?>
			<?php if ( '' !== $pwpws_categories = get_the_category_list( ', ' ) ) : ?>
				<div class="pwps-meta-item pwps-categories-meta">
					<?php echo 'Found in: ' . $pwpws_categories; ?>
				</div>
			<?php endif; ?>
			<?php if ( function_exists( 'sharing_display' ) ) : ?>
				<div class="pwps-meta-item pwps-social-meta">
					<?php echo sharing_display(); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

</article>