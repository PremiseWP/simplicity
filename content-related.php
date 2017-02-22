<?php
/**
 * Content Related Posts Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-related-post span7' ); ?>>

	<?php get_template_part( 'view/view', 'content-loop' ); ?>

</article>