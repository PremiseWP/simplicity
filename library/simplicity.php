<?php
/**
 * Global function for Simplicity theme. This are the theme tags used in the front end - for the most part.
 *
 * All function afre wrapped around and if() statement to determine if the function already exists. This is
 * to allow child theme developers to fully control the outcome of these function by overwritting them and
 * never having conflicts with theme updates.
 *
 * @package Simplicity\Library
 */


if ( ! function_exists( 'pwps_main_nav' ) ) {
	/**
	 * Output the main navigation
	 *
	 * @return string the html for the main navingation
	 */
	function pwps_main_nav() {

		wp_nav_menu(
			array(
				'theme_location'  => 'header-menu', // DO NOT MODIFY.
				'menu'            => '',
				'container'       => 'div',
				'container_class' => 'pwps-nav-menu-container',
				'container_id'    => '',
				'menu_class'      => 'pwps-nav-menu',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => '',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul>%3$s</ul>',
				'depth'           => 0,
			)
		);
	}
}


if ( ! function_exists( 'pwps_the_logo' ) ) {
	/**
	 * Output the logo which comes from the custom logo option built into wordpress
	 *
	 * @see https://developer.wordpress.org/reference/functions/the_custom_logo/ for more info on the_custom_logo()
	 *
	 * @return string html for logo including link
	 */
	function pwps_the_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
}




if ( ! function_exists( 'pwps_pagination' ) ) {
	/**
	 * display the pagination for the site
	 *
	 * @return string html for pagination
	 */
	function pwps_pagination() {
		global $wp_query;

		$big = 999999999; // need an unlikely integer

		$args = array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'mid_size' => 0,
			'prev_text' => '<i class="fa fa-chevron-left"></i>',
			'next_text' => '<i class="fa fa-chevron-right"></i>',
		);

		$html  = '<div class="pwps-pagination">';
		$html .= paginate_links( $args );
		$html .= '</div>';

		echo (string) $html;
	}
}



if ( ! function_exists( 'pwps_load_custom_css' ) ) {
	/**
	 * loads the custom css into the header of Wordpress
	 *
	 * @return string the custom css set from options in the backend
	 */
	function pwps_load_custom_css() {
		?>
		<style type="text/css">
			<?php
			echo pwps_get_container_max_width();
			echo pwps_get_header_styles();
			?>
		</style>
		<?php
		return (string) $_css;
	}
}




if ( ! function_exists( 'pwps_get_container_max_width' ) ) {
	/**
	 * returns teh max width for the main container.
	 *
	 * @todo RegExp to remove ; or other characters. need clean up.
	 *
	 * @return string the max width for the main caontainer
	 */
	function pwps_get_container_max_width() {
		$max_width = (string) premise_get_value( 'pwps_theme_options[container-max-width]' );

		$_css = '';

		// set the max-width
		$_css .= ( '' !== $max_width ) ? '.pwps-container{max-width:'.$max_width.';}' : '';

		return esc_attr( (string) $_css );
	}
}




if( ! function_exists( 'pwps_get_header_styles' ) ) {
	/**
	 * Return the css for the header container.
	 *
	 * @return string css for header container
	 */
	function pwps_get_header_styles() {
		$header = premise_get_value( 'pwps_customizer_options[header]' );
		// $nav_icon_color = (string) premise_get_value( 'pwps_customizer_options[nav-icon-color]' );

		$_css = '';

		// set the header background
		$_css .= ( ( isset( $header['background-color'] ) && '' !== $header['background-color'] )
					|| ( isset( $header['opacity'] ) && '' !== $header['opacity'] ) )
						? '#pwps-header .pwps-header-overlay{background-color:'.$header['background-color'].';opacity:'.$header['opacity'].'}'
							: '';

		// set the nav icon color
		$_css .= ( isset( $header['color'] ) && '' !== $header['color'] ) ? '#pwps-nav-toggle-a{color:'.$header['color'].';}' : '';

		return esc_attr( (string) $_css );
	}
}




if ( ! function_exists( 'pwps_get_nav_icon' ) ) {
	/**
	 * gets the fa icon to use for the nav
	 *
	 * @todo add validation
	 *
	 * @return string fa icon code to use
	 */
	function pwps_get_nav_icon() {
		return esc_attr( (string) premise_get_value( 'pwps_theme_options[nav-icon]' ) );
	}
}

?>