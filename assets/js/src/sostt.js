/**
 * Scripts.
 *
 * @package sostt
 */

var sostt = Object.create( null );

;( function( $, window, document, undefined ) {

	'use strict';

	sostt.document = $( document );
	sostt.window = $( window );
	sostt.window_height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
	sostt.window_width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

	/**
	 * Init.
	 */
	sostt.init = function() {};

	/**
	 * On document ready.
	 */
	sostt.document.ready( function() {
		sostt.init();
	} );

} )( jQuery, window, document );
