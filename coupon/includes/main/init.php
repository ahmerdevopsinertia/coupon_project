<?php

/* Options / Hooks and Actions */

function add( $type = '', $options = '', $extra = '' ) {
    return \site\actions::add( $type, $options, $extra );
}

function get( $type = '', $options = '' ) {
    return \site\actions::get( $type, $options );
}

function remove( $type = '', $options = '', $extra = '' ) {
    return \site\actions::remove( $type, $options, $extra );
}

/* Used for translations */

function t( $id = '', $text = '', $tl_override = false, $return_string = true ) {
    global $LANG;
    if( isset( $LANG[$id] ) ) {
        return $LANG[$id];
    }
    else return $text;
}

function te( $id = '', $text = '', $tl_override = false ) {
    echo t( $id, $text, $tl_override );
}

function ts( $text = '' ) {
    preg_match_all( '/\[(.*?(?=\())?\(\:([a-z0-9-_]+)\)\]/i', $text, $out );

    foreach( $out[0] as $k => $s ) {
        $text = str_replace( $s, t( $out[2][$k], $out[1][$k] ), $text );
    }

    return $text;
}

function tse( $text = '' ) {
    echo ts( $text );
}

function is_admin_panel() {
    return ( defined( 'IS_ADMIN_PANEL' ) && IS_ADMIN_PANEL ? true : false );
}

/* Util functions used for initializing */

function esc_html( $str = '' ) {
    return htmlspecialchars( $str );
}

function html_decode( $str = '' ) {
    return htmlspecialchars_decode( $str );
}

/* AJAX */

/* Ajax call url */

function ajax_call_url( $target = '' ) {
    if( !empty( $target ) ) {
        $ajax_calls = ajax_calls();

        if( in_array( $target, array_keys( $ajax_calls ) ) ) {

            if( !isset( $_SESSION['ajax-call'][$target] ) ) {
                $_SESSION['ajax-call'][$target] = array();
                $token = $_SESSION['ajax-call'][$target]['token'] = \site\utils::str_random(15);
            } else {
                $token = $_SESSION['ajax-call'][$target]['token'];
            }

            if( filter_var( $ajax_calls[$target], FILTER_VALIDATE_URL ) ) {
                return get_update( array( 'token' => $token ), $ajax_calls[$target] );
            } else if( \site\utils::check_callback( $ajax_calls[$target] ) ) {
                return get_update( array( 'type' => $target, 'token' => $token ), ( defined( 'SEO_LINKS' ) && SEO_LINKS ? site_url( 'ajax' ) . '/call.php' : $GLOBALS['siteURL'] . '?ajax=call' ) );
            }

        }

    }

    return '#';
}

/* Check ajax token */

function check_ajax_token( $target = '', $token = '' ) {
    if( !empty( $target ) ) {
        if( !empty( $_SESSION['ajax-call'][$target]['token'] ) && $_SESSION['ajax-call'][$target]['token'] == $token ) {
            return true;
        }
    }

    return false;
}

/* List of all ajax calls */

function ajax_calls() {
    global $add_ajax_calls;

    $seo_link = defined( 'SEO_LINKS' ) && SEO_LINKS ? true : false;

    $ajax_call = array();

    $ajax_call['login'] = ( $seo_link ? site_url( 'ajax' ) . '/login.php' : $GLOBALS['siteURL'] . '?ajax=login' );
    $ajax_call['register'] = ( $seo_link ? site_url( 'ajax' ) . '/register.php' : $GLOBALS['siteURL'] . '?ajax=register' );
    $ajax_call['subscribe'] = ( $seo_link ? site_url( 'ajax' ) . '/subscribe.php' : $GLOBALS['siteURL'] . '?ajax=subscribe' );
    $ajax_call['favorite'] = ( $seo_link ? site_url( 'ajax' ) . '/favorite.php' : $GLOBALS['siteURL'] . '?ajax=favorite' );
    $ajax_call['save'] = ( $seo_link ? site_url( 'ajax' ) . '/save.php' : $GLOBALS['siteURL'] . '?ajax=save' );
    $ajax_call['vote'] = ( $seo_link ? site_url( 'ajax' ) . '/vote.php' : $GLOBALS['siteURL'] . '?ajax=vote' );
    $ajax_call['claim'] = ( $seo_link ? site_url( 'ajax' ) . '/claim.php' : $GLOBALS['siteURL'] . '?ajax=claim' );    
    $ajax_call['search_coupon'] = ( $seo_link ? site_url( 'ajax' ) . '/search_coupon.php' : $GLOBALS['siteURL'] . '?ajax=search_coupon' );
    $ajax_call['search_product'] = ( $seo_link ? site_url( 'ajax' ) . '/search_product.php' : $GLOBALS['siteURL'] . '?ajax=search_product' );
    $ajax_call['search_store'] = ( $seo_link ? site_url( 'ajax' ) . '/search_store.php' : $GLOBALS['siteURL'] . '?ajax=search_store' );
    $ajax_call['search_user'] = ( $seo_link ? site_url( 'ajax' ) . '/search_user.php' : $GLOBALS['siteURL'] . '?ajax=search_user' );
    $ajax_call['search_category'] = ( $seo_link ? site_url( 'ajax' ) . '/search_category.php' : $GLOBALS['siteURL'] . '?ajax=search_category' );
    $ajax_call['states_in_country'] = ( $seo_link ? site_url( 'ajax' ) . '/states_in_country.php' : $GLOBALS['siteURL'] . '?ajax=states_in_country' );
    $ajax_call['cities_from_state'] = ( $seo_link ? site_url( 'ajax' ) . '/cities_from_state.php' : $GLOBALS['siteURL'] . '?ajax=cities_from_state' );

    if( !empty( $add_ajax_calls ) && is_array( $add_ajax_calls ) ) {
        $ajax_call = $ajax_call + $add_ajax_calls;
    }

    return $ajax_call;
}

/* Ajax callback value */

function ajax_callback_value( $target = '' ) {
    if( !empty( $target ) ) {
        $ajax_calls = ajax_calls();
        if( in_array( $target, array_keys( $ajax_calls ) ) ) {
            return $ajax_calls[$target];
        }
    }

    return false;
}