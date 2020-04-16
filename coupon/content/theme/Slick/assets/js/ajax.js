$( document ).ready(function() {
    
    "use strict";

    $(document).on( 'click', '[data-ajax-call]:not(.disabled)', function(e) {
        e.preventDefault();
        var t = $(this);
        var url = t.data( 'ajax-call' ),
        data = t.data( 'data' );

        if( t.data( 'confirmation' ) == undefined || confirm( t.data( 'confirmation' ) ) ) {
            $.post( url, data, function( result ) {
                if( t.data( 'after-ajax' ) != undefined ) {
                    switch( t.data( 'after-ajax' ) ) {
                        case 'ajax_voted':
                            if( result.state != 'success' ) {
                                // alert( result.message );
                                window.location = login_page;
                            } else {
                                var votes_form = t.parents( '.vote-form' );
                                votes_form.after( '<li><span class="ajax-message"><strong>' + t.data( 'message' ) + '</strong></span></li>' );
                                votes_form.remove();
                                $('.tooltip').remove();
                            }
                        break;
                        case 'coupon_claimed':
                            if( result.state == 'success' ) {
                                t.addClass( 'disabled' );
                                t.html( result.message );
                            } else {
                                // alert( result.message );
                                window.location = login_page;
                            }
                        break;
                    }
                } else {
                    if( result.state != 'success' ) {
                        // alert( result.message );
                        window.location = login_page;
                    } else {
                        t.html( result.message );
                    }
                }
            }, "json" );
        }
    });

});