(function($){
	$( document ).ready( function(){
		// reference our variables for efficiency
		var header    = $( '#pwps-header' ),
		navToggle     = $( '#pwps-nav-toggle-a' ),
		navSearch     = $( '#pwps-nav-search-input' ),
		navOverlay    = $( '.pwps-nav-overlay' ),
		pwpsContent   = $( '#pwps-content' ),
		loopContainer = $( '.pwps-the-loop' );

		// initiate our javascript. this function is called at the end of this file.
		function pwpsInitJs() {
			// fix header space
			pwpsHeaderBump();

			// bind infinite scroll
			pwpsLoadMorePostsAjax();

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
			pwpsContent.css( 'margin-top', header.outerHeight() + 'px' );
			$( window ).resize( function(){
				setTimeout( function() {
					pwpsContent.css( 'margin-top', header.outerHeight() + 'px' );
					clearTimeout();
				}, 1000 );
			} );
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