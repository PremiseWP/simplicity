<?php
/**
 * Single Post Template
 *
 * @package Simplicity
 */

get_header();

?>

<section id="single">
	<div id="pwps-content" class="pwps-container">

		<div <?php pwps_the_section_class(); ?>>
			<div class="<?php echo pwps_uses_sidebar() ? ' span8' : 'span12'; ?>">

				<?php
				if ( have_posts() ) :

					while ( have_posts() ) : the_post();

						get_template_part( 'content', pwps_get_post_format() );

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
		</div>

	</div>
</section>

<?php get_footer(); ?>