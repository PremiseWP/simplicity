<?php
/**
 * Home / Blog Page Template
 *
 * @package Simplicity
 */

get_header();

global $pwps_has_sidebar;
?>

<section id="pwps-home"<?php echo $pwps_has_sidebar ? ' class="premise-row"' : '' ?>>

	<?php get_template_part( 'loop' ); ?>

</section>

<?php get_footer(); ?>