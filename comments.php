<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package sangreea
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="pwps-comments" class="pwps-comments-area">

	<?php
	if ( have_comments() ) : ?>
		<h2 class="pwps-comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'pwps-text-domain' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s comment on %2$s',
							'%1$s comments on %2$s',
							$comments_number,
							'comments title',
							'pwps-text-domain'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h2>

		<?php //the_comments_navigation(); ?>

		<ol class="pwps-comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 100,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php //the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="pwps-no-comments"><?php _e( 'Comments are closed.', 'pwps-text-domain' ); ?></p>
	<?php endif; ?>

	<?php
		comment_form( array(
			'title_reply' => 'Send us your comments..',
			'title_reply_before' => '<h2 id="reply-title" class="pwps-comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'id_form' => 'pwps-comment-form',
		) );
	?>

</div><!-- .comments-area -->