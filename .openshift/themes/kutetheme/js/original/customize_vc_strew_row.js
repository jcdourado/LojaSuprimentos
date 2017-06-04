(function($){
    function customizeFunction() {
    	var $elements = $( '.rtl div[data-vc-full-width="true"]' );
    	$.each( $elements, function ( key, item ) {
    		var $el = $( this );
    		$el.addClass( 'vc_hidden' );
    
    		var $el_full = $el.next( '.vc_row-full-width' );
    		var el_margin_left = parseInt( $el.css( 'margin-left' ), 10 );
    		var el_margin_right = parseInt( $el.css( 'margin-right' ), 10 );
    		var offset = 0 - $el_full.offset().left - el_margin_left;
    		var width = $( window ).width();
    		$el.css( {
    			'position': 'relative',
    			'left': offset * -1,
    			'box-sizing': 'border-box',
    			'width': $( window ).width()
    		} );
    		if ( ! $el.data( 'vcStretchContent' ) ) {
    			var padding = (- 1 * offset);
    			if ( 0 > padding ) {
    				padding = 0;
    			}
    			var paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right;
    			if ( 0 > paddingRight ) {
    				paddingRight = 0;
    			}
    			$el.css( { 'padding-left': padding + 'px', 'padding-right': paddingRight + 'px' } );
    		}
    		$el.attr( "data-vc-full-width-init", "true" );
    		$el.removeClass( 'vc_hidden' );
    	} );
    }
    window.vc_rowBehaviour = function () {
        customizeFunction();
    }
    jQuery( window.vc_rowBehaviour ).unbind( 'localFunction' );
    $( window ).unbind( 'resize.vcRowBehaviour' ).bind( 'resize.vcRowBehaviour', customizeFunction );
})(jQuery); // End of use strict
