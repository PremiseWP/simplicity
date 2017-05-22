<?php
/**
 * Single Post Template
 *
 * @package Simplicity
 */

get_header();

?>

<section id="single"<?php pwps_the_section_class(); ?>>

	<div <?php pwps_the_loop_class(); ?>>

		<?php
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'content', pwps_get_post_format() );

				get_template_part( 'view/post', 'author');

				get_template_part( 'loop', 'related' );

				if ( ( comments_open() || get_comments_number() ) ) :
					comments_template();
				endif;

			endwhile;

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>

	</div>

	<?php pwps_the_sidebar(); ?>

</section>

<?php get_footer(); ?>