<?php
/**
 * Functions Library
 *
 * Theme Prefix: 'pwps_'
 *
 * @package Simplicity
 */


//  Hide the admin bar in the front end
show_admin_bar( false );


// Require Premise WP if it does not exist.
if ( ! class_exists( 'Premise_WP' ) ) {
	require 'includes/require-premise-wp.php';
}


// setup theme
if ( ! function_exists( 'pwps_theme_setup' ) ) {
	/**
	 * Setup the theme once it is activated.
	 *
	 * This function runs only once when you activate the theme. It performs tasks that should NOT be ran on every page load such as flushing rewrite rules.
	 *
	 * @return void
	 */
	function pwps_theme_setup() {
		// flush rewrite rules
		flush_rewrite_rules();
	}
}

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


// Enqueue styles and scripts
if ( ! function_exists( 'pwps_enqueue_scripts' ) ) {
	/**
	 * Enqueue theme scripts in the front end
	 *
	 * @return void
	 */
	function pwps_enqueue_scripts() {
		wp_register_style( 'pwps_css', get_template_directory_uri() . '/css/style.min.css' );
		wp_register_script( 'pwps_js', get_template_directory_uri() . '/js/script.min.js', array( 'jquery' ) );

		if ( ! is_admin() ) {
			wp_enqueue_style( 'pwps_css' );
			wp_enqueue_script( 'pwps_js' );
		}
	}
}


// output the main nav
if ( ! function_exists( 'pwps_main_nav' ) ) {
	/**
	 * Main navigation
	 *
	 * @return void
	 */
	function pwps_main_nav() {

		wp_nav_menu(
			array(
				'theme_location'  => 'header-menu', // DO NOT MODIFY.
				'menu'            => '',
				'container'       => 'div',
				'container_class' => 'pwps-nav-menu-container',
				'container_id'    => '',
				'menu_class'      => 'pwps-nav-menu',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => '',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul>%3$s</ul>',
				'depth'           => 0,
			)
		);
	}
}


if ( ! function_exists( 'pwps_the_logo' ) ) {
	function pwps_the_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
}


// Register menu locations
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


if ( ! function_exists( 'pwps_pagination' ) ) {
	/**
	 * display the pagination for the site
	 *
	 * @return string html for pagination
	 */
	function pwps_pagination() {
		global $wp_query;

		$big = 999999999; // need an unlikely integer

		$args = array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'mid_size' => 0,
			'prev_text' => '<i class="fa fa-chevron-left"></i>',
			'next_text' => '<i class="fa fa-chevron-right"></i>',
		);

		$html  = '<div class="pwps-pagination">';
		$html .= paginate_links( $args );
		$html .= '</div>';

		echo (string) $html;
	}
}



if ( ! function_exists( 'pwps_theme_options_page' ) ) {
	function pwps_theme_options_page() {
		if ( class_exists( 'Premise_Options' ) ) {
			new Premise_Options( array(
				'title' => 'Simplicity Theme Options',
				'menu_title' => 'Simplicity Theme',
				'callback' => 'pwps_render_render_options_page',
			), '', 'pwps_theme_options', 'pwps_theme_options_group' );
		}
	}
}




if ( ! file_exists( 'pwps_render_render_options_page' ) ) {
	function pwps_render_render_options_page() {
		echo 'hello';
	}
}






/**
 * register and load the video meta box for posts
 *
 * @return void
 */
function pwps_load_video_mb_class() {
	new SGR_Video_MB;
}


/**
 * return the video ID if a youtube url is passed
 *
 * @param  string $video the url string or video id
 * @return string        the video id
 */
function pwps_get_video_id( $video = '' ) {
	if ( '' == $video ) return false;

	// http://stackoverflow.com/questions/5830387/how-to-find-all-youtube-video-ids-in-a-string-using-a-regex
	$video_id = preg_replace( '~(?#!js YouTubeId Rev:20160125_1800)
		# Match non-linked youtube URL in the wild. (Rev:20130823)
		https?://          # Required scheme. Either http or https.
		(?:[0-9A-Z-]+\.)?  # Optional subdomain.
		(?:                # Group host alternatives.
		  youtu\.be/       # Either youtu.be,
		| youtube          # or youtube.com or
		  (?:-nocookie)?   # youtube-nocookie.com
		  \.com            # followed by
		  \S*?             # Allow anything up to VIDEO_ID,
		  [^\w\s-]         # but char before ID is non-ID char.
		)                  # End host alternatives.
		([\w-]{11})        # $1: VIDEO_ID is exactly 11 chars.
		(?=[^\w-]|$)       # Assert next char is non-ID or EOS.
		(?!                # Assert URL is not pre-linked.
		  [?=&+%\w.-]*     # Allow URL (query) remainder.
		  (?:              # Group pre-linked alternatives.
		    [\'"][^<>]*>   # Either inside a start tag,
		  | </a>           # or inside <a> element text contents.
		  )                # End recognized pre-linked alts.
		)                  # End negative lookahead assertion.
		[?=&+%\w.-]*       # Consume any URL (query) remainder.
		~ix', '$1',
		$video );

	return $video_id;
}



/**
 * Perform nav search
 *
 * @return string html with search results loop
 */
function pwps_nav_search() {
	$action = ( isset( $_POST['action'] ) && ! empty( $_POST['action'] ) ) ? (string) sanitize_text_field( $_POST['action'] ) : '';
	$search = ( isset( $_POST['search'] ) && ! empty( $_POST['search'] ) ) ? (string) sanitize_text_field( $_POST['search'] ) : '';

	if ( '' !== $action && '' !== $search ) {
		new SGR_Nav_Search( $search );
	}
	die();
}


/**
* The nav search class searches the database for posts based on a keyword string
*/
class SGR_Nav_Search {

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
	function __construct( $search ) {
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



/*
	Includes
 */
include 'classes/class-video-meta-box.php';


/*
	Hooks
 */
if ( function_exists( 'add_action' ) ) {
	// On theme activation.
	add_action( 'after_theme_setup', 'pwps_theme_setup' );

	// Register menus
	add_action( 'init', 'pwps_register_menu' );

	// add the theme options page
	add_action( 'init', array( PWPS_Theme_Options::get_instance(), 'init' ) );

	// Enqueue scripts.
	add_action( 'wp_enqueue_scripts', 'pwps_enqueue_scripts' );

	if ( is_admin() ) {
		add_action( 'load-post.php',     'pwps_load_video_mb_class' );
	    add_action( 'load-post-new.php', 'pwps_load_video_mb_class' );
	}

	add_action( 'wp_ajax_pwps_nav_search', 'pwps_nav_search' );
	add_action( 'wp_ajax_nopriv_pwps_nav_search', 'pwps_nav_search' );
}


/*
	Filters
 */
if ( function_exists( 'add_filter' ) ) {

}


