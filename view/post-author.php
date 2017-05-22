<?php
/**
 *
 */

$author = get_user_by('id', $post->post_author);

?>
<section id="pwps-post-author">
	<div class="pwp-clear-float pwps-post-author">
		<div class="pwp-float-left pwps-post-author-avatar">
			<?php echo get_avatar( $author->ID, 150, '', 'the post author', array( 'class' => 'pwp-responsive' ) ); ?>
		</div>
		<h4><?php echo esc_attr( $author->display_name ); ?></h4>
		<p><?php echo nl2br( $author->description ); ?></p>
	</div>
</section>