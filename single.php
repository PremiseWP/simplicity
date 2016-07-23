<?php
/**
 * Single Post Template
 *
 * @package sangreea
 */

get_header();

?>

<section id="single">

	<div class="pwps-container">

		<?php
		/**
		 * The loop. Check if we have posts and display them.
		 */
		if ( have_posts() ) :

			while ( have_posts() ) : the_post(); ?>

				<div class="post-title">
					<h1><?php the_title(); ?></h1>
				</div>

				<?php get_template_part( 'content' );

				// display comments if we comments are open and we have at least one comment
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

			endwhile;

			pwps_pagination();

			get_template_part( 'loop', 'related' );

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>

	</div>
</section>

<?php get_footer(); ?>