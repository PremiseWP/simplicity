(function($){

	$(document).ready(pwpsNavigation);

	function pwpsNavigation() {
		var body = $( 'body' ),
		header       = $( '#pwps-header' ),
		navToggle    = $( '#pwps-nav-toggle-a' ),
		navOverlay   = $( '.pwps-nav-wrapper' ),
		sidebarToggle = $( '.pwps-toggle-mobile-sidebar' )
		parents = $( '.pwps-nav-menu .menu-item-has-children' );

		// bind our nav toggle button
		if ( navToggle.length ) {
			navToggle.click(function(){
				console.log('hello');
				( body.is( '.pwps-nav-active' ) ) ? closeNav() : openNav();
			});
		}

		if ( parents.length ) {
			bindSubNav();
		}

		// open the nav
		function openNav() {
			body.addClass( 'pwps-nav-active' );

			// bind mobile sidebar toggle
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
					closeNav();
				}
			} );
		};

		// close the nav
		function closeNav() {
			body.removeClass( 'pwps-nav-active' );
		};

		function bindSubNav() {
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
	}

}(jQuery));