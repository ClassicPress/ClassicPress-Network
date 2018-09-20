/*
 Field Button Set (button_set)
 */

/*global jQuery, document, redux*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.button_set = redux.field_objects.button_set || {};

    $( document ).ready(
        function() {
            //redux.field_objects.button_set.init();
            if ( $.fn.button.noConflict !== undefined ) {
                var btn = $.fn.button.noConflict();
                $.fn.btn = btn;
            }
        }
    );

    redux.field_objects.button_set.init = function( selector ) {
        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-button_set:visible' );
        }

        $( selector ).each(
            function() {
                var el = $( this );
                var parent = el;
                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }
                el.find( '.buttonset' ).each(
                    function() {
                        if ( $( this ).is( ':checkbox' ) ) {
                            $( this ).find( '.buttonset-item' ).button();
                        }

                        $( this ).buttonset();
						var initAnimation = function($input) {
							if($input.next('label.ui-state-active').hasClass('ui-corner-right')) {
								$input.siblings('.button-animation').addClass('right-active');
							} else {
								$input.siblings('.button-animation').removeClass('right-active');
							}
						};
						initAnimation($(this).find('input'));
						$(this).find('input').on('change', function() {
							initAnimation($(this));
						});
                    }
                );
            }
        );

    };
})( jQuery );