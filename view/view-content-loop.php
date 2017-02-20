<?php
/**
 * View teplate for loop and related loop
 *
 * @package simplicity\view
 */

?>

<div class="pwps-post-title">
	<a href="<?php the_permalink(); ?>">
		<h2><?php the_title(); ?></h2>
	</a>
</div>

<?php if ( has_post_thumbnail() ) : ?>
	<div class="pwps-post-thumbnail">
		<a href="<?php the_permalink(); ?>" class="premise-block">
			<?php the_post_thumbnail( 'pwps-thumbnail', array( 'class' => 'premise-responsive' ) ); ?>
		</a>
	</div>
<?php endif; ?>

<div class="pwps-post-excerpt">
	<?php the_excerpt(); ?>
</div>


<?php pwps_the_post_meta(); ?>