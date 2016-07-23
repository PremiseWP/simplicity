<?php
/**
 * Front Page
 *
 * @package sangreea
 */

get_header();

?>

<section id="pwps-front-page">

	<div class="pwps-container">

		<?php
		/**
		 * The loop. Check if we have posts and display them.
		 */
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				?>

				<div class="pwps-home-intro">
					<div class="premise-align-center">
						<h3>We bring software and cloud based solutions to industries that need them.</h3>
					</div>
				</div>

				<div class="pwps-home-portfolio">
					<h2 class="premise-align-center">Most recent projects</h2>
					<?php get_template_part( 'content' ); ?>
				</div>
				<?php
			endwhile;

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>

	</div>
</section>

<?php get_footer(); ?>