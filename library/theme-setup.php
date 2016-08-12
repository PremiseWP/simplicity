<?php
/**
 * Functions necessary to setup the theme.
 *
 * @package Simplicity\Library
 */


//  Hide the admin bar in the front end
show_admin_bar( true );

// Add theme supprt
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	// Add Menu Support.
	add_theme_support( 'menus' );

	// Add Thumbnail Theme Support.
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'video', 'image', 'gallery' ) );

	// custom logo in customizer
	add_theme_support( 'custom-logo', array(
		'size' => 'custom-logo-size',
	) );

	// Image sizes
	add_image_size( 'pwps-thumbnail', 800, 800 ); // post thumbnails
	add_image_size( 'custom-logo-size', 300, 150 ); // custom logo size

	// add woocommerce support
	add_theme_support( 'woocommerce' );
}


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


if ( ! function_exists( 'pwps_woocommerce_wrapper_start' ) ) {
	/**
	 * Begin woocommerce wrappers
	 *
	 * @return string begining of wrapper
	 */
	function pwps_woocommerce_wrapper_start() {
	  echo '<section id="pwps-woocommerce"><div class="pwps-the-loop">';
	}
}


if ( ! function_exists( 'pwps_woocommerce_wrapper_end' ) ) {
	/**
	 * End woocommerce wrappers
	 *
	 * @return string End of wrapper
	 */
	function pwps_woocommerce_wrapper_end() {
	  echo '</div></section>';
	}
}
?>
