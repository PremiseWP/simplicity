<?php
/**
 * This class handles the nav search
 *
 * @package Simplicity\Classes
 */


/**
* The nav search class searches the database for posts based on a keyword string
*/
class PWPS_Nav_Search {

	/**
	 * Object instance.
	 *
	 * @see get_instance()
	 *
	 * @var object
	 */
	protected static $instance = null;



	/**
	 * the search string submitted by the user
	 *
	 * @var string
	 */
	public $s = '';


	/**
	 * the query object
	 *
	 * @var null
	 */
	public $query = NULL;


	/**
	 * Construct our object
	 */
	function __construct() {}


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
	 * Perform nav search
	 *
	 * @return string html with search results loop
	 */
	public function pwps_nav_search() {
		$action = ( isset( $_POST['action'] ) && ! empty( $_POST['action'] ) ) ? (string) sanitize_text_field( $_POST['action'] ) : '';
		$search = ( isset( $_POST['search'] ) && ! empty( $_POST['search'] ) ) ? (string) sanitize_text_field( $_POST['search'] ) : '';

		if ( '' !== $action && '' !== $search ) {
			$this->search( $search );
		}
		die();
	}


	/**
	 * Perform the search
	 *
	 * @param  string $search string to search for
	 *
	 * @return void           does not return anything. this function performs the search and calls the loop.
	 */
	public function search( $search ) {
		$this->s = $search;

		$this->query = new WP_Query( array( 's' => $this->s, 'post_status' => 'publish' ) );
		wp_reset_query(); // reset query immediately, we already saved the object reference

		$this->loop();
	}


	/**
	 * Loop through search results
	 *
	 * @return string html for loop results
	 */
	public function loop() {
		if ( $this->query->have_posts() ) {
			$this->load();
		}
	}


	/**
	 * load each result post from results
	 *
	 * @return string html for loop results
	 */
	public function load() {
		?>
		<div <?php post_class( 'nav-results' ); ?>>
			<div class="pwps-container">
				<div class="premise-row">
					<?php while( $this->query->have_posts() ) {
						$this->query->the_post();
						get_template_part( 'content', 'loop' );
					} ?>
				</div>
			</div>
		</div>
		<?php
	}
}

?>