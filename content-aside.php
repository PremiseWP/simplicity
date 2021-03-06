<?php
/**
 * Content Aside Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-post pwps-aside-format' ); ?>>

	<?php
	$_author = get_user_by( 'ID', $post->post_author ); ?>

	<div class="pwps-aside-header">
		<div class="premise-clear-float">
			<div class="premise-float-left premise-inline-block pwps-avatar">
				<?php echo get_avatar( $_author, '100', 'mm', get_the_author(), array( 'class' => 'premise-responsive' ) ); ?>
			</div>
			<div class="premise-float-left premise-inline-block pwps-author">
				<h4><?php the_author(); ?></h4>
				<div class="pwps-meta-item pwps-date-meta">
					<span>Date: <?php echo esc_html( get_post_time( 'j/n/y', true ) ); ?></span>
				</div>
			</div>
		</div>
	</div>

	<div class="pwps-post-title">
		<h1><?php the_title(); ?></h1>
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

</article>