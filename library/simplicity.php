<?php
/**
 * Global function for Simplicity theme. This are the theme tags used in the front end - for the most part.
 *
 * All function afre wrapped around and if() statement to determine if the function already exists. This is
 * to allow child theme developers to fully control the outcome of these function by overwritting them and
 * never having conflicts with theme updates.
 *
 * @package Simplicity\Library
 */


if ( ! function_exists( 'pwps_main_nav' ) ) {
	/**
	 * Output the main navigation
	 *
	 * @return string the html for the main navingation
	 */
	function pwps_main_nav() {
		echo '<a href="javascript:;" id="pwps-nav-back"><i class="fa fa-angle-left"></i></a>
		<div class="pwps-nav-menu-container premise-clear-float">';
			wp_nav_menu(
				array(
					'theme_location'  => 'header-menu', // DO NOT MODIFY.
					'menu'            => '',
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'pwps-nav-menu',
					'menu_id'         => '',
					'echo'            => true,
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul>%3$s</ul>',
					'depth'           => 0,
				)
			);
		echo '</div>';
	}
}


if ( ! function_exists( 'pwps_the_logo' ) ) {
	/**
	 * Output the logo which comes from the custom logo option built into wordpress
	 *
	 * @see https://developer.wordpress.org/reference/functions/the_custom_logo/ for more info on the_custom_logo()
	 *
	 * @return string html for logo including link
	 */
	function pwps_the_logo() {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			?><div class="pwps-logo"><?
				the_custom_logo();
			?></div><?
		}
		elseif ( get_theme_mod( 'header_text' ) ) {
			?><div class="pwps-site-title premise-inline-block">
				<a href="<?php echo esc_url( site_url() ); ?>" class="premise-block ">
					<h1><?php echo esc_attr( bloginfo( 'name' ) ); ?></h1>
					<p><?php echo esc_attr( bloginfo( 'description' ) ); ?></p>
				</a>
			</div><?
		}
	}
}


if ( ! function_exists( 'pwps_pagination' ) ) {
	/**
	 * display the pagination element that triggers the infinite scroll when in view
	 *
	 * @return string html for pagination
	 */
	function pwps_pagination() {
		?>

		<div class="pwps-infinte-pagination premise-clear">
			<i class="fa fa-spin fa-spinner"></i>
			<span>Loading more posts...</span>
		</div>

		<?php
	}
}


if ( ! function_exists( 'pwps_load_custom_css' ) ) {
	/**
	 * loads the custom css into the header of Wordpress
	 *
	 * @return string the custom css set from options in the backend
	 */
	function pwps_load_custom_css() {
		?>
		<style type="text/css">
			<?php
			// echo pwps_get_container_max_width();
			echo pwps_get_header_styles();
			echo pwps_get_body_styles();

			if ( ! is_admin()
				 && $page_styles = premise_get_value( 'pwps_page_options[custom-css]', 'post' ) ) {
					echo (string) $page_styles;
			}
			?>
		</style>
		<?php
	}
}


if ( ! function_exists( 'pwps_get_container_max_width' ) ) {
	/**
	 * returns teh max width for the main container.
	 *
	 * @todo RegExp to remove ; or other characters. need clean up.
	 *
	 * @return string the max width for the main caontainer
	 */
	function pwps_get_container_max_width() {
		$max_width = (string) premise_get_value( 'pwps_theme_options[container-max-width]' );

		$_css = '';

		// set the max-width
		$_css .= ( '' !== $max_width ) ? '.pwps-container{max-width:'.$max_width.';}' : '';

		return esc_attr( (string) $_css );
	}
}


