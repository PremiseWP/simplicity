<?php
/**
 * Footer Template
 *
 * @package Simplicity
 */

?>

	</div> <!-- Close the .sangreea-content tag -->

	<footer id="pwps-footer">
		<div class="pwps-container">

			<div class="premise-row">
				<?php
				$count = 0;
				for ( $i=1; $i <= 4; $i++ ) {
					if ( pwps_uses_sidebar( 'pwps-footer-'.$i.'-sidebar', false ) ) {
						$count++;
					}
				}

				$cols = ( 2 <= $count ) ? 'col'.$count : 'span12';

				for ( $i=1; $i <= $count; $i++ ) {

					?><div class="pwps-footer-sidebar <?php echo $cols; ?>">
						<ul class="pwps-sidebar">
							<?php dynamic_sidebar( 'pwps-footer-'.$i.'-sidebar' ); ?>
						</ul>
					</div><?
				}
				?>
			</div>

			<div class="premise-align-center copyright">
				<p><?php echo pwps_get_copyright_text(); ?></p>
			</div>

		</div>
	</footer>

	<?php wp_footer(); ?>

</body>
</html>