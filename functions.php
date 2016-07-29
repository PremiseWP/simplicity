<?php
/**
 * Functions Library
 *
 * Theme Prefix: 'pwps_'
 *
 * @package Simplicity
 */


// Includes
require 'library/theme-setup.php';
require 'library/simplicity.php';
require 'classes/class-customizer.php';
require 'classes/class-options-page.php';
require 'classes/class-nav-search.php';


// Add theme supprt
if ( function_exists( 'add_theme_support' ) ) {
	// Add Menu Support.
	add_theme_support( 'menus' );

	// Add Thumbnail Theme Support.
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'video', 'image' ) );

	// custom logo in customizer
	add_theme_support( 'custom-logo', array(
		'size' => 'custom-logo-size',
	) );

	// Image sizes
	add_image_size( 'pwps-thumbnail', 800, 800 ); // post thumbnails
	add_image_size( 'custom-logo-size', 300, 150 ); // custom logo size
}


// Hooks
if ( function_exists( 'add_action' ) ) {
	// On theme activation.
	add_action( 'after_theme_setup', 'pwps_theme_setup' );

	// Register menus
	add_action( 'init', 'pwps_register_menu' );

	// add the theme options page
	// add_action( 'init', array( PWPS_Theme_Options::get_instance(), 'init' ) ); // For now we do not have an options page
	add_action( 'customize_register' , array( PWPS_Theme_Customizer::get_instance(), 'init' ) );

	// Enqueue scripts.
	add_action( 'wp_enqueue_scripts', 'pwps_enqueue_scripts' );

	// register the ajax action to the nav search functionality
	add_action( 'wp_ajax_pwps_nav_search', array( PWPS_Nav_Search::get_instance(), 'pwps_nav_search' ) );
	add_action( 'wp_ajax_nopriv_pwps_nav_search', array( PWPS_Nav_Search::get_instance(), 'pwps_nav_search' ) );

	// register the ajax action for infinite scroll
	add_action( 'wp_ajax_pwps_load_more_posts', 'pwps_load_more_posts' );
	add_action( 'wp_ajax_nopriv_pwps_load_more_posts', 'pwps_load_more_posts' );

	// insert the dynamic css into the head of the DOM
	add_action( 'wp_head', 'pwps_load_custom_css', 99 );

	// Print styles and scripts for the customizer to work properly
	add_action( 'customize_controls_print_styles', 'pwps_customizer_control_styles' );
	add_action( 'customize_controls_print_scripts', 'pwps_enqueue_customizer_js' );
}