<?php
/**
 * Front Page
 *
 * @package Simplicity
 */

get_header();

?>

<section id="pwps-front-page">

	<div class="pwps-the-loop">

		<?php
		/**
		 * The loop. Check if we have posts and display them.
		 */
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'content' );

			endwhile;

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>

	</div>

</section>

<?php get_footer(); ?>