$( window ).on( "load", function(){
    
    "use strict";

    $( '.owl-carousel' ).not( '.list3' ).owlCarousel({ loop: true, margin: 10, nav: false,
        responsive: {
            0: {
                items:1
            },
            600: {
                items:1
            },
            1000: {
                items:1
            }
        }
    });

    $( '.owl-carousel.list3' ).owlCarousel({ loop: false, margin: 10, nav: true, navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'], dots: false,
        responsive: {
            0: {
                items:2,
                nav:false
            },
            600: {
                items:2
            },
            1000: {
                items:5
            }
        }
    });

    $(window).resize( function(){
        if( $('.list > .item').length > 0 ) {
            $('.list > .item .title').addClass('sized');
            $('.list > .item h4, .list > .item .description > p').width(200);
            setTimeout(function(){
                var width = $('.list > .item .content').width();
                $('.list > .item h4, .list > .item .description > p').width(width);
            }, 200);
        }
    }).resize();

    $(document).on( 'mouseover', '.title.sized', function(){
        if( $(this).find('.dtitle').length == 0 ) {
            $(this).append('<div class="dtitle"><h4>' + $(this).text() + '</h4></div>');
            $(this).find('.dtitle').fadeIn(200);
        }
    });

    $(document).on( 'mouseleave', '.title.sized', function(){
        $(this).find('.dtitle').fadeOut(200, function(){
            $(this).remove();
        });
    });

    $( '[data-countdown]' ).each(function(){
        var t = $(this);
        var countDownDate = new Date(t.data('countdown')).getTime();
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var days    = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            var content = '';

            if( days > 0 ) {
                content += days + '<span>d</span> ';
            }

            if( hours > 0 ) {
                content += hours + '<span>h</span> ';
            }

            if( minutes > 0 ) {
                content += minutes + '<span>m</span> ';
            }

            content += seconds + '<span>s</span> ';

            t.html(content);

            if (distance < 0) {
                clearInterval(x);
                t.html('');
            }
        }, 1000);
    });

    $( '.show-search' ).on( 'click', function(e){
        e.preventDefault();
        $('.menu-container.active .mobile-menu').animate( { left: '-100%' }, 100 );
    });

    $( '.close-search' ).on( 'click', function(e){
        e.preventDefault();
        $('.menu-container.active .mobile-menu').animate( { left: 0 }, 100 );
    });

    $( '.mobile-menu .contains-sub-menu > a' ).on( 'click', function(e) {
        e.preventDefault();
        var t = $(this);
        t.parent().toggleClass( 'active' );
        var ul = t.parent().find( ' > ul' );
        ul.toggleClass( 'visible' );
    });

    var progress_bar, progress_height, progress_top_offset;

    if( $( '.show-progress-bar' ).length > 0 ) {
        progress_bar = $( '.menu-container' ).append( '<div class="progress-bar" style="position:absolute;top:0;background:#a4006a;height:3px;width:0;"></div>' );
        progress_height = $( '.show-progress-bar' ).height();
        progress_top_offset = $( '.show-progress-bar' ).offset().top;
    }

    $( document ).scroll(function(){
        var dtt = $(document).scrollTop();
        if( dtt > 70 ) {
            $( '.menu-container' ).addClass( 'fixed' );
        } else {
            $( '.menu-container' ).removeClass( 'fixed' );
        }
        if( typeof progress_bar != 'undefined' ) {
            var percent = ( ( ( dtt - progress_top_offset ) / progress_height ) * 100 );
            if( percent < 0 ) percent = 0;
            if( percent > 100 ) percent = 100;
            $( '.progress-bar' ).width( parseInt( percent ) + '%' );
        }
    }).scroll();

    $( '.lines' ).on( 'click', function(e){
        e.preventDefault();
        $(this).parents('.menu-container').toggleClass('active');
    });

    $( '.search-input input' ).on( 'keyup', function(e){
        var t = $(this);
        var parent = t.parents('.search-input');
        var helper = parent.find( '.search-helper' );
        helper.removeClass( 'visible' );
        $.post( t.data( 'ajax-search' ), {text: t.val()}, function(data) {
            if( data.length ) {
                helper.html(data);
                helper.addClass( 'visible' );
            }    
        });
    });

    $( '.search-form-container .options input[type="hidden"] + ul > li a' ).on( 'click', function(e) {
        e.preventDefault();
        var t = $(this);
        var ul = t.parents('ul:first'),
        li = t.closest('li'),
        options = ul.closest('.options');
        var title = options.find('li:first a > span');
        ul.find('li').removeClass('active');
        li.addClass('active');
        title.text(t.text());
        options.find('input:first').val(t.data('attr'));
        options.prevAll('input').focus();
    });

    $( '[data-code]' ).on( 'click', function(e) {
        e.preventDefault();
        $(this).text($(this).data('code')).addClass('active').removeAttr('data-code');
    });

    $( '.code-revealed.button' ).on( 'click', function(e) {
        e.preventDefault();
        var t = $(this);
        var ico = t.find('i');
        var ico_str = ico.attr('class');
        t.find( 'input' ).focus().select();
        document.execCommand( 'copy' );
        t.find( 'input' ).blur();
        ico.attr('class', 'fas fa-check');
        setTimeout(function(){
            ico.attr('class', ico_str);
        }, 2000);
    } );

    $( '.store-info-list a.hours' ).on( 'click', function( e ) {
        e.preventDefault();
        var ul = $(this).parent().next( 'ul' );
        if( ul.is( ':visible' ) ) {
            ul.fadeOut( 200 );
        } else {
            ul.fadeIn( 200 );
        }
    });

    $( document ).on( 'click', '[data-target-on-click]', function() {
        var isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
        if( isSafari ) {
            $(this).removeAttr( 'target' );
        }
        window.location = $(this).data( 'target-on-click' );
    });

    $( '.reward-claim.button' ).on( 'click', function(e){
        e.preventDefault();
        var t = $(this);
        t.parent().prev().slideDown();
        t.remove();
    } );

    $( 'a[href="#"]' ).on( 'click', function(e) {
        e.preventDefault();
    });

});