if( ! function_exists( 'pwps_get_header_styles' ) ) {
	/**
	 * Return the css for the header container.
	 *
	 * @return string css for header container
	 */
	function pwps_get_header_styles() {
		/**
		 * holds associative array with header styles already cleaned up.
		 *
		 * Returns the following values:
		 * - opacity          => '' (string)
		 * - background-color => '' (string)
		 * - color            => '' (string)
		 *
		 * @see pwps_escape_string this function returns "safe to use" values.
		 *
		 * @var array
		 */
		$header = array_map('pwps_escape_string', (array) premise_get_value( 'pwps_customizer_options[header]' ) );

		// if there is no css, set the default css
		$hbgc = ( isset( $header['background-color'] )  && ! empty( $header['background-color'] ) ) ? $header['background-color'] : '#2b7ae7';
		$hop  = ( isset( $header['opacity'] )           && ! empty( $header['opacity'] ) )          ? $header['opacity']          : '1';
		$hcol = ( isset( $header['color'] )             && ! empty( $header['color'] ) )            ? $header['color']            : '#FDFDFD';

		$_css = ''; // start with an empty string

		// set the header background and opacity
		$_css .= '#pwps-header .pwps-header-overlay {
			background-color: '.$hbgc.';
			opacity: '.$hop.';
		}
		.woocommerce button.button.alt {
			background-color: '.$hbgc.';
		}';
		// TO DO - add button or accent colors to theme options

		// set the nav icon color
		$_css .= '#pwps-nav-toggle-a {
			color:'.$hcol.';
		}';

		return esc_attr( (string) $_css );
	}
}


if ( ! function_exists( 'pwps_google_analytics_script' ) ) {
	/**
	 * output the google analytics script if a tracking ID has been provided
	 *
	 * @return string the script needed for google analytics to work.
	 */
	function pwps_google_analytics_script() {
		$ga_tracking_id = (string) esc_attr( premise_get_value( 'pwps_customizer_options[header][analytics]' ) );
		$script = "<!-- Simplicity Google Analytics Tracking Code -->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', '{$ga_tracking_id}', 'auto');
		  ga('send', 'pageview');

		</script>";
		echo ( '' !== $ga_tracking_id ) ? $script : '';
	}
}


if( ! function_exists( 'pwps_get_body_styles' ) ) {
	/**
	 * Return the css for the body container.
	 *
	 * @return string css for body container
	 */
	function pwps_get_body_styles() {
		/**
		 * holds associative array with body styles already cleaned up.
		 *
		 * Returns the following values:
		 * - opacity          => '' (string)
		 * - background-color => '' (string)
		 * - color            => '' (string)
		 *
		 * @see pwps_escape_string this function returns "safe to use" values.
		 *
		 * @var array
		 */
		$body = array_map('pwps_escape_string', (array) premise_get_value( 'pwps_customizer_options[body]' ) );

		// if there is no css, set the default css
		$width     = ( isset( $body['width'] )            && ! empty( $body['width'] ) )            ? $body['width']            : '90%';
		$max_width = ( isset( $body['max-width'] )        && ! empty( $body['max-width'] ) )        ? $body['max-width']        : '1200px';

		$bbgc  = ( isset( $body['background-color'] ) && ! empty( $body['background-color'] ) ) ? $body['background-color'] : '#FFFFFF';
		$bcol  = ( isset( $body['color'] )            && ! empty( $body['color'] ) )            ? $body['color']            : '#444444';

		$h1col = ( isset( $body['h1-color'] )         && ! empty( $body['h1-color'] ) )         ? $body['h1-color']         : '#222222';
		$h2col = ( isset( $body['h2-color'] )         && ! empty( $body['h2-color'] ) )         ? $body['h2-color']         : '#222222';

		$linkcol = ( isset( $body['link-color'] )         && ! empty( $body['link-color'] ) )         ? $body['link-color']         : '#000000';

		$accentcol = ( isset( $body['accent-color'] ) && ! empty( $body['accent-color'] ) )         ? $body['accent-color']         : '#2b7ae7';

		$_css = ''; // start with an empty string

		// set the body background and opacity
		$_css .= '.pwps-site-body {
			background-color: '.$bbgc.';
			color: '.$bcol.';
		}';

		$_css .= 'h1 {
			color: '.$h1col.';
		}';

		$_css .= 'h2 {
			color: '.$h2col.';
		}';

		$_css .= 'a {
			color: '.$linkcol.';
		}';

		// accent color styles
		$_css .= '.pwps-meta-item:before {
			background-color: '.$accentcol.';
		}';

		$_css .= '.pwps-container {
			width: '.$width.';
			max-width: '.$max_width.';
		}';

		$_css .= get_button_styles();

		return esc_attr( (string) $_css );
	}
}


