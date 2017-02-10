<?php
/**
 * Content Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-post' ); ?>>

	<?php if ( ! is_home() && ! is_front_page() ) : ?>
		<div class="pwps-post-title">
			<h1><?php the_title(); ?></h1>
		</div>
	<?php endif; ?>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="pwps-post-thumbnail">
			<?php the_post_thumbnail( 'pwps-thumbnail', array( 'class' => 'premise-responsive' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="pwps-post-content">
		<?php the_content(); ?>
	</div>

	<!-- The category -->
	<div class="pwpp-post-category">
		<?php echo ( '' !== (string) get_the_category_list( ', ', 'single', get_the_id() ) )
			 ? '<p>Categories: ' . get_the_category_list( ', ', 'single', get_the_id() ) . '</p>'
			 : ''; ?>
	</div>

	<!-- The tags -->
	<div class="pwpp-post-tags">
		<?php echo ( '' !== (string) get_the_tag_list( '', ', ', '', get_the_id() ) )
			 ? '<p>Tags: ' . get_the_tag_list( '', ', ', '', get_the_id() ) . '</p>'
			 : ''; ?>
	</div>

	<div class="pwps-posts-navigation">
		<p><?php posts_nav_link(); ?></p>
	</div>

</article>