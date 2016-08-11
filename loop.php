<?php
/**
 * The loop
 *
 * @package Simplicity
 */

?>

<div class="pwps-the-loop">

	<?php
	/**
	 * The loop. Check if we have posts and display them.
	 */
	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			if ( is_singular() ) :
				get_template_part( 'content' );
			else :
				get_template_part( 'content', 'loop' );
			endif;

		endwhile;

	else :

		get_template_part( 'content', 'none' );

	endif;
	?>

</div>

<?php if ( ! is_singular() ) pwps_pagination(); ?>