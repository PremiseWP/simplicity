<?php
/**
 * Content Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-post' ); ?>>


	<?php if ( ! is_home() && ! is_front_page() ) : ?>
		<div class="pwps-post-title">
			<h1><?php the_title(); ?></h1>
		</div>
	<?php endif; ?>

	<div class="post-content">
		<?php the_content(); ?>
	</div>

</article>

<?php get_template_part( 'loop', 'related' );

// get the comments
if ( ( comments_open() || get_comments_number() ) ) comments_template(); ?>