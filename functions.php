<?php
/**
 * Functions Library
 *
 * Theme Prefix: 'pwps_'
 *
 * @package Simplicity
 */


// Require Premise WP if it does not exist.
if ( ! class_exists( 'Premise_WP' ) ) {
	require 'includes/require-premise-wp.php';
}


// Includes
require 'library/theme-setup.php';
require 'library/simplicity.php';
require 'classes/class-nav-search.php';
require 'classes/class-customizer.php';
require 'classes/class-options-page.php';


// Hooks
if ( function_exists( 'add_action' ) ) {

	/*
		These functions are located in library/theme-setup.php
	 */
	
	// On theme activation.
	add_action( 'after_theme_setup', 'pwps_theme_setup' );

	// Register menus
	add_action( 'init', 'pwps_register_menu' );

	// initiate the widgets
	add_action( 'widgets_init', 'pwps_widgets_init' );

	// Enqueue scripts.
	add_action( 'wp_enqueue_scripts', 'pwps_enqueue_scripts' );
	

	/*
		These functions are located in library/simplicity.php
	 */
	
	// register the ajax action for infinite scroll
	add_action( 'wp_ajax_pwps_load_more_posts',        'pwps_load_more_posts' );
	add_action( 'wp_ajax_nopriv_pwps_load_more_posts', 'pwps_load_more_posts' );

	// insert the dynamic css into the head of the DOM
	add_action( 'wp_head', 'pwps_load_custom_css', 99 );

	// Print styles and scripts for the customizer to work properly
	add_action( 'customize_controls_print_styles',  'pwps_customizer_control_styles' );
	add_action( 'customize_controls_print_scripts', 'pwps_enqueue_customizer_js' );

	// Remove woocommerce defult wrappers and sidebar
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper',     10);
	remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10);
	remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar',                10);

	// add our own woocommerce wrappers
	add_action('woocommerce_before_main_content', 'pwps_woocommerce_wrapper_start', 10);
	add_action('woocommerce_after_main_content',  'pwps_woocommerce_wrapper_end',   10);

	// remove the default gallery css
	add_filter( 'gallery_css', 'pwps_gallery_shortcode', 20 );

	// add page links to the content
	add_filter( 'the_content', 'pwps_insert_page_links', 20 );

	/*
		These classe are located in the classes directory
	 */
	
	// add the theme options page
	// add_action( 'init', array( PWPS_Theme_Options::get_instance(), 'init' ) ); // For now we do not have an options page
	add_action( 'customize_register' , array( PWPS_Theme_Customizer::get_instance(), 'init' ) );

	// register the ajax action to the nav search functionality
	add_action( 'wp_ajax_pwps_nav_search',        array( PWPS_Nav_Search::get_instance(), 'pwps_nav_search' ) );
	add_action( 'wp_ajax_nopriv_pwps_nav_search', array( PWPS_Nav_Search::get_instance(), 'pwps_nav_search' ) );
}