/**
 * This file loads on the customizer page and not in the site itself.
 *
 * The customizer loads the site within an iframe.
 *
 * @wp-hook  customize_controls_print_scripts
 */

( function( $ ) {

	$( document ).ready( function() {
		var DOM = $( this );
		var headerSection = $( '#accordion-section-pwps_customizer_header_section' ),
		headerFaIconField = $( '#customize-control-pwps_customizer_header_fa_icon input' );

		if ( headerFaIconField.length ) {
			headerFaIconField.premiseFieldFaIcon();
		}

		// To ensure our UI binds to the theme customizer live preview, update our input
		DOM.on( 'premiseFieldAfterFaIconsClose', function( e, $array ) {
			console.log( $array.closest( 'input' ) );
			$array.parent( '.premise-field-fa_icon' ).find( 'input' ).change();
			return false;
		} );
	} );
} ( jQuery ) );