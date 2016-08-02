<?php
/**
 * The loop
 *
 * @package Simplicity
 */

?>

<div class="pwps-the-loop">

	<?php
	/**
	 * The loop. Check if we have posts and display them.
	 */
	if ( have_posts() ) :

		while ( have_posts() ) : the_post(); ?>

			<div class="pwps-post-title">
				<h1><?php the_title(); ?></h1>
			</div>

			<?php
			if ( is_singular() ) :
				get_template_part( 'content' );
			else :
				get_template_part( 'content', 'loop' );
			endif;

			// display comments if we comments are open and we have at least one comment
			if ( is_singular() && ( comments_open() || get_comments_number() ) ) {
				comments_template();
			}

		endwhile;

		if ( is_singular() ) :

			get_template_part( 'loop', 'related' );

		endif;

	else :

		get_template_part( 'content', 'none' );

	endif;
	?>

</div>

<?php pwps_pagination(); ?>