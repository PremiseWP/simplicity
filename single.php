<?php
/**
 * Single Post Template
 *
 * @package Simplicity
 */

get_header();

$sdbar = is_active_sidebar( 'pwps-sidebar' ) ? true : false;

?>

<section id="single"<?php echo $sdbar ? ' class="premise-row"' : '' ?>>

	<?php get_template_part( 'loop' ); ?>

	<?php if ( $sdbar ) : ?>
		<div class="pwps-main-sidebar span4">
			<ul class="pwps-sidebar">
				<?php dynamic_sidebar( 'pwps-sidebar' ); ?>
			</ul>
		</div>
	<?php endif; ?>

</section>

<?php get_footer(); ?>