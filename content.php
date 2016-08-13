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

	<div class="pwps-post-content">
		<?php the_content(); ?>
	</div>

	<div class="pwps-posts-navigation">
		<p><?php posts_nav_link(); ?></p>
	</div>

</article>