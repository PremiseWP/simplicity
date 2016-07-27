(function($){
	$(document).ready(function(){
		// reference our variables for efficiency
		var windowHeight = $(window).height(),
		header       = $( '#pwps-header' ),
		navToggle    = $( '#pwps-nav-toggle-a' ),
		navSearch    = $( '#pwps-nav-search-input' ),
		navOverlay   = $( '.pwps-nav-overlay' ),
		sgrContent   = $( '#pwps-content' );

		// initiate our javascript. this function is called at the end of this file.
		function pwpsInitJs() {
			// fix header space
			pwpsHeaderBump();

			// activate the nav search
			navToggle.click( pwpsInitNav );
		}

		// fix spacing between main content and top of page since our header is fixed
		function pwpsHeaderBump() {
			sgrContent.css( 'margin-top', header.outerHeight() + 'px' );
			$(window).resize( function(){
				setTimeout( function() {
					sgrContent.css( 'margin-top', header.outerHeight() + 'px' );
					clearTimeout();
				}, 1000 );
			} );
		}

		var initialPage = sgrContent[0].innerHTML;
		// initiate nav search UI
		function pwpsInitNav() {
			// continue if reset was successful
			if ( ! pwpsResetNav() ) return false;

			header.addClass( 'pwps-nav-active' );
			navSearch.focus();

			// bind the search field
			navSearch.keyup( function( e ) {

				// if enter key is pressed
				if ( e.keyCode == 13 ) {
					header.removeClass( 'pwps-nav-active' );
					navSearch.blur();
					return false;
				}

				// reference our variables
				var $this = $( this ),
				s = $this.val();

				// if string is at least 1 character long
				if ( 1 <= s.length ) {
					pwpsDoSearch( s );
				}
				else {
					sgrContent.html( initialPage );
					navOverlay.removeClass( 'loading' );
				}
			} );

			// click anywhere to exit
			navOverlay.one( 'click', function() {
				header.removeClass( 'pwps-nav-active' );
				return false;
			} );
		}

		// reset the nav. does not do nothing yet
		function pwpsResetNav() {
			if ( header.is( '.pwps-nav-active' ) ) {
				header.removeClass( 'pwps-nav-active' );
				return false;
			}
			else {
				return true;
			}
		}

		// preform the search and return results
		function pwpsDoSearch( s ) {
			s = s || '';

			// check for s
			if ( '' == s ) return false;

			navOverlay.addClass( 'loading' );

			// construct data object
			var data = {
				action: 'pwps_nav_search', 	// the ajax hook name
				search: s, 					// what the user searched for
			}

			// call the ajax hook and pass data
			$.post( '/wp-admin/admin-ajax.php', data, function( resp ) {
				sgrContent.html( resp );
				navOverlay.removeClass( 'loading' );
			} );

			return false;
		}

		// run it!
		pwpsInitJs();
	});
}(jQuery));