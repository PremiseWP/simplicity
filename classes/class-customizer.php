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


	/**
	 * Holds header options
	 *
	 * @var array
	 */
	public $header_options = array(
		'id'          => 'pwps_customizer_header_section',
		'key'         => 'header', // key to save serialized data
		'title'       => 'Simplicity Header',
		'priority'    => 35.1,
		'capability'  => 'edit_theme_options',
		'description' => 'This section controls most of your header settings. Your site\'s logo can be changed from the \'Site Identity\' section.',
		// The options for this section
		'settings'    => array(
			'nav-icon' => array(
				'default'    => 'fa-search',
				'control_id' => 'pwps_customizer_header_fa_icon',
				'label'      => 'Nav Icon',
			),
			'background-color' => array(
				'default'    => '#FDFDFD',
				'control'    => 'color',
				'control_id' => 'pwps_customizer_header_bg_color',
				'label'      => 'Header Background Color',
			),
			'color' => array(
				'default'     => '#444444',
				'control'     => 'color',
				'control_id'  => 'pwps_customizer_header_color',
				'label'       => 'Header Color',
				'description' => 'color for h3-6 and p tags.',
			),
			'opacity' => array(
				'default'    => '0.6',
				'control_id' => 'pwps_customizer_header_opacity',
				'label'      => 'Header Opacity',
			),
		)
	);


	/**
	 * Body options
	 *
	 * @var array
	 */
	public $body_options = array(
		'id'          => 'pwps_customizer_body_section',
		'title'       => 'Simplicity Body',
		'key'         => 'body',
		'priority'    => 35.2,
		'capability'  => 'edit_theme_options',
		'description' => 'This section controls the styles for your site\'s body (main container).',
		// The options for this section
		'settings'    => array(
			'max-width' => array(
				'default'    => '1200px',
				'control_id' => 'pwps_customizer_max_width__color',
				'label'      => 'Body Maximum Width',
			),
			'background-color' => array(
				'default'    => '#FDFDFD',
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
				'default'    => '#222222',
				'control'    => 'color',
				'control_id' => 'pwps_customizer_h1_color',
				'label'      => 'H1 Color',
			),
			'h2-color' => array(
				'default'    => '#222222',
				'control'    => 'color',
				'control_id' => 'pwps_customizer_h2_color',
				'label'      => 'H2 Color',
			),
		),
	);


	/**
	 * Holds footer options
	 *
	 * @var array
	 */
	public $footer_options = array(
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
				'default'    => '%COPY% %YEAR% %SITENAME%. All Rights Reserved.',
				'control_id' => 'pwps_customizer_footer_copyright',
				'label'      => 'Copyright',
				'description' => 'Insert dynamic content such copyright symbol, date or site name by using %COPY%, %YEAR% or %SITENAME% (respectively).',
			),
		)
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
		// save the wp_cusomize object for later use
		$this->customize = $wp_customize;

		// register the header section
		$this->header_section();

		// register the body section
		$this->body_section();

		// register the footer section
		$this->footer_section();
	}


	/**
	 * regiseter the header settings
	 *
	 * @return void register the settings
	 */
	public function header_section() {
		$this->register_section( $this->header_options );
	}


	/**
	 * regiseter the body settings
	 *
	 * @return void register the settings
	 */
	public function body_section() {
		$this->register_section( $this->body_options );
	}


	/**
	 * regiseter the footer settings
	 *
	 * @return void register the settings
	 */
	public function footer_section() {
		$this->register_section( $this->footer_options );
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
					'default'     => $opt['default'],
					'type'        => 'option',
					'capability'  => 'edit_theme_options',
					'transport'   => 'refresh',
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
}

?>
