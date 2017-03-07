(function($){
	$( document ).ready( function(){
		// run it!
		pwpsInitJs();
	});

	// the theme JS
	function pwpsInitJs() {
		// reference our variables for efficiency
		var header    = $( '#pwps-header' ),
		pwpsContent   = $( '#pwps-content' ),
		loopContainer = $( '.pwps-the-loop' ),
		loopRelated   = $( '#pwps-loop-related' ),
		pwpsLinkPages = $( '.pwps-link-pages-ajax a' );

		// fix header space first
		pwpsHeaderBump();

		// bind events if elements exist in DOM
		pwpsLinkPages.length && bindNextPrevPage();
		// if loop related exists adjust the heights of posts
		loopRelated.length && premiseSameHeight( '.pwps-loop-related .pwps-related-post' );

		// load the next page for a post
		function bindNextPrevPage() {
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
		};

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
		};
	}
}(jQuery));