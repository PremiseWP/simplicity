<?php
/**
 * The loop
 *
 * @package Simplicity
 */

?>

<div class="pwps-container pwps-the-loop">

	<?php
	/**
	 * The loop. Check if we have posts and display them.
	 */
	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			if ( ! is_home() && ! is_front_page() ) : ?>

				<div class="pwps-post-title">
					<h1><?php the_title(); ?></h1>
				</div>

			<?php endif; ?>

			<?php get_template_part( 'content' );

			// display comments if we comments are open and we have at least one comment
			if ( is_singular() && ( comments_open() || get_comments_number() ) ) {
				comments_template();
			}

		endwhile;

		pwps_pagination();

		if ( is_singular() ) :

			get_template_part( 'loop', 'related' );

		endif;

	else :

		get_template_part( 'content', 'none' );

	endif;
	?>

</div>