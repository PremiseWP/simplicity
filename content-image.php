<?php
/**
 * Content Image Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-post pwps-image-format' ); ?>>

	<?php if ( ! is_home() && ! is_front_page() ) : ?>
		<div class="pwps-post-title">
			<h1><?php the_title(); ?></h1>
		</div>
	<?php endif; ?>

	<div class="pwps-post-content">
		<?php the_content(); ?>
	</div>

	<div class="pwps-posts-navigation">
		<p><?php posts_nav_link(); ?></p>
	</div>

</article>

<?php get_template_part( 'loop', 'related' );

// get the comments
if ( ( comments_open() || get_comments_number() ) ) comments_template(); ?>