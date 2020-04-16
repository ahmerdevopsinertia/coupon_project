<?php

/* BLOG NAVIGATION */

function blog_pagination( $pagination, $links = 2 ) {
    if( !isset( $pagination['pages'] ) || (int) $pagination['pages'] <= 1 ) {
        return false;
    }

    $markup = '';

    $override = do_action( 'blog_override_navigation', $pagination );

    if( !$override ) {

        $start      = ( ( $pagination['page'] - $links ) > 0 ) ? $pagination['page'] - $links : 1;
        $end        = ( ( $pagination['page'] + $links ) < $pagination['pages'] ) ? $pagination['page'] + $links : $pagination['pages'];

        $markup     .= '<ul class="blog-pagination">';

        $markup     .= '<li class="blog-nav-left' . ( ( $pagination['page'] == 1 ) ? ' disabled' : '' ) . '"><a href="' . get_update( array( 'page' => ( $pagination['page'] == 1 ? 1 : ( $pagination['page'] - 1 ) ) ), get_remove( array( 'id' ) ) ) . '">' . t( 'blog_pagination_prev', '&laquo; Prev ' ) . '</a></li>';

        if ( $start > 1 ) {
            $markup   .= '<li><a href="' . get_update( array( 'page' => 1 ), get_remove( array( 'id' ) ) ) . '">1</a></li>';
            if( ( $pagination['page'] - ($links+1 ) ) > 1 ) $markup   .= '<li class="disabled ellipsis"><span>...</span></li>';
        }

        for ( $i = $start ; $i <= $end; $i++ ) {
            $markup .= '<li' . ( $pagination['page'] == $i ? ' class="active button-disabled"' : '' ) . '><a href="' . get_update( array( 'page' => $i ), get_remove( array( 'id' ) ) ) . '">' . $i . '</a></li>';
        }

        if ( $end < $pagination['pages'] ) {
            if( ( $pagination['page'] + ($links+1) ) < $pagination['pages'] ) $markup .= '<li class="disabled ellipsis"><span>...</span></li>';
            $markup .= '<li><a href="' . get_update( array( 'page' => $pagination['pages'] ), get_remove( array( 'id' ) ) ) . '">' . $pagination['pages'] . '</a></li>';
        }

        $markup     .= '<li class="blog-nav-right' . ( ( $pagination['page'] == $pagination['pages'] ) ? ' disabled' : '' ) . '"><a href="' . get_update( array( 'page' => ( $pagination['page'] == $pagination['pages'] ? $pagination['pages'] : ( $pagination['page'] + 1 ) ) ), get_remove( array( 'id' ) ) ) . '">' . t( 'blog_pagination_next', 'Next &raquo;' ) . '</a></li>';

        $markup     .= '</ul>';

    } else $markup .= $override;

    return $markup;
}

/* BLOG INDEX LINK */

function blog_link() {
    if( defined( 'SEO_LINKS' ) && SEO_LINKS ) {
        return \site\utils::make_seo_link( BLOG_INDEX_SLUG );
    }

    return \site\utils::make_template_seo_link( BLOG_INDEX_SLUG );
}