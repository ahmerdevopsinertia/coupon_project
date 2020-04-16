<?php

/* THEME USE PRODUCTS */
function couponscms_has_products() {
    return true;
}

/* THEME USE LOCAL STORES */
function couponscms_has_local_stores() {
    return true;
}

/* STARS RATING */
function couponscms_rating( $stars = 0, $votes = 0 ) {
    if( empty( $stars ) ) {
        return false;
    }
    return '<div class="rating-star"' . ( !empty( $votes ) ? ' title="' . sprintf( t( 'theme_rating_store', '%s stars rating from %s votes' ), $stars, $votes ) . '"' : '' ) . '>' .
    str_repeat( '<i class="fa fa-star"></i>', $stars ) .
    ( $stars < 5 ? str_repeat( '<i class="far fa-star"></i>', ( 5 - $stars ) ) : '' ) . ( !empty( $votes ) ? ' (' . $votes . ')' : '' ) .
    '</div>';
}


/* DATE FORMAT */
function couponscms_dateformat( $date = '', $convert_to_unix = true ) {
    if( $convert_to_unix ) {
        $date = strtotime( $date );
    }

    $format = 'd.m.Y';

    if( ( $to_format = get_theme_option( 'date_format' ) ) && !empty( $to_format ) ) {
        $format = $to_format;
    }

    return date( $format, $date );
}

/* DISCOUNT IN PERCENTS */
function couponscms_discount( $old_price, $sale ) {
    if( empty( $old_price ) || empty( $sale ) ) {
        return false;
    }
    return (int) ( 100 - ( $sale / $old_price ) * 100 );
}

/* SHARE LINKS */
function couponscms_share_links( $link = '' ) {
    return '<ul class="share-links">
        <li><a href="https://www.facebook.com/sharer/sharer.php?u=' . $link . '"><i class="fab fa-facebook-f"></i> Facebook</a></li>
        <li><a href="https://twitter.com/intent/tweet?url=' . $link . '"><i class="fab fa-twitter"></i> Twitter</a></li>
    </ul>';
}

/* THEME LANGUAGES */
function couponscms_site_languages() {
    if( (boolean) option( 'allow_select_lang' ) && ( get_theme_option( 'site_multilang' ) ) ) {
        $current = current_language();
        $markup = '<li class="contains-sub-menu"><a href="#">' . $current['name'] . ' <i class="fa fa-angle-down"></i></a>';
        $markup .= '<ul>';
        foreach( site_languages() as $id => $lang ) {
            if( $id !== $current['id'] )
            $markup .= '<li><a href="' . get_update( array( 'set_language' => $id) ) . '"><img src="' . esc_html( $lang['image'] ) . '" alt="" /> ' . esc_html( $lang['name'] ) . '</a></li>';
        }
        $markup .= '</ul>
        </li>';

        return $markup;
    }
    return false;
}

/* VIEW CODE FOR A STORE */
function couponscms_view_store_coupons( $store_id = 0 ) {
    if( isset( $_SESSION['couponscms_rc'] ) && in_array( $store_id, $_SESSION['couponscms_rc'] ) ) {
        return true;
    }
    return false;
}

