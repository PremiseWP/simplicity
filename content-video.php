<?php
/**
 * Content Video Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-post pwps-video-format' ); ?>>

	<div class="pwps-post-title">
		<h1><?php the_title(); ?></h1>
	</div>

	<div class="pwps-post-content">
		<?php the_content(); ?>
	</div>

</article>