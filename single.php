<?php
/**
 * Single Post Template
 *
 * @package Simplicity
 */

get_header();

?>

<section id="single"<?php pwps_the_section_class(); ?>>

	<?php get_template_part( 'loop' ); ?>

</section>

<?php get_footer(); ?>