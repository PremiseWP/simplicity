<?php
/**
 * Home / Blog Page Template
 *
 * @package Simplicity
 */

get_header();

?>

<section id="pwps-home" <?php pwps_the_section_class(); ?>>
	<div id="pwps-content" class="pwps-container">

		<div <?php pwps_the_section_class(); ?>>
			<div <?php pwps_the_loop_class(); ?>>

				<?php
				if ( have_posts() ) :

					pwps_the_loop();

				else :

					get_template_part( 'content', 'none' );

				endif;
				?>

			</div>

			<?php pwps_the_sidebar(); ?>
		</div>

	</div>
</section>

<?php get_footer(); ?>