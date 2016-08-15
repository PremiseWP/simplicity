( function( $ ) {
	var DOM = $( document );

	DOM.ready( function() {
		var headerSection = $( '#accordion-section-pwps_customizer_header_section' ),
		headerFaIconField = $( '#customize-control-pwps_customizer_header_fa_icon input' );

		if ( headerFaIconField.length ) {
			headerFaIconField.premiseFieldFaIcon();
		}

		$(this).on( 'premiseFieldAfterFaIconsClose', function( e, $array ) {
			console.log( $array.closest( 'input' ) );
			$array.parent( '.premise-field-fa_icon' ).find( 'input' ).change();
			return false;
		})
	} );
} ( jQuery ) );