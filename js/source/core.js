(function($){
	$( document ).ready( function(){
		// reference our variables for efficiency
		var windowHeight = $( window ).height(),
		header       = $( '#pwps-header' ),
		navToggle    = $( '#pwps-nav-toggle-a' ),
		navSearch    = $( '#pwps-nav-search-input' ),
		navOverlay   = $( '.pwps-nav-overlay' ),
		pwpsContent   = $( '#pwps-content' ),
		loadMorePosts = $( '.pwps-infinte-pagination' ),
		loopContainer = $( '.pwps-the-loop' );

		// initiate our javascript. this function is called at the end of this file.
		function pwpsInitJs() {
			// fix header space
			pwpsHeaderBump();

			if ( ! loopContainer.length ) {
				_conent = pwpsContent.html();
				pwpsContent.html( '<div class="pwps-the-loop">'+_conent+'</div>' );
				loopContainer = $( '.pwps-the-loop' );
			}

			// activate the nav search
			navToggle.click( pwpsInitNav );

			// bind infinite scroll
			pwpsLoadMorePostsAjax();
		}

		// fix spacing between main content and top of page since our header is fixed
		function pwpsHeaderBump() {
			pwpsContent.css( 'margin-top', header.outerHeight() + 'px' );
			$( window ).resize( function(){
				setTimeout( function() {
					pwpsContent.css( 'margin-top', header.outerHeight() + 'px' );
					clearTimeout();
				}, 1000 );
			} );
		}

		var initialPage = ( loopContainer.length ) ? loopContainer[0].innerHTML : '';
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

				setTimeout(function(){
					// if string is at least 1 character long
					if ( 1 <= s.length ) {
							pwpsDoSearch( s );
					}
					else { // clean up loop and place inital content back
						loopContainer.removeClass( 'pwps-nav-results' ).attr( 'data-pwps-nav-search', '' ).html( initialPage );
						navOverlay.removeClass( 'loading' );
					}
					clearTimeout();
				}, 300);

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
				loopContainer.addClass( 'pwps-nav-results' ).attr( 'data-pwps-nav-search', s ).html( resp );
				navOverlay.removeClass( 'loading' );
				// pwpsLoadMorePostsAjax();
			} );

			return false;
		}

		// load posts via ajax for pagination
		function pwpsLoadMorePostsAjax() {
			if ( ! $( '.pwps-infinte-pagination' ).length ) return false;

			var search_paged = 2, loop_paged = 2,

			_load = $( '.pwps-infinte-pagination' ).premiseScroll( {
				onScroll: function() {
					_load.stopScroll(); // prevent this function from running twice

					var $this = $( this ),
					data = {
						action: 'pwps_load_more_posts',
						page: loopContainer.is( '.pwps-nav-results' ) ? search_paged : loop_paged,
					}

					if ( loopContainer.is( '.pwps-nav-results' )
						&& '' !== loopContainer.attr( 'data-pwps-nav-search' ) ) {
						data.s = loopContainer.attr( 'data-pwps-nav-search' );
					}

					$this.addClass( 'pwps-loading' );

					$.post( '/wp-admin/admin-ajax.php', data, function( r ) {
						if ( '' == r ) {
							$this.html( '<p class="premise-align-center">There are no more posts to load.</p>' );
						}
						else {
							loopContainer.append( r );
							$this.removeClass( 'pwps-loading' );
							_load.startScroll(); // allow this function to run again
						}
						loopContainer.is( '.pwps-nav-results' ) ? search_paged++ : loop_paged++;
					} );
					return false;
				},
				offsetIn: -300, // Trigger the ajax call 300px before the bottom of the page is reached. This buys us a little time (better user experience)
			} );
		}

		// run it!
		pwpsInitJs();
	});
}(jQuery));