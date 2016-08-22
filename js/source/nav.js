(function($){

	$( document ).ready( function() {

		var body = $( 'body' ),
		header       = $( '#pwps-header' ),
		navToggle    = $( '#pwps-nav-toggle-a' ),
		navSearch    = $( '#pwps-nav-search-input' ),
		navOverlay   = $( '.pwps-nav-wrapper' ),
		pwpsContent   = $( '#pwps-content' ),
		loopContainer = $( '.pwps-the-loop' ),
		sidebarToggle = $( '.pwps-toggle-mobile-sidebar' );

		if ( ! loopContainer.length ) {
			_conent = pwpsContent.html();
			pwpsContent.html( '<div class="pwps-the-loop">'+_conent+'</div>' );
			loopContainer = $( '.pwps-the-loop' );
		}

		// activate the nav search
		navToggle.click( pwpsInitNav );

		// bind the subnav navigation
		pwpsSubnavigation();


		var initialPage = ( loopContainer.length ) ? loopContainer[0].innerHTML : '';
		// initiate nav search UI
		function pwpsInitNav() {
			// continue if reset was successful
			if ( ! pwpsResetNav() ) return false;

			header.addClass( 'pwps-nav-active' );
			body.addClass( 'pwps-nav-active' );
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

			sidebarToggle.click( function() {
				var mobileSidebar = $( '.pwps-mobile-sidebar' );

				if ( mobileSidebar.length ) {
					if ( mobileSidebar.is( '.pwps-show' ) ) {
						mobileSidebar.removeClass( 'pwps-show' );
					}
					else {
						mobileSidebar.addClass( 'pwps-show' );
					}
				}

				return false;
			} );

			// click anywhere to exit
			navOverlay.off().click( function(e) {
				e.stopPropagation();
				if ( $( e.target ).is( '.pwps-nav-wrapper' ) ) {
					console.log( e.target );
					header.removeClass( 'pwps-nav-active' );
					body.removeClass( 'pwps-nav-active' );
				}
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


		/**
		 * initaite the slide nav for our nav system
		 * 
		 * @return {void} binds the slide menu animation to our mein nav
		 */
		function pwpsSubnavigation() {
			var parents = $( '.pwps-nav-menu-container li.menu-item-has-children' );

			if ( parents.length ) {
				// fix propagation when clicking on the anchor of a parent li element
				parents.find( 'a' ).click( function(e){ e.stopPropagation(); } );

				var container = parents.parents( '.pwps-nav-menu-container' ),
				ulWidth          = container.width(),
				back          = $( '#pwps-nav-back' ),
				ul            = container.find( 'ul' ).first();

				parents.click( function( e ) {
					e.stopPropagation();

					// find which level we are on to s=know how much to slide the nav
					var level = $( this ).parents( '.menu-item-has-children' ).length +1;

					// set the active parent menu and keep it until we go back to the top level
					$( this ).addClass( 'pwps-active-parent' );
					
					// slide the menu
					slideNav();

					// bind and show the back button
					back.addClass( 'pwps-show' );
					back.off().click( function() {
						level--; // go back one level
						
						// slide the menu
						slideNav();

						if ( 0 === level ) {
							$( this ).removeClass( 'pwps-show' );
							// wait for animation to end and deactivate all parent menus
							setTimeout( function() {
								parents.removeClass( 'pwps-active-parent' );
							}, 400 );
						}
					} );
					
					// slide the nav left or right
					function slideNav() {
						ul.css( {
							'transform': 'translateX( -'+(ulWidth * level)+'px )',
						} );
					}
				} );
			}


		};

	} );

}(jQuery));