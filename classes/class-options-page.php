<?php
/**
* Adds the video url metabox
*
* @package  Simplicity\Classes
*/
class PWPS_Theme_Options {



	/**
	 * Object instance.
	 *
	 * @see get_instance()
	 *
	 * @var object
	 */
	protected static $instance = null;



	/**
	 * Register the custom post type is PremiseCPT class exists
	 *
	 * @see 	init() does the rest once our custom post type has been registered
	 * @since 	1.0
	 */
	public function __construct() {}



	/**
	 * Access this CPT's working instance
	 *
	 * @since   1.0
	 * @return  object instance of this class
	 */
	public static function get_instance() {
		null === self::$instance and self::$instance = new self;

		return self::$instance;
	}



	/**
	 * initiate CPT
	 *
	 * @since   1.0
	 */
	public function init() {
		new Premise_Options(
			array(
				'title' => 'Simplicity Theme Options',
				'menu_title' => 'Simplicity',
				'callback' => array( $this, 'options_page' ),
			),
			'',
			'pwps_theme_options',
			'pwps_theme_options_group'
		);
	}



	/**
	 * Display the options page
	 *
	 * @param string html for options page
	 */
	public function options_page() {
		$fields = array(
			array(
				'type'    => 'fa_icon',
				'name'    => 'pwps_theme_options[nav-icon]',
				'label'   => 'Select A Nav Icon',
				'default' => 'fa-search',
				'wrapper_class' => 'span4',
			),

			array(
				'type'    => 'text',
				'name'    => 'pwps_theme_options[container-max-width]',
				'label'   => 'Container Max Width',
				'tooltip' => 'Enter value in px or % to determine the main container maximum width.',
				'default' => '1200px',
				'wrapper_class' => 'span4',
			),

			array(
				'type' => 'submit',
			)
		);

		premise_field_section( $fields );
	}
}



/**
*
*/
class PWPS_Theme_Customizer extends PWPS_Theme_Options {

	/**
	 * Object instance.
	 *
	 * @see get_instance()
	 *
	 * @var object
	 */
	protected static $instance = null;


	/**
	 * Defaults
	 *
	 * @var array
	 */
	public $defaults = array(
		'header_bg_color' => '#900b04', // Dark red.
		'nav_icon_color' => '#000000', // Black.
	);


	/**
	 * Leave empty and blank
	 *
	 * @todo Add version check for 3.4.0. Customizer did not exist before
	 */
	public function __construct() {}



	/**
	 * Access this CPT's working instance
	 *
	 * @return  object instance of this class
	 */
	public static function get_instance() {
		null === self::$instance and self::$instance = new self;

		return self::$instance;
	}



	/**
	 * This hooks into 'customize_register' (available as of WP 3.4) and allows
	 * you to add new sections and controls to the Theme Customize screen.
	 *
	 * @see    add_action('customize_register',$func)
	 * @link   http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 *
	 * @param  object $wp_customize Wordpress Customize manager object.
	 */
	public function init( $wp_customize ) {

		// 1. Define a new section (if desired) to the Theme Customizer.
		$wp_customize->add_section( 'pwps_customizer_options',
			array(
				'title' => __( 'Simplicity Options', 'pwps_text_domain' ), // Visible title of section.
				'priority' => 35, // Determines what order this appears in.
				'capability' => 'edit_theme_options', // Capability needed to tweak.
			)
		);

		// 2. Register new settings to the WP database...
		$wp_customize->add_setting( 'pwps_customizer_options[header][background-color]', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
			array(
				// 'default' => $this->defaults['header_bg_color'], // Default setting/value to save.
				'type' => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport' => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		$wp_customize->add_setting( 'pwps_customizer_options[header][color]', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
			array(
				// 'default' => $this->defaults['nav_icon_color'], // Default setting/value to save.
				'type' => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport' => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		$wp_customize->add_setting( 'pwps_customizer_options[header][opacity]', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
			array(
				'default' => '0.6',
				'type' => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport' => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// Do not remove default Header Text Color setting!
		// Fixes JS errors in Customizer.
		// $wp_customize->remove_setting( 'header_textcolor' );

		// 3. Finally, we define the controls itself (which links a setting to a section and renders the HTML controls)...
		$wp_customize->add_control( new WP_Customize_Color_Control( // Instantiate the color control class.
			$wp_customize, // Pass the $wp_customize object (required).
			'pwps_customizer_header_bg_color', // Set a unique ID for the control.
			array(
				'label' => __( 'Header Background Color', 'pwps_text_domain' ), // Admin-visible name of the control.
				'section' => 'pwps_customizer_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
				'settings' => 'pwps_customizer_options[header][background-color]', // Which setting to load and manipulate (serialized is okay).
				'priority' => 1, // Determines the order this control appears in for the specified section.
			)
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( // Instantiate the color control class.
			$wp_customize, // Pass the $wp_customize object (required).
			'pwps_customizer_nav_icon_color', // Set a unique ID for the control.
			array(
				'label' => __( 'Nav Icon Color', 'pwps_text_domain' ), // Admin-visible name of the control.
				'section' => 'pwps_customizer_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
				'settings' => 'pwps_customizer_options[header][color]', // Which setting to load and manipulate (serialized is okay).
				'priority' => 2, // Determines the order this control appears in for the specified section.
			)
		) );

		$wp_customize->add_control( 'pwps_customizer_options',
			array(
				'type' => 'text', // TODO Make range input
				'label' => __( 'Header Opacity', 'pwps_text_domain' ), // Admin-visible name of the control.
				'section' => 'pwps_customizer_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
				'settings' => 'pwps_customizer_options[header][opacity]', // Which setting to load and manipulate (serialized is okay).
				// 'priority' => 3, // Determines the order this control appears in for the specified section.
			)
		);

	}
}

?>