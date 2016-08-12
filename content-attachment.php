<?php
/**
 * Content Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-post pwps-attachment-post' ); ?>>

	<div class="pwps-post-title">
		<h1><?php the_title(); ?></h1>
	</div>

	<div class="post-content">
		<blockquote class="pwps-post-caption">
			<?php the_excerpt(); ?>
		</blockquote>
		<?php the_content();
		$defaults = array(
			'before'           => '<p class="pwps-link-pages-ajax">' . __( 'Pages:' ),
			'after'            => '</p>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'separator'        => ' ',
			'nextpagelink'     => __( 'Next page' ),
			'previouspagelink' => __( 'Previous page' ),
			'pagelink'         => '%',
			'echo'             => 1
		);
	 
	    wp_link_pages( $defaults ); ?>
	</div>

	<div class="pwps-posts-navigation">
		<p><?php posts_nav_link(); ?></p>
	</div>

</article>

<?php get_template_part( 'loop', 'related' );

// get the comments
if ( ( comments_open() || get_comments_number() ) ) comments_template(); ?>