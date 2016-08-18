<?php
/**
 * Home / Blog Page Template
 *
 * @package Simplicity
 */

get_header();

?>

<section id="pwps-home"<?php pwps_the_section_class(); ?>>

	<?php get_template_part( 'loop' ); ?>

</section>

<?php get_footer(); ?>