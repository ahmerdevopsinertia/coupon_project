<?php

function add( $type = '', $options = array() ) {
    return \site\actions::add( $type, $options );
}

function get( $type = '' ) {
    return \site\actions::get( $type );
}

function remove( $type = '', $options = array() ) {
    return \site\actions::remove( $type, $options );
}

function t( $id = '', $text = '' ) {
    global $LANG;
    return isset( $LANG[$id] ) ? $LANG[$id] : $text;
}

$load_plugins = \query\main::user_plugins( '', 'loader' );
if( !empty( $load_plugins ) ) {
    foreach( $load_plugins as $plugin ) {
        echo DIR . '/' . UPDIR . '/' . $plugin->load_file;
        if( file_exists( DIR . '/' . UPDIR . '/' . $plugin->load_file ) ) {
            require_once DIR . '/' . UPDIR . '/' . $plugin->load_file;
        }
    }
}