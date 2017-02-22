<?php
/**
 * Content Image Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-post pwps-image-format' ); ?>>

	<div class="pwps-post-title">
		<h1><?php the_title(); ?></h1>
	</div>

	<div class="pwps-post-content">
		<?php the_content(); ?>
	</div>

</article>