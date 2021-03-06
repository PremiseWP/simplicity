<?php
/**
 * Functions necessary to setup the theme.
 *
 * @package Simplicity\Library
 */


// Add theme supprt
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	// Add Menu Support.
	add_theme_support( 'menus' );

	// Add Thumbnail Theme Support.
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'video', 'image', 'gallery', 'quote', 'aside' ) );

	// custom logo in customizer
	add_theme_support( 'custom-logo', array(
		'size'        => 'custom-logo-size',
		'header-text' => array( 'pwps-site-title' ),
	) );

	// Image sizes
	add_image_size( 'pwps-thumbnail', 800, 800 ); // post thumbnails
	add_image_size( 'custom-logo-size', 300, 150 ); // custom logo size

	// add woocommerce support
	add_theme_support( 'woocommerce' );

	add_theme_support( 'infinite-scroll', array(
	    'container'      => 'pwps-loop',
	    'render'         => 'pwps_the_loop',
	    'footer'         => 'pwps-header', // match width of the header to set the fixed footer
	    'footer_widgets' => array(
	    	'pwps-footer-1-sidebar',
	    	'pwps-footer-2-sidebar',
	    	'pwps-footer-3-sidebar',
	    	'pwps-footer-4-sidebar',
	    ),
	) );
}


if ( ! function_exists( 'pwps_theme_activation' ) ) {
	/**
	 * Activate our theme!
	 *
	 * This function runs right after our theme is activated and runs only once. Perfect to set things like defaults.
	 *
	 * @return void
	 */
	function pwps_theme_activation() {
		// set the header text in case there is no logo
		set_theme_mod( 'header_text', ( ! get_theme_mod( 'header_text' ) ) ? true : false );
	}
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
		if ( ! get_option( 'pwps_customizer_options' ) )
			update_option( 'pwps_customizer_options', PWPS_Theme_Customizer::$default_options );
		// flush rewrite rules
		// flush_rewrite_rules();
	}
}


if ( ! function_exists( 'pwps_enqueue_scripts' ) ) {
	/**
	 * Enqueue theme scripts in the front end
	 *
	 * @return void
	 */
	function pwps_enqueue_scripts() {
		wp_register_style(  'pwps_gfonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,700|Source+Code+Pro:300,400' );
		wp_register_style(  'pwps_css'   , get_template_directory_uri() . '/css/style.min.css', array( 'pwps_gfonts' ) );
		wp_register_script( 'pwps_js'    , get_template_directory_uri() . '/js/script.min.js' );

		if ( ! is_admin() ) {
			wp_enqueue_style(  'pwps_css' );
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
		$span = is_active_sidebar( 'pwps-woocommerce-sidebar' ) ? 'span8' : 'span12';
		echo '<section id="pwps-woocommerce" class="premise-row"><div class="pwps-the-loop '.$span.'">';
	}
}


if ( ! function_exists( 'pwps_woocommerce_wrapper_end' ) ) {
	/**
	 * End woocommerce wrappers
	 *
	 * @return string End of wrapper
	 */
	function pwps_woocommerce_wrapper_end() {
			echo '</div>';

			if ( is_active_sidebar( 'pwps-woocommerce-sidebar' ) ) {
				echo '<div class="pwps-woocommerce-sidebar span4"><ul class="pwps-sidebar">';
					dynamic_sidebar( 'pwps-woocommerce-sidebar' );
				echo '</ul></div>';
			}

		echo '</section>';
	}
}


if ( ! function_exists( 'pwps_widgets_init' ) ) {
	/**
	 * Initiate our widgets. registers sidebars
	 *
	 * @return void registers sidebar
	 */
	function pwps_widgets_init() {
		// these attributes apply to all our sidebars. Why write them multiple times?
		$sidebar_attrs = array(
			'before_widget' => '<li id="%1$s" class="pwps-widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="pwps-widget-title">',
			'after_title'   => '</h2>',
		);
		// The main sidebar
		$sidebars['sidebar'] = array(
			'name'          => __( 'Simplicity Sidebar', 'pwps_text_domain' ),
			'id'            => 'pwps-sidebar',
			'description'   => __( 'Widgets in this area will be displayed on your posts and blog page.', 'pwps_text_domain' ),
		);
		// The nav-footer sidebar
		$sidebars['nav-footer'] = array(
			'name'          => __( 'Simplicity Nav Footer', 'pwps_text_domain' ),
			'id'            => 'pwps-nav-footer',
			'description'   => __( 'Widgets in this area will be displayed on your Main Site\'s Navigation fixed to the bottom. Ideal for Social Profiles.', 'pwps_text_domain' ),
		);
		// sidebar for woocommerce pages
		$sidebars['woocommerce'] = array(
			'name'          => __( 'Simplicity Woocommerce', 'pwps_text_domain' ),
			'id'            => 'pwps-woocommerce-sidebar',
			'description'   => __( 'Widgets in this area will be displayed on the woocommerce pages.', 'pwps_text_domain' ),
		);
		// sidebar for footer-1 pages
		$sidebars['footer-1'] = array(
			'name'          => __( 'Simplicity Footer Column 1', 'pwps_text_domain' ),
			'id'            => 'pwps-footer-1-sidebar',
			'description'   => __( 'Widgets in this area will be displayed in the footer of your site on the first column.', 'pwps_text_domain' ),
		);
		// sidebar for footer-2 pages
		$sidebars['footer-2'] = array(
			'name'          => __( 'Simplicity Footer Column 2', 'pwps_text_domain' ),
			'id'            => 'pwps-footer-2-sidebar',
			'description'   => __( 'Widgets in this area will be displayed in the footer of your site on the second column.', 'pwps_text_domain' ),
		);
		// sidebar for footer-3 pages
		$sidebars['footer-3'] = array(
			'name'          => __( 'Simplicity Footer Column 3', 'pwps_text_domain' ),
			'id'            => 'pwps-footer-3-sidebar',
			'description'   => __( 'Widgets in this area will be displayed in the footer of your site on the third column.', 'pwps_text_domain' ),
		);
		// sidebar for footer-4 pages
		$sidebars['footer-4'] = array(
			'name'          => __( 'Simplicity Footer Column 4', 'pwps_text_domain' ),
			'id'            => 'pwps-footer-4-sidebar',
			'description'   => __( 'Widgets in this area will be displayed in the footer of your site on the fourth column.', 'pwps_text_domain' ),
		);
		// loop and register the sidebars
		foreach ( $sidebars as $k => $sidebar ) {
			register_sidebar( array_merge( $sidebar, $sidebar_attrs ) );
		}
	}
}


if ( ! function_exists( 'pwps_register_meta_box' ) ) {
	/**
	 * Calls the class on the post edit screen.
	 */
	function pwps_register_meta_box() {
	    new PWPS_Meta_Box();
	}
}
?>