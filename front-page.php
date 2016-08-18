<?php
/**
 * Front Page
 *
 * @package Simplicity
 */

get_header();

?>

<section id="pwps-front-page"<?php pwps_the_section_class(); ?>>

	<?php get_template_part( 'loop' ); ?>

</section>

<?php get_footer(); ?>