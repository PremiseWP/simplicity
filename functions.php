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
	add_action( 'init', array( PWPS_Theme_Options::get_instance(), 'init' ) );

	// Enqueue scripts.
	add_action( 'wp_enqueue_scripts', 'pwps_enqueue_scripts' );

	add_action( 'wp_ajax_pwps_nav_search', array( PWPS_Nav_Search::get_instance(), 'pwps_nav_search' ) );
	add_action( 'wp_ajax_nopriv_pwps_nav_search', array( PWPS_Nav_Search::get_instance(), 'pwps_nav_search' ) );

	add_action( 'wp_head', 'pwps_load_custom_css', 99 );
}