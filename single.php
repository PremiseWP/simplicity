<?php
/**
 * Single Post Template
 *
 * @package Simplicity
 */

get_header();

/**
 * check if the main seidebar is active
 *
 * @var boolean
 */
$pwps_has_sidebar = is_active_sidebar( 'pwps-sidebar' ) ? true : false;

?>

<section id="single"<?php echo $pwps_has_sidebar ? ' class="premise-row"' : '' ?>>

	<?php get_template_part( 'loop' ); ?>

	<?php if ( $pwps_has_sidebar ) : ?>
		<div class="pwps-main-sidebar span4">
			<ul class="pwps-sidebar">
				<?php dynamic_sidebar( 'pwps-sidebar' ); ?>
			</ul>
		</div>
	<?php endif; ?>

</section>

<?php get_footer(); ?>