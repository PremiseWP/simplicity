<?php
/**
 * Content Related Posts Template
 *
 * @package Simplicity
 */

?>

<article <?php post_class( 'pwps-post pwps-blog-post' ); ?>>

	<?php get_template_part( 'view/view', 'content-loop' ); ?>

</article>