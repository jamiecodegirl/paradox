/**
 * Paradox entry point.
 */

var paradox = ( function( $ ) {
	'use strict';

	/**
	 * Adjust site inner margin top to compensate for sticky header height.
	 */
	var moveContentBelowFixedHeader = function() {
		var siteInnerMarginTop = 0;

		if( $('.site-header').css('position') === 'fixed' ) {
			siteInnerMarginTop = $('.site-header').outerHeight();
		}

		$('.site-inner').css('margin-top', siteInnerMarginTop);
	},

	/**
	 * Initialize Paradox.
	 *
	 * Internal functions to execute on document load can be called here.
	 */
	init = function() {
		// Run on first load.
		moveContentBelowFixedHeader();

		// Run after window resize.
		$( window ).resize(function() {
			moveContentBelowFixedHeader();
		});

		// Run after the Customizer updates.
		// 1.5s delay is to allow logo area reflow.
		if (typeof wp.customize != "undefined") {
			wp.customize.bind( 'change', function ( setting ) {
				setTimeout(function() {
					moveContentBelowFixedHeader();
				  }, 1500);
			});
		}
	};

	// Expose the init function only.
	return {
		init: init
	};

})( jQuery );

jQuery( window ).on( 'load', paradox.init );
