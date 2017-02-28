<?php
/**
 * Page Template
 *
 * @package Simplicity
 */

get_header();

?>

<section id="page" <?php pwps_the_section_class(); ?>>

		<div <?php pwps_the_loop_class(); ?>>

			<?php
			if ( have_posts() ) :

				while ( have_posts() ) : the_post();

					get_template_part( 'content', pwps_get_post_format() );

				endwhile;

			else :

				get_template_part( 'content', 'none' );

			endif;
			?>

		</div>

</section>

<?php get_footer(); ?>