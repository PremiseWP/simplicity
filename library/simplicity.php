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
	 * display the pagination element that triggers the infinite scroll when in view
	 *
	 * @return string html for pagination
	 */
	function pwps_pagination() {
		?>

		<div class="pwps-infinte-pagination">
			<i class="fa fa-spin fa-spinner"></i>
			<span>Loading more posts...</span>
		</div>

		<?php
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
			// echo pwps_get_container_max_width();
			echo pwps_get_header_styles();
			echo pwps_get_body_styles();
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
		/**
		 * holds associative array with header styles already cleaned up.
		 *
		 * Returns the following values:
		 * - opacity          => '' (string)
		 * - background-color => '' (string)
		 * - color            => '' (string)
		 *
		 * @see pwps_escape_string this function returns "safe to use" values.
		 *
		 * @var array
		 */
		$header = array_map('pwps_escape_string', (array) premise_get_value( 'pwps_customizer_options[header]' ) );

		// if there is no css, set the default css
		$hbgc = ( isset( $header['background-color'] )  && ! empty( $header['background-color'] ) ) ? $header['background-color'] : '#FDFDFD';
		$hop  = ( isset( $header['opacity'] )           && ! empty( $header['opacity'] ) )          ? $header['opacity']          : '0.6';
		$hcol = ( isset( $header['color'] )             && ! empty( $header['color'] ) )            ? $header['color']            : '#444444';

		$_css = ''; // start with an empty string

		// set the header background and opacity
		$_css .= '#pwps-header .pwps-header-overlay {
			background-color: '.$hbgc.';
			opacity: '.$hop.';
		}';

		// set the header color
		$_css .= '#pwps-header {
			color:'.$hcol.';
		}';

		return esc_attr( (string) $_css );
	}
}


if( ! function_exists( 'pwps_get_body_styles' ) ) {
	/**
	 * Return the css for the body container.
	 *
	 * @return string css for body container
	 */
	function pwps_get_body_styles() {
		/**
		 * holds associative array with body styles already cleaned up.
		 *
		 * Returns the following values:
		 * - opacity          => '' (string)
		 * - background-color => '' (string)
		 * - color            => '' (string)
		 *
		 * @see pwps_escape_string this function returns "safe to use" values.
		 *
		 * @var array
		 */
		$body = array_map('pwps_escape_string', (array) premise_get_value( 'pwps_customizer_options[body]' ) );

		// if there is no css, set the default css
		$width = ( isset( $body['max-width'] )        && ! empty( $body['max-width'] ) )        ? $body['max-width']        : '1200px';

		$bbgc  = ( isset( $body['background-color'] ) && ! empty( $body['background-color'] ) ) ? $body['background-color'] : '#FFFFFF';
		$bcol  = ( isset( $body['color'] )            && ! empty( $body['color'] ) )            ? $body['color']            : '#444444';

		$h1col = ( isset( $body['h1-color'] )         && ! empty( $body['h1-color'] ) )         ? $body['h1-color']         : '#222222';
		$h2col = ( isset( $body['h2-color'] )         && ! empty( $body['h2-color'] ) )         ? $body['h2-color']         : '#222222';

		$_css = ''; // start with an empty string

		// set the body background and opacity
		$_css .= '.pwps-site-body {
			background-color: '.$bbgc.';
			color: '.$bcol.';
		}';

		$_css .= 'h1 {
			color: '.$h1col.';
		}';

		$_css .= 'h2 {
			color: '.$h2col.';
		}';

		$_css .= '.pwps-container {
			max-width: '.$width.';
		}';

		return esc_attr( (string) $_css );
	}
}



if ( ! function_exists( 'pwps_escape_string' ) ) {
	/**
	 * Cleans up a string to make it safe to use. Validation for the correct value or type of value should be done when safed in the database.
	 *
	 * It encodes the <, >, &, ” and ‘ (less than, greater than, ampersand, double quote and single quote) characters.
	 * Then returns the string escaped for HTML output.
	 *
	 * @link https://developer.wordpress.org/reference/functions/esc_html/ esc_html() documentation
	 * @link https://developer.wordpress.org/reference/functions/esc_attr/ esc_attr() documentation
	 *
	 * @param  string $string string to clean up
	 * @return string         string already cleaned up
	 */
	function pwps_escape_string( $string ) {
		return ( '' !== $string ) ? esc_html( esc_attr( trim( (string) $string ) ) ) : '';
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
		return esc_attr( (string) premise_get_value( 'pwps_customizer_options[header][nav-icon]' ) );
	}
}



if ( ! function_exists( 'pwps_load_more_posts' ) ) {
	/**
	 * load more posts via ajax for infinte croll
	 *
	 * @wp-hook wp_ajax_pwps_load_more_posts
	 * @wp-hook wp_ajax_nopriv_pwps_load_more_posts
	 *
	 * @return  string html for pots
	 */
	function pwps_load_more_posts() {
		$paged = $_POST['page'];

		$query = new WP_Query( array( 'paged' => $paged ) );

		if ( $query->have_posts() ) {
			while( $query->have_posts() ) {
				$query->the_post();
				get_template_part( 'content', 'loop' );
			}
		}
		else {
			die( '' ); // return empty string when no more posts were found
		}

		die(); // always dies at the end for ajax calls
	}
}



if ( ! function_exists( 'pwps_customizer_control_styles' ) ) {
	/**
	 * Enqueue our CSS file for the theme customizer controls
	 *
	 * @return void enqueues the css file to be loaded on the customizer page
	 */
	function pwps_customizer_control_styles() {
		wp_enqueue_style(
			'simplicity-customizer-css',			//Give the script an ID
			get_template_directory_uri().'/css/theme-customizer.css'
		);
	}
}



if ( ! function_exists( 'pwps_enqueue_customizer_js' ) ) {
	/**
	 * Enqueue our JS file for the theme customizer controls
	 *
	 * @return void enqueues the js file to be loaded on the customizer page
	 */
	function pwps_enqueue_customizer_js() {
		wp_enqueue_script(
			'simplicity-customizer-js',			//Give the script an ID
			get_template_directory_uri().'/js/theme-customizer.js',//Point to file
			array( 'jquery' ),	//Define dependencies
			'',						//Define a version (optional)
			true						//Put script in footer?
		);
	}
}
?>