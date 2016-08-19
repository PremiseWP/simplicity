(function($){

	$( document ).ready( function() {

		pwpsSubnavsInit();

		/**
		 * initaite the slide nav for our nav system
		 * 
		 * @return {void} binds the slide menu animation to our mein nav
		 */
		function pwpsSubnavsInit() {
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