<?php
/**
 * Content Gallery Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-post pwps-gallery-format' ); ?>>

	<div class="pwps-post-title">
		<h1><?php the_title(); ?></h1>
	</div>

	<div class="pwps-post-content">
		<?php the_content(); ?>
	</div>

	<div class="pwps-posts-navigation">
		<p><?php posts_nav_link(); ?></p>
	</div>

</article>