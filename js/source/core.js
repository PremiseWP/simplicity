(function($){
	$( document ).ready( function(){
		// reference our variables for efficiency
		var header    = $( '#pwps-header' ),
		pwpsContent   = $( '#pwps-content' ),
		loopContainer = $( '.pwps-the-loop' );

		// initiate our javascript. this function is called at the end of this file.
		function pwpsInitJs() {
			// fix header space
			pwpsHeaderBump();

			// posts link pages ajax
			var pwpsLinkPages = $( '.pwps-link-pages-ajax a' );
			pwpsLinkPages.click( function( e ) {
				e.preventDefault();

				$( this ).parents( '.pwps-link-pages-ajax' ).addClass( 'pwps-loading' );

				var href = $( this ).attr( 'href' ),
				pCont = loopContainer.find( '.pwps-post-content' );

				pCont.css( 'min-height', pCont.height() );

				$.ajax( {
					url: href,
					type: 'post',
					success: function( r ) {
						var content = $(r).find( '.pwps-post .pwps-post-content' );
						pCont.html( content );
						closePagination();
						return false;
					},
					error: function( r ) {
						pCont.append( '<p>Something went wrong, please refresh and try again.</p>' );
						closePagination();
						return false;
					}
				});
				return false;

				function closePagination() {
					$( this ).parents( '.pwps-link-pages-ajax' ).removeClass( 'pwps-loading' );
					pCont.css( 'min-height', '' );
				}
			} );
		}

		// fix spacing between main content and top of page since our header is fixed
		function pwpsHeaderBump() {
			var _height = ( $('body').is( '.page' ) && $('.pwps-page-thumbnail').length  ) ? '0px' : header.outerHeight() + 'px';
			pwpsContent.css( 'margin-top', _height );
			$( window ).resize( function(){
				setTimeout( function() {
					pwpsContent.css( 'margin-top', _height );
					clearTimeout();
				}, 1000 );
			} );
		}

		// run it!
		pwpsInitJs();
	});
}(jQuery));