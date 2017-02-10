<?php
/**
 * Home / Blog Page Template
 *
 * @package Simplicity
 */

get_header();

?>

<section id="pwps-home" <?php pwps_the_section_class(); ?>>

	<?php
	get_template_part( 'loop' );
	pwps_the_sidebar();
	pwps_pagination();
	?>

</section>

<?php get_footer(); ?>