if ( ! function_exists( 'get_button_styles' ) ) {
	/**
	 * returns the buttons styles. the css to apply to the header to style the buttons dynamically
	 *
	 * @param  array  $keys key for each button
	 * @return sting        the css to apply styles
	 */
	function get_button_styles( $keys = array( 'primary', 'secondary', 'warning' ) ) {
		$buttons = array_map('pwps_escape_string', (array) premise_get_value( 'pwps_customizer_options[buttons]' ) );

		$_css = '';
		if ( $buttons ) {

			foreach ( $keys as $btn ) {

				$bg = ( isset( $buttons[$btn.'-bg'] ) ) ? $buttons[$btn.'-bg'] : '';
				$text = ( isset( $buttons[$btn.'-text'] ) ) ? $buttons[$btn.'-text'] : '';
				$bg_hover = ( isset( $buttons[$btn.'-bg-hover'] ) ) ? $buttons[$btn.'-bg-hover'] : '';
				$text_hover = ( isset( $buttons[$btn.'-text-hover'] ) ) ? $buttons[$btn.'-text-hover'] : '';

				$_css .= '.pwps-btn-'.$btn.' {
					background-color: '.$bg.';
					color: '.$text.';
				}
				.pwps-btn-'.$btn.':hover {
					background-color: '.$bg_hover.';
					color: '.$text_hover.';
				}';
			}
		}
		return $_css;
	}
}


if ( ! function_exists( 'pwps_escape_string' ) ) {
	/**
	 * Cleans up a string to make it safe to use. Validation for the correct value or type of value should be done when safed in the database.
	 *
	 * It encodes the <, >, &, ” and ‘ (less than, greater than, ampersand, double quote and single quote) characters.
	 * Then returns the string escaped for HTML output.
	 *
	 * @link https://developer.wordpress.org/reference/functions/esc_html/ esc_html() documentation
	 * @link https://developer.wordpress.org/reference/functions/esc_attr/ esc_attr() documentation
	 *
	 * @param  string $string string to clean up
	 * @return string         string already cleaned up
	 */
	function pwps_escape_string( $string ) {
		return ( '' !== $string ) ? esc_html( esc_attr( trim( (string) $string ) ) ) : '';
	}
}


if ( ! function_exists( 'pwps_get_nav_icon' ) ) {
	/**
	 * gets the fa icon to use for the nav
	 *
	 * @todo add validation
	 *
	 * @return string fa icon code to use
	 */
	function pwps_get_nav_icon() {
		return esc_attr( (string) premise_get_value( 'pwps_customizer_options[header][nav-icon]' ) );
	}
}


if ( ! function_exists( 'pwps_load_more_posts' ) ) {
	/**
	 * load more posts via ajax for infinte croll
	 *
	 * @wp-hook wp_ajax_pwps_load_more_posts
	 * @wp-hook wp_ajax_nopriv_pwps_load_more_posts
	 *
	 * @todo validate page
	 *
	 * @return  string html for pots
	 */
	function pwps_load_more_posts() {
		$data = array_map( 'sanitize_text_field', $_POST );

		// start our arguments for the query with published posts only
		$args = array(
			'post_status' => 'publish',
		);

		if ( isset( $data['page'] ) && ! empty( $data['page'] ) ) {
			$args['paged'] = $data['page'];
		}
		else {
			die( 'There is no pagination. Please refresh this page to see if that fixes the issue.' );
		}

		if ( isset( $data['s'] ) && ! empty( $data['s'] ) ) {
			$args['s'] = $data['s'];
		}

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while( $query->have_posts() ) {
				$query->the_post();
				get_template_part( 'content', 'loop' );
			}
		}
		else {
			die( '' ); // return empty string when no more posts were found
		}

		die(); // always dies at the end for ajax calls
	}
}


