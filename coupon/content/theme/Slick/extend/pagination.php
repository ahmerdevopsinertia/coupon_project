<?php

function couponscms_theme_pagination( $pagination, $links = 1 ) {

    if( !isset( $pagination['pages'] ) || (int) $pagination['pages'] <= 1 ) {
        return false;
    }

    $markup = '';

    $override = do_action( 'override_navigation', $pagination );

    if( !$override ) {

        $start      = ( ( $pagination['page'] - $links ) > 0 ) ? $pagination['page'] - $links : 1;
        $end        = ( ( $pagination['page'] + $links ) < $pagination['pages'] ) ? $pagination['page'] + $links : $pagination['pages'];

        $markup     .= '<div class="text-center mt-75">
        <ul class="pagination">';

        $markup     .= '<li' . ( ( $pagination['page'] == 1 ) ? ' class="selected"' : '' ) . '><a href="' . get_update( array( 'page' => ( $pagination['page'] == 1 ? 1 : ( $pagination['page'] - 1 ) ) ), get_remove( array( 'cid', 'pid' ) ) ) . '"><i class="fas fa-arrow-left"></i></a></li>';

        if ( $start > 1 ) {
            $markup   .= '<li><a href="' . get_update( array( 'page' => 1 ), get_remove( array( 'cid', 'pid' ) ) ) . '">1</a></li>';
            if( ( $pagination['page'] - ($links+1 ) ) > 1 ) $markup   .= '<li>&hellip;</li>';
        }

        for ( $i = $start ; $i <= $end; $i++ ) {
            $markup .= '<li' . ( $pagination['page'] == $i ? ' class="selected"' : '' ) . '><a href="' . get_update( array( 'page' => $i ), get_remove( array( 'cid', 'pid' ) ) ) . '">' . $i . '</a></li>';
        }

        if ( $end < $pagination['pages'] ) {
            if( ( $pagination['page'] + ($links+1) ) < $pagination['pages'] ) $markup .= '<li>&hellip;</li>';
            $markup .= '<li><a href="' . get_update( array( 'page' => $pagination['pages'] ), get_remove( array( 'cid', 'pid' ) ) ) . '">' . $pagination['pages'] . '</a></li>';
        }

        $markup     .= '<li' . ( ( $pagination['page'] == $pagination['pages'] ) ? ' class="selected"' : '' ) . '><a href="' . get_update( array( 'page' => ( $pagination['page'] == $pagination['pages'] ? $pagination['pages'] : ( $pagination['page'] + 1 ) ) ), get_remove( array( 'cid', 'pid' ) ) ) . '"><i class="fas fa-arrow-right"></i></a></li>';

        $markup     .= '</ul>
        </div>';

    } else $markup .= $override;

    return $markup;

}