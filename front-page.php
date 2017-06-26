<?php
/**
 * Front Page
 *
 * @package Simplicity
 */

get_header();

?>

<section id="pwps-front-page" <?php pwps_the_section_class(); ?>>

	<div <?php pwps_the_loop_class(); ?>>

		<?php
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'page' );

			endwhile;

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>

	</div>

	<?php pwps_the_sidebar(); ?>

</section>

<?php get_footer(); ?>