<?php

function couponscms_menu_subnav_item( $subnav = array() ) {
    $markup = '';
    if( isset( $subnav['subnav'] ) ) {
        $markup .= '<ul class="sub-nav">';
        foreach( $subnav['subnav'] as $link ) {
            if( $link['dropdown'] ){
                $link['classes'][] = 'contains-sub-menu';
            }
            $markup .= '<li' . ( !empty( $link['classes'] ) ? ' class="' . implode( ' ', $link['classes'] ) . '"' : '' ) . '><a href="' . $link['url'] . '"' . ( isset( $link['open_type'] ) && in_array( $link['open_type'], array( '_self', '_blank' ) ) ? ' target="' . $link['open_type'] . '"' : '' ) . '>' . ts( $link['name'] ) . ( $link['dropdown'] ? ' <i class="fa fa-angle-right"></i>' : '' ) . '</a>';
            $markup .= couponscms_menu_subnav_item( $link );
            $markup .= '</li>';
        }
        $markup .= '</ul>';
    }
    return $markup;
}

function couponscms_menu( $menu_id = '' ) {
    $markup = '';
    foreach( site_menu( $menu_id ) as $link ) {
        if( ( $link_name = preg_replace( '/<(.*?)>(.*?)<\/(.*?)>/', '', $link['name'] ) ) && !empty( $link_name ) && $link['dropdown'] ){
            $link['classes'][] = 'contains-sub-menu';
        }
        $markup .= '<li' . ( !empty( $link['classes'] ) ? ' class="' . implode( ' ', $link['classes'] ) . '"' : '' ) . '><a href="' . $link['url'] . '"' . ( isset( $link['open_type'] ) && in_array( $link['open_type'], array( '_self', '_blank' ) ) ? ' target="' . $link['open_type'] . '"' : '' ) . '>' . ts( $link['name'] )  . ( $link['dropdown'] ? ' <i class="fa fa-angle-down' . ( empty( $link_name ) ? ' icononly' : '' ) . '"></i>' : '' ) . '</a>';
        $markup .= couponscms_menu_subnav_item( $link );
        $markup .= '</li>';
    }
    return $markup;
}

?>