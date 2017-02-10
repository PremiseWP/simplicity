<?php
/**
 * The loop
 *
 * @package Simplicity
 */

?>

<div id="pwps-loop" <?php pwps_the_loop_class(); ?>>

	<?php
	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

				get_template_part( 'content', 'loop' );

		endwhile;

	else :

		get_template_part( 'content', 'none' );

	endif;
	?>

</div>