<?php
/**
 * Content Loop Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-blog-post' ); ?>>

	<?php get_template_part( 'view/view', 'content-loop' ); ?>

</article>