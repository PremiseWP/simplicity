<?php
/**
 * Front Page
 *
 * @package Simplicity
 */

get_header();

?>

<section id="pwps-front-page"<?php pwps_the_section_class(); ?>>

	<div class="pwps-loop <?php echo pwps_uses_sidebar() ? 'span8' : 'span12'; ?>">
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

	<?php pwps_the_sidebar(); ?>

</section>

<?php get_footer(); ?>