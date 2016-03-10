/**
 * Contains handlers for navigation and accessibility
 */
( function( $ ) {
	var body    = $( 'body' ),
		_window = $( window );

	// Enable menu toggle for small screens.
	( function() {
		var nav = $( '#primary-navigation' ), button, menu;
		if ( ! nav ) {
			return;
		}

		button = nav.find( '.menu-toggle' );
		if ( ! button ) {
			return;
		}

		$( '.menu-toggle' ).on( 'click.trichotomy', function() {
			nav.toggleClass( 'toggled-on' );
		} );
	} )();

	/* Makes "skip to content" link work correctly for better accessibility.*/
	_window.on( 'hashchange.trichotomy', function() {
		var element = document.getElementById( location.hash.substring( 1 ) );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {
				element.tabIndex = -1;
			}

		element.focus();
		}
	} );
} )( jQuery );