/* SEARCH FORM MARKUP */
function couponscms_search_form( $extra_class = '', $show_title = true ) {
    echo '<div class="hero-search' . ( !empty( $extra_class ) ? ' ' . $extra_class : '' ) . '">
        <div class="container">';
            if( $show_title ) {
                $search_title = get_theme_option( 'search_title' );
                echo '<h2>' . ( !empty( $search_title ) ? $search_title : t( 'theme_search_title', 'Search for coupons, products or stores' ) ) . '</h2>';
            }
            echo '<form autocomplete="off" class="search-form-container mt-50">
                <div class="search-input">
                    <div class="search-input-container">
                        <input type="text" name="s" data-ajax-search="' . ajax_call_url( 'slick_ajax_search' ) . '" placeholder="' . t( 'theme_type_and_search', 'Type and press enter' ) . '" />
                        <ul class="options">
                            <li class="contains-sub-menu"><a href="#"><span>' . t( 'coupons', 'Coupons' ) . '</span> <i class="fa fa-angle-down"></i></a>
                                <input type="hidden" name="type" value="coupons" />
                                <ul>
                                <li class="active"><a href="#" data-attr="coupons">' . t( 'coupons', 'Coupons' ) . '</a></li>';
                                if( couponscms_has_products() ) {
                                    echo '<li><a href="#" data-attr="products">' . t( '', '' ) . '</a></li>';
                                }
                                echo '<li><a href="#" data-attr="stores">' . t( 'stores', 'Stores' ) . '</a></li>';
                                if( couponscms_has_local_stores() ) {
                                    echo '<li><a href="#" data-attr="locations">' . t( '', '' ) . '</a></li>';
                                }
                                echo '</ul>
                            </li>
                        </ul>
                    </div>
                    <div class="search-helper"></div>
                </div>
                <button>Search</button>
            </form>
        </div>
    </div>';
}
/* INDEX ITEMS */
function couponscms_home_items() {
    $items_on_home = value_with_filter( 'index_items', get_theme_option( 'items_on_index' ) );

    $markup = '';
    if( $items_on_home ) {
        if( is_array( $items_on_home ) ) {
            foreach( $items_on_home as $type ) {
                if( isset( $type['block']['hide'] ) ) continue;
                $background = $limit = $orderby = $show = '';
                if( !empty( $type['block']['background'] ) && in_array( $type['block']['background'], [ 'bgGray', 'bgWhite', 'bgBlack' ] ) ) {
                    $background = esc_html( $type['block']['background'] ) . ' ';
                }
                if( !empty( $type['block']['limit_order'] ) ) {
                    $limit_orderby_show = explode( ';', $type['block']['limit_order'] );
                    $limit = trim( $limit_orderby_show[0] );
                    if( !empty( $limit_orderby_show[1] ) ) {
                        $orderby = trim( $limit_orderby_show[1] );
                    }
                    if( !empty( $limit_orderby_show[2] ) ) {
                        $show = trim( $limit_orderby_show[2] );
                    }
                }
                switch( $type['block']['type'] ) {
                    case 'coupons':
                    $markup .= '<div class="' . $background . 'pt-75 pb-75 clearfix">
                    <div class="container">';
                    if( !empty( $type['block']['title'] ) ) {
                        $markup .= '<h2 class="text-center mb-0">' . $type['block']['title'] . '</h2>';
                    }
                    $markup .= '<div class="list mt-50 clearfix">';
                    foreach( items_custom( [ 'show' => ( !empty( $show ) ? $show : '' ), 'orderby' => ( !empty( $orderby ) ? $orderby : 'rand' ), 'max' => ( !empty( $limit ) ? (int) $limit : 10 ) ] ) as $item ) {
                        $markup .= couponscms_coupon_item( $item );
                    }
                    $markup .= '</div>
                    <div class="text-center mt-75">
                        <a href="' . tlink( 'tpage/coupons' ) . '" class="button big">' . t( 'theme_view_more_coupons', 'View More Coupons' ) . '</a>
                    </div>
                    </div>
                    </div>';
                    break;
                    case 'products':
                    $markup .= '<div class="' . $background . 'pt-75 pb-75 clearfix">
                    <div class="container">';
                    if( !empty( $type['block']['title'] ) ) {
                        $markup .= '<h2 class="text-center mb-0">' . $type['block']['title'] . '</h2>';
                    }
                    $markup .= '<div class="list mt-50 clearfix">';
                    foreach( products_custom( [ 'show' => ( !empty( $show ) ? $show : '' ), 'orderby' => ( !empty( $orderby ) ? $orderby : 'rand' ), 'max' => ( !empty( $limit ) ? (int) $limit : 10 ) ] ) as $item ) {
                        $markup .= couponscms_product_item( $item );
                    }
                    $markup .= '</div>
                    </div>
                    </div>';
                    break;
                    case 'stores':
                    $markup .= '<div class="' . $background . 'pt-75 pb-75 clearfix">
                    <div class="container">';
                    if( !empty( $type['block']['title'] ) ) {
                        $markup .= '<h2 class="text-center mb-0">' . $type['block']['title'] . '</h2>';
                    }
                    $markup .= '<div class="list2 mt-50 clearfix">';
                    foreach( stores_custom( [ 'show' => ( !empty( $show ) ? $show : '' ), 'orderby' => ( !empty( $orderby ) ? $orderby : 'rand' ), 'max' => ( !empty( $limit ) ? (int) $limit : 10 ) ] ) as $item ) {
                        $markup .= couponscms_store_item( $item );
                    }
                    $markup .= '</div>
                    </div>
                    </div>';
                    break;
                    case 'subscribe-form':
                    $markup .= '<div class="' . $background . 'hero-search pt-75 pb-75 clearfix" id="subscribe_form">
                    <div class="container">';
                    if( !empty( $type['block']['title'] ) ) {
                        $markup .= '<h2 class="text-center mb-0">' . $type['block']['title'] . '</h2>';
                    }
                    $markup .= '<div class="search-form-container mt-50">';
                    $markup .= newsletter_form( '_index_form', 'subscribe_form' );
                    $markup .= '</div>
                    </div>
                    </div>';
                    break;
                    case 'slider':
                    $slides = get_theme_option( 'slides' );

                    if( !is_array( $slides ) ) {
                        continue;
                    }

                    $slides = array_map( function( $v ) {
                        if( !isset( $v['slide']['image'] ) || ( isset( $v['slide']['remove'] ) && ( !isset( $v['slide']['expiration'] ) || strtotime( $v['slide']['expiration'] ) < strtotime( 'now' ) ) ) ) return;
                        return $v;
                    }, $slides );

                    $slides = array_filter( $slides );
                    if( !empty( $slides ) ) {
                        $markup .= '<div class="owl-carousel owl-theme">';
                        foreach( $slides as $slide ) {
                            $image = $slide['slide']['image'];
                            if( !filter_var( $image, FILTER_VALIDATE_URL ) ) {
                                $image_json = @json_decode( $image );
                                if( $image_json ) {
                                    $image = current( $image_json );
                                }
                            }
                            $markup .= '<div class="item">
                                            <a href="' . ( !empty( $slide['slide']['link'] ) ?  esc_html( $slide['slide']['link'] ) : '#' ) . '">
                                                <img src="' . esc_html( $image ) . '" />
                                            </a>
                                        </div>';
                        }
                        $markup .= '</div>';
                    }
                    break;
                    case 'campaigns':
                    $campaigns = get_theme_option( 'campaigns' );

                    if( !is_array( $campaigns ) ) {
                        return ;
                    }

                    if( is_array( $campaigns ) ) {
                        $campaigns = array_map( function( $v ) {
                            if( !isset( $v['campaign']['image'] ) || ( isset( $v['campaign']['remove'] ) && ( !isset( $v['campaign']['expiration'] ) || strtotime( $v['campaign']['expiration'] ) < strtotime( 'now' ) ) ) ) return;
                            return $v;
                        }, $campaigns );
                    }

                    $campaigns = array_slice( array_filter( $campaigns ), 0, 3 );
                    if( !empty( $campaigns ) ) {
                        $markup .= '<div class="' . $background . ' mt-75 mb-75 clearfix">
                        <div class="container">
                        <div class="row features">';
                        foreach( $campaigns as $campaign ) {
                            $image = $campaign['campaign']['image'];
                            if( !filter_var( $image, FILTER_VALIDATE_URL ) ) {
                                $image_json = @json_decode( $image );
                                if( $image_json ) {
                                    $image = current( $image_json );
                                }
                            }
                            $markup .= '<div class="col-12 col-md-4">
                                            <div class="feature">
                                                <a href="' . ( !empty( $campaign['campaign']['link'] ) ?  esc_html( $campaign['campaign']['link'] ) : '#' ) . '">
                                                    <div class="img-container">
                                                        <img src="' . esc_html( $image ) . '" alt="">';
                                                        if( !empty( $campaign['campaign']['expiration'] ) ) {
                                                            $markup .= '<div class="exp-date" data-countdown="' . date( 'D M d Y H:i:s O', strtotime( $campaign['campaign']['expiration'] ) ) . '"></div>';
                                                        }
                                                    $markup .= '</div>
                                                    <h6>' . ( !empty( $campaign['campaign']['title'] ) ? esc_html( $campaign['campaign']['title'] ) : '' ) . '</h6>
                                                </a>
                                            </div>
                                        </div>';
                        }
                        $markup .= '</div>
                        </div>
                        </div>';
                    }
                    break;
                }
            }
        }
    } else {
        $markup .= '<div class="pt-75 pb-75 clearfix">
        <div class="container">
        <div class="list clearfix">';
        foreach( items_custom( array( 'orderby' => 'date desc', 'max' => 10 ) ) as $item ) {
            $markup .= couponscms_coupon_item( $item );
        }
        $markup .= '</div>
        </div>
        </div>';
    }
    return $markup;
}