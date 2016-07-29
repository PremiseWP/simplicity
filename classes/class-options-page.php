<?php
/**
* Adds the video url metabox
*
* @since 1.0.0 we added this class to this version as it may hold some options in the future. currenlty does nothing
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
	 * Leave empty and public
	 *
	 * @see 	init() does the rest once our custom post type has been registered
	 * @since 	1.0
	 */
	public function __construct() {}



	/**
	 * Access this class working instance
	 *
	 * @since   1.0
	 * @return  object instance of this class
	 */
	public static function get_instance() {
		null === self::$instance and self::$instance = new self;

		return self::$instance;
	}



	/**
	 * Register the custom post type
	 *
	 * @since   1.0
	 */
	public function init() {
		if ( class_exists( 'Premise_Options' ) ) {
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
	}



	/**
	 * Display the options page
	 *
	 * @param string html for options page
	 */
	public function options_page() {
		premise_field_section( array(
			array(
				'type' => 'text',
				'name' => 'pwps_theme_options',
			),

			array(
				'type' => 'submit',
			)
		) );
	}
}

?>