if ( ! function_exists( 'pwps_customizer_control_styles' ) ) {
	/**
	 * Enqueue our CSS file for the theme customizer controls
	 *
	 * @return void enqueues the css file to be loaded on the customizer page
	 */
	function pwps_customizer_control_styles() {
		wp_enqueue_style(
			'simplicity-customizer-css',			//Give the script an ID
			get_template_directory_uri().'/css/theme-customizer.css'
		);
	}
}


if ( ! function_exists( 'pwps_enqueue_customizer_js' ) ) {
	/**
	 * Enqueue our JS file for the theme customizer controls
	 *
	 * @return void enqueues the js file to be loaded on the customizer page
	 */
	function pwps_enqueue_customizer_js() {
		wp_enqueue_script(
			'simplicity-customizer-js',			//Give the script an ID
			get_template_directory_uri().'/js/theme-customizer.js',//Point to file
			array( 'jquery' ),	//Define dependencies
			'',						//Define a version (optional)
			true						//Put script in footer?
		);
	}
}


if ( ! function_exists( 'pwps_print_customizer_js' ) ) {
	/**
	 * print our JS file for the theme customizer controls
	 *
	 * @return void prints the js file to be loaded on the customizer page
	 */
	function pwps_print_customizer_js() {
		wp_enqueue_script(
			'simplicity-customizerpprint-js',			//Give the script an ID
			get_template_directory_uri().'/js/theme-customizer-print-scripts.js',//Point to file
			array( 'jquery' ),	//Define dependencies
			'',						//Define a version (optional)
			true						//Put script in footer?
		);
	}
}


if ( ! function_exists( 'pwps_the_post_meta' ) ) {
	/**
	 * display the post meta
	 *
	 * @return string the html for the post meta
	 */
	function pwps_the_post_meta() {
		if ( 'page' !== get_post_type() ) : ?>
			<div class="pwps-post-meta">
				<div class="pwps-meta-item pwps-date-meta">
					<span>Date: <?php echo esc_html( get_post_time( 'j/n/y', true ) ); ?></span>
				</div>
				<div class="pwps-meta-item pwps-author-meta">
					<span>By: <?php the_author(); ?></span>
				</div>
				<?php if ( $pwps_format = get_post_format() ) : ?>
					<div class="pwps-meta-item pwps-format-meta">
						<span class="pwps-meta-other"><?php echo esc_html( $pwps_format ); ?></span>
					</div>
				<?php endif; ?>
				<?php if ( '' !== $pwpws_categories = get_the_category_list( ', ' ) ) : ?>
					<div class="pwps-meta-item pwps-categories-meta">
						<?php echo 'Found in: ' . $pwpws_categories; ?>
					</div>
				<?php endif; ?>
				<?php if ( function_exists( 'sharing_display' ) ) : ?>
					<div class="pwps-meta-item pwps-social-meta">
						<?php echo sharing_display(); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif;
	}
}


if ( ! function_exists( 'pwps_get_copyright_text' ) ) {
	/**
	 * Get the footer copyright and set dynamic content. Accepts html.
	 *
	 * @return string the copyright text
	 */
	function pwps_get_copyright_text() {
		// dynamic content
		$pattern = array( '%COPY%', '%YEAR%', '%SITENAME%' );
		$replace = array( '&copy;', date( 'Y' ), esc_html( get_option( 'blogname' ) ) );
		$ct = (string) premise_get_value( 'pwps_customizer_options[footer][copyright]' );

		return (string) str_replace( $pattern, $replace, $ct );

	}
}


if ( ! function_exists( 'pwps_gallery_css' ) ) {
	/**
	 * Filter the gallery default css to return an empty string so that we can take over
	 *
	 * @return string empty string
	 */
	function pwps_gallery_css( $attr ) {
	        return '';
	}
}


if ( ! function_exists( 'pwps_insert_page_links' ) ) {
	/**
	 * insert the post page links after the content.
	 *
	 * The page links are links that appear at the bottom of the post content if the user
	 * inserts a <!--nextpage-->. This is useful if your content is too long and you want
	 * to load it in separate pages.
	 *
	 * @param  string $content the original content
	 * @return string          the filtered content
	 */
	function pwps_insert_page_links( $content ) {
		return $content . pwps_get_page_links();
	}
}


