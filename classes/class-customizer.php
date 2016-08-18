<?php
/**
* This class controls the customizer options
*
* @since 1.0.0
*
* @package Simplicity\Classes
*/
class PWPS_Theme_Customizer {

	/**
	 * Object instance.
	 *
	 * @see get_instance()
	 *
	 * @var object
	 */
	protected static $instance = null;


	public static $default_options = array(
		'header' => array(
			'nav-icon'         => 'fa-empire',
			'background-color' => '#2b7ae7',
			'color'            => '#FDFDFD',
			'opacity'          => '1',
		),
		'body'   => array(
			'width'            => '90%',
			'max-width'        => '1200px',
			'background-color' => '#FDFDFD',
			'color'            => '#444444',
			'h1-color'         => '#222222',
			'h2-color'         => '#222222',
			'accent-color'     => '#2b7ae7',
			'link-color'       => '#000000',
		),
		'footer' => array(
			'copyright' => '%COPY% %YEAR% %SITENAME%. All Rights Reserved.',
		),
		'buttons' => array(
			'primary-bg' => '#54D4F7',
			'primary-text' => '#FFFFFF',
			'primary-bg-hover' => '#2b7ae7',
			'primary-text-hover' => '#FDFDFD',
			// secondary btn 
			'secondary-bg' => '#AAAAAA',
			'secondary-text' => '#FCFCFC',
			'secondary-bg-hover' => '#CCCCCC',
			'secondary-text-hover' => '#FDFDFD',
			// warning btn 
			'warning-bg' => '#EEEEEE',
			'warning-text' => '#F05000',
			'warning-bg-hover' => '#f05000',
			'warning-text-hover' => '#FDFDFD',
		), 
	);


	
	protected $options = array();


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
		// save the wp_cusomize object for later use
		$this->customize = $wp_customize;

		$this->set_options();

