<?php
/**
 * Content Related Posts Template
 *
 * @package Simplicity
 */

?>

<<<<<<< HEAD
<article <?php post_class( 'pwps-related-post span5' ); ?>>
=======
<article <?php post_class( 'pwps-post pwps-blog-post' ); ?>>
>>>>>>> v2

	<div class="pwps-post-title">
		<a href="<?php the_permalink(); ?>">
			<h2><?php the_title(); ?></h2>
		</a>
	</div>

	<?php pwps_the_post_meta(); ?>

</article>