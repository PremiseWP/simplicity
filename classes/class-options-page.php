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

?>