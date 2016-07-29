/**
 *
 */
(function($){

	$( document ).ready( function() {

		var headerSection = $( '#accordion-section-pwps_customizer_header_section' ),
		headerFaIconField = $( '#customize-control-pwps_customizer_header_fa_icon input' );

		if ( headerFaIconField.length ) {
			headerFaIconField.premiseFieldFaIcon();
		}

	} );

}(jQuery));