<?php
/**
 * Functions necessary to setup the theme.
 *
 * @package Simplicity\Library
 */


// Require Premise WP if it does not exist.
if ( ! class_exists( 'Premise_WP' ) ) {
	require get_template_directory() . '/includes/require-premise-wp.php';
}


//  Hide the admin bar in the front end
show_admin_bar( false );

// setup theme
if ( ! function_exists( 'pwps_theme_setup' ) ) {
	/**
	 * Setup the theme once it is activated.
	 *
	 * This function runs only once when you activate the theme. It performs tasks that should NOT be ran on every page load such as flushing rewrite rules.
	 *
	 * @return void
	 */
	function pwps_theme_setup() {
		// flush rewrite rules
		flush_rewrite_rules();
	}
}


// Enqueue styles and scripts
if ( ! function_exists( 'pwps_enqueue_scripts' ) ) {
	/**
	 * Enqueue theme scripts in the front end
	 *
	 * @return void
	 */
	function pwps_enqueue_scripts() {
		wp_register_style( 'pwps_css', get_template_directory_uri() . '/css/style.min.css' );
		wp_register_script( 'pwps_js', get_template_directory_uri() . '/js/script.min.js', array( 'jquery' ) );

		if ( ! is_admin() ) {
			wp_enqueue_style( 'pwps_css' );
			wp_enqueue_script( 'pwps_js' );
		}
	}
}



// Register menu locations
if ( ! function_exists( 'pwps_register_menu' ) ) {
	/**
	 * Register theme menu location
	 *
	 * @return void
	 */
	function pwps_register_menu() {

		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu', '' ), // Main Navigation.
			)
		);
	}
}

?>
