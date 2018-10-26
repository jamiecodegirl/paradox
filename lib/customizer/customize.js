/**
 * Paradox
 *
 * This file adds the Customizer Live Preview additions to the theme.
 */
(function($, wp) {
    "use strict";

    var $globalCSS = $('<style id="paradox-custom-css" type="text/css" /></style>'),
        css = {};

    $(document).ready(function() {
        $('head').append( $globalCSS );
    }).on( 'paradox-cssRefresh', function() { printGlobalCSS(css); });

})(jQuery, wp);
