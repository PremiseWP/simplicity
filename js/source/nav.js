(function($){

	$( document ).ready( function() {

		function pwpsSubnavsInit() {
			
			var parents = $( '.pwps-nav-menu-container li.menu-item-has-children' );


			if ( parents.length ) {


				var container = parents.parents( '.pwps-nav-menu-container' ),

				move = container.width(),

				back = $( '#pwps-nav-back' );

				parents.click( function() {
					$( this ).addClass( 'pwps-active-parent' );
					back.addClass( 'pwps-show' );
					container.addClass( 'pwps-move-nav' );
					

					back.off().click( function() {
						container.removeClass( 'pwps-move-nav' );
						$(this).removeClass( 'pwps-show' );
						setTimeout( function() {
							parents.removeClass( 'pwps-active-parent' );
						}, 400 );
					} );
				} );
			}
		};


		pwpsSubnavsInit();

	} );

}(jQuery));