<?php
/**
 * Attachment Page Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-post pwps-attachment-post' ); ?>>

	<div class="pwps-post-title">
		<h1><?php the_title(); ?></h1>
	</div>

	<div class="post-content">
		<div class="pwps-attachment-image">
			<?php echo wp_get_attachment_image( get_the_ID(), 'full', true, array( 'class' => 'premise-responsive' ) ); ?>
		</div>

		<?php if ( get_the_excerpt() ) : ?>
			<blockquote class="pwps-attachment-caption">
				<?php the_excerpt(); ?>
			</blockquote>
		<?php endif; ?>

		<div class="pwps-attachment-content">
			<h3>More on this attachment</h3>
			<p>Click on the thumbnail or url below to open the attachment.</p>
			<?php the_content(); ?>
		</div>
	</div>

	<div class="pwps-posts-navigation">
		<p><?php posts_nav_link(); ?></p>
	</div>

</article>

<?php get_template_part( 'loop', 'related' );

// get the comments
if ( ( comments_open() || get_comments_number() ) ) comments_template(); ?>