		foreach ($this->options as $k => $section) {
			$this->register_section( $section );
		}
	}


	/**
	 * This function registers the settings for our customizer so that we dont have to do each setting manually as documented in the codex.
	 *
	 * @param  array $section  the section plus the settings for the section
	 * @return void            registers the settings, does not return anything
	 */
	protected function register_section( $section ) {
		// 1. Register the section
		$this->customize->add_section( $section['id'],
			array(
				'title'       => __( $section['title'], 'pwps_text_domain' ),
				'priority'    => $section['priority'],
				'capability'  => $section['capability'],
				'description' => $section['description'],
			)
		);

		foreach ( $section['settings'] as $k => $opt ) {
			// 2. register the setting
			$this->customize->add_setting( 'pwps_customizer_options['.$section['key'].']['.$k.']',
				array(
					'default'     => self::$default_options[$section['key']][$k],
					'type'        => 'option',
					'capability'  => 'edit_theme_options',
					'transport'   => isset( $opt['transport'] ) ? $opt['transport'] : 'refresh',
				)
			);

			// 3. register the control
			if ( isset( $opt['control'] )
				&& 'color' == $opt['control'] ) {
				$this->customize->add_control( new WP_Customize_Color_Control(
					$this->customize,
					$opt['control_id'],
					array(
						'label'       => __( $opt['label'], 'pwps_text_domain' ),
						'section'     => $section['id'],
						'settings'    => 'pwps_customizer_options['.$section['key'].']['.$k.']',
						'description' => isset( $opt['description'] ) ? $opt['description'] : '',
					)
				) );
			}
			else {
				$this->customize->add_control( $opt['control_id'],
					array(
						'type'        => isset( $opt['type'] ) ? $opt['type'] : 'text',
						'label'       => __( $opt['label'], 'pwps_text_domain' ),
						'section'     => $section['id'],
						'settings'    => 'pwps_customizer_options['.$section['key'].']['.$k.']',
						'description' => isset( $opt['description'] ) ? $opt['description'] : '',
					)
				);
			}
		}
	}


	/*
		Options
	 */
	
	protected function set_options() {
		/**
		 * Holds header options
		 *
		 * @var array
		 */
		$this->options['header'] = array(
			'id'          => 'pwps_customizer_header_section',
			'key'         => 'header', // key to save serialized data
			'title'       => 'Simplicity Header',
			'priority'    => 35.1,
			'capability'  => 'edit_theme_options',
			'description' => 'This section controls most of your header settings. Your site\'s logo can be changed from the \'Site Identity\' section.',
			// The options for this section
			'settings'    => array(
				'nav-icon' => array(
					'control_id' => 'pwps_customizer_header_fa_icon',
					'label'      => 'Nav Icon',
					// 'transport' => 'postMessage',
				),
				'background-color' => array(
					'control'    => 'color',
					'control_id' => 'pwps_customizer_header_bg_color',
					'label'      => 'Header Background Color',
				),
				'color' => array(
					'default'     => '#FDFDFD',
					'control'     => 'color',
					'control_id'  => 'pwps_customizer_header_color',
					'label'       => 'Header Color',
					'description' => 'color for h3-6 and p tags.',
				),
				'opacity' => array(
					'control_id' => 'pwps_customizer_header_opacity',
					'label'      => 'Header Opacity',
				),
				'analytics' => array(
					'control_id' => 'pwps_customizer_header_analytics',
					'label'      => 'Google Analytics Tracking ID',
					'description'=> 'Looks something like this UA-12345678-1.<br><a href="https://support.google.com/analytics/answer/1032385?hl=en" target="_blank">find it here.</a>'
				),
			)
		);


		/**
		 * Body options
		 *
		 * @var array
		 */
		$this->options['body'] = array(
			'id'          => 'pwps_customizer_body_section',
			'title'       => 'Simplicity Body',
			'key'         => 'body',
			'priority'    => 35.2,
			'capability'  => 'edit_theme_options',
			'description' => 'This section controls the styles for your site\'s body (main container).',
			// The options for this section
			'settings'    => array(
				'width' => array(
					'control_id' => 'pwps_customizer_body_width',
					'label'      => 'Body Width',
				),
				'max-width' => array(
					'control_id' => 'pwps_customizer_body_max_width',
					'label'      => 'Body Maximum Width',
				),
				'background-color' => array(
					'control'    => 'color',
					'control_id' => 'pwps_customizer_body_bg_color',
					'label'      => 'Body Background Color',
				),
				'color' => array(
					'default'     => '#444444',
					'control'     => 'color',
					'control_id'  => 'pwps_customizer_body_color',
					'label'       => 'Body Color',
					'description' => 'color for h3-6 and p tags.',
				),
				'h1-color' => array(
					'control'    => 'color',
					'control_id' => 'pwps_customizer_h1_color',
					'label'      => 'H1 Color',
				),
				'h2-color' => array(
					'control'    => 'color',
					'control_id' => 'pwps_customizer_h2_color',
					'label'      => 'H2 Color',
				),
				'link-color' => array(
					'control'    => 'color',
					'control_id' => 'pwps_customizer_link_color',
					'label'      => 'Link Color',
				),
				'accent-color' => array(
					'control'    => 'color',
					'control_id' => 'pwps_customizer_accent_color',
					'label'      => 'Accent Color',
					'description'=> 'Used to create subtle contrasts across the theme. Mainly to display meta data in blog posts.',
				),
			),
		);


		/**
		 * Holds footer options
		 *
		 * @var array
		 */
		$this->options['footer'] = array(
			'id'          => 'pwps_customizer_footer_section',
			'key'         => 'footer', // key to save serialized data
			'title'       => 'Simplicity Footer',
			'priority'    => 35.3,
			'capability'  => 'edit_theme_options',
			'description' => 'This section controls your footer settings.',
			// The options for this section
			'settings'    => array(
				'copyright' => array(
					'type' => 'textarea', 
					'control_id' => 'pwps_customizer_footer_copyright',
					'label'      => 'Copyright',
					'description' => 'Insert dynamic content such copyright symbol, date or site name by using %COPY%, %YEAR% or %SITENAME% (respectively).',
				),
			)
		);


		/**
		 * Holds buttons options
		 *
		 * @var array
		 */
		$this->options['buttons'] = array(
			'id'          => 'pwps_customizer_buttons_section',
			'key'         => 'buttons', // key to save serialized data
			'title'       => 'Simplicity Buttons',
			'priority'    => 35.4,
			'capability'  => 'edit_theme_options',
			'description' => 'This section controls your buttons settings.',
			// The options for this section
			'settings'    => array(
				// Primary Buttons
				// ===============
				'primary-bg' => array(
					'control' => 'color', 
					'control_id' => 'pwps_customizer_buttons_primary_bg',
					'label'      => 'Primary Button Background',
				),
				'primary-text' => array(
					'control' => 'color', 
					'control_id' => 'pwps_customizer_buttons_primary_text',
					'label'      => 'Primary Button Text',
				),
				// on hover
				'primary-bg-hover' => array(
					'control' => 'color', 
					'control_id' => 'pwps_customizer_buttons_primary_bg_hover',
					'label'      => 'Primary Button Background On Hover',
				),
				'primary-text-hover' => array(
					'control' => 'color', 
					'control_id' => 'pwps_customizer_buttons_primary_text_hover',
					'label'      => 'Primary Button Text On Hover',
				),
				// Secondary Buttons
				// ===============
				'secondary-bg' => array(
					'control' => 'color', 
					'control_id' => 'pwps_customizer_buttons_secondary_bg',
					'label'      => 'Secondary Button Background',
				),
				'secondary-text' => array(
					'control' => 'color', 
					'control_id' => 'pwps_customizer_buttons_secondary_text',
					'label'      => 'Secondary Button Text',
				),
				// on hover
				'secondary-bg-hover' => array(
					'control' => 'color', 
					'control_id' => 'pwps_customizer_buttons_secondary_bg_hover',
					'label'      => 'Secondary Button Background On Hover',
				),
				'secondary-text-hover' => array(
					'control' => 'color', 
					'control_id' => 'pwps_customizer_buttons_secondary_text_hover',
					'label'      => 'Secondary Button Text On Hover',
				),
				// Waring Buttons
				// ===============
				'warning-bg' => array(
					'control' => 'color', 
					'control_id' => 'pwps_customizer_buttons_warning_bg',
					'label'      => 'Waring Button Background',
				),
				'warning-text' => array(
					'control' => 'color', 
					'control_id' => 'pwps_customizer_buttons_warning_text',
					'label'      => 'Waring Button Text',
				),
				// on hover
				'warning-bg-hover' => array(
					'control' => 'color', 
					'control_id' => 'pwps_customizer_buttons_warning_bg_hover',
					'label'      => 'Waring Button Background On Hover',
				),
				'warning-text-hover' => array(
					'control' => 'color', 
					'control_id' => 'pwps_customizer_buttons_warning_text_hover',
					'label'      => 'Waring Button Text On Hover',
				),
			)
		);	
	}
}
?>