if ( ! function_exists( 'pwps_get_page_links' ) ) {
	/**
	 * get the html for the page links.
	 *
	 * @see    pwps_insert_page_links() uses this function to append the page links to the content
	 *
	 * @return string                   the page links html
	 */
	function pwps_get_page_links() {
		$args = array(
			'before'           => '<p class="pwps-link-pages-ajax">' . __( 'Pages:' ),
			'after'            => '</p>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'separator'        => ' ',
			'nextpagelink'     => __( 'Next page' ),
			'previouspagelink' => __( 'Previous page' ),
			'pagelink'         => '%',
			'echo'             => 0,
		);

	    return (string) wp_link_pages( $args );
	}
}


if ( ! function_exists( 'pwps_get_post_format' ) ) {
	/**
	 * return the past format or type to use when retrieveng the content template
	 *
	 * @return string the post format to use or empty string
	 */
	function pwps_get_post_format() {
		if ( get_post_format() ) {
			return get_post_format();
		}
		return get_post_type();
	}
}


if ( ! function_exists( 'pwps_the_sidebar' ) ) {
	/**
	 * echo the sidebar for simplicity if active
	 *
	 * @return string html for sidebar
	 */
	function pwps_the_sidebar() {
		if ( pwps_uses_sidebar() ) { ?>
			<div class="pwps-main-sidebar span4 premise-hide-on-mobile">
				<ul class="pwps-sidebar">
					<?php dynamic_sidebar( 'pwps-sidebar' ); ?>
				</ul>
			</div><?php
		}
	}
}


if ( ! function_exists( 'pwps_uses_sidebar' ) ) {
	/**
	 * check whether a sidebar should be displayed
	 *
	 * @return boolean true if a sidebar should be displayed. false otherwise
	 */
	function pwps_uses_sidebar( $sidebar = 'pwps-sidebar', $only_single = true ) {
		// check for the sidebar
		$pwps_has_sidebar = ( function_exists( 'is_active_sidebar' ) && is_active_sidebar( $sidebar ) ) ? true : false;

		if ( $only_single && ( is_page() && ! is_home() ) )
			return false;

		return $pwps_has_sidebar ? true : false;
	}
}


if ( ! function_exists( 'pwps_the_section_class' ) ) {
	/**
	 * output the classes for each section
	 *
	 * @param  string $newclass enter new classes. feature not ready yet
	 * @return strinf           classes attribute
	 */
	function pwps_the_section_class( $newclass = '' ) {
		echo pwps_uses_sidebar() ? ' class="premise-row"' : '';
	}
}


if ( ! function_exists( 'pwps_output_footer_scripts' ) ){

	function pwps_output_footer_scripts() {
		if ( is_singular() ) {
			global $post;
			$output = '';
			$options = premise_get_value( 'pwps_page_options', array( 'context' => 'post', 'id' => $post->id ) );

			$js = isset( $options['custom-js'] ) && ! empty( $options['custom-js'] ) ? $options['custom-js'] : '';
			$css = isset( $options['custom-css'] ) && ! empty( $options['custom-css'] ) ? $options['custom-css'] : '';

			if ( '' !== $js ) {
				$output .= '<script type="text/javascript" id="simplicity-custom-scripts">'.$js.'</script>';
			}

			if ( '' !== $css ) {
				$output .= '<style type="text/css" id="simplicity-custom-styles">'.$css.'</style>';
			}

			if ( ! empty( $output ) )
				echo $output;
		}
		return false;
	}
}


if ( ! function_exists( 'pwps_the_loop_class' ) ) {
	/**
	 * output the classes needed for the loop container to work depending on sidebar or not
	 *
	 * @param  string $classes string of classes to apend to element
	 * @return string          the classes for the element.
	 */
	function pwps_the_loop_class( $classes = '' ) {
		$sidebar = pwps_uses_sidebar() ? ' span8' : '';
		$_classes = ( '' !== (string) $classes ) ? ' ' . esc_attr( $classes ) : '';
		echo 'class="pwps-the-loop' . $sidebar . $_classes . '"';
	}
}