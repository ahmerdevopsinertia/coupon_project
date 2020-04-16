<?php

namespace plugin\Blog\inc;

class posts {

    /* GET NUMBER OF POSTS */

    public static function posts( $categories = array() ) {
        return self::have_posts( $categories, array( 'only_count' => '' ) );
    }


    /* CHECK IF POST EXISTS */

    public static function exists( $id, $admin_view = false ) {

        global $db;

        $stmt = $db->stmt_init();
        $stmt->prepare( "SELECT COUNT(*) FROM " . DB_TABLE_PREFIX . "blog_posts WHERE (id = ? OR url_title = ?)" . ( !$admin_view ? ' AND visible = 1' : '' ) );
        $stmt->bind_param( "is", $id, $id );
        $stmt->execute();
        $stmt->bind_result( $count );
        $stmt->fetch();
        $stmt->close();

        if( $count > 0 ) {
            return true;
        }

        return false;

    }

    /* GET INFORMATION ABOUT POST */

    public static function info( $id, $admin_view = false ) {

        global $db;

        $stmt = $db->stmt_init();
        $stmt->prepare( "SELECT id, user, title, text, image, lang, visible, url_title, meta_title, meta_keywords, meta_desc, lastupdate_by, lastupdate, date FROM " . DB_TABLE_PREFIX . "blog_posts WHERE (id = ? OR url_title = ?)" . ( !$admin_view ? ' AND visible = 1' : '' ) );
        $stmt->bind_param( "is", $id, $id );
        $stmt->execute();
        $stmt->bind_result( $id, $user, $title, $text, $image, $language, $visible, $url_title, $meta_title, $meta_keywords, $meta_desc, $last_update_by, $last_update, $date );
        $stmt->fetch();
        $stmt->close();

        return (object) array( 'ID' => $id, 'user' => $user, 'title' =>  $title, 'text' => $text, 'content' => \site\content::content( 'blog_text', nl2br( $text ), true, true, false, false, true ), 'image' => ( !empty( $image ) ? $image : '' ), 'language' => $language, 'url_title' => $url_title, 'is_visible' => $visible, 'navigation' => new post_navigation( $id, $date ), 'link' => ( defined( 'SEO_LINKS' ) && SEO_LINKS ? \site\utils::make_seo_link( BLOG_INDEX_SLUG . '/' . BLOG_SINGLE_SLUG, $title, $url_title, $id, \query\main::get_option( 'extension' ) ) : \site\utils::make_template_seo_link( BLOG_INDEX_SLUG . '/' . BLOG_SINGLE_SLUG, $title, $url_title, $id, \query\main::get_option( 'extension' ) ) ), 'meta_title' => esc_html( $meta_title ), 'meta_keywords' => esc_html( $meta_keywords ), 'meta_description' => esc_html( $meta_desc ), 'last_update_by' => $last_update_by, 'last_update' => $last_update, 'date_time' => strtotime( $date ), 'date' => $date );

    }

    /* NUMBER OF POSTS */

    public static function have_posts( $category = array() ) {

        global $db;

        $categories = \site\utils::validate_user_data( $category );

        $where = array();

        /* WHERE / ORDER BY */

        if( !empty( $categories['search'] ) ) {
            $search = implode( '.*', explode( ' ', trim( $categories['search'] ) ) );
            $where[] = '(title REGEXP "' . \site\utils::dbp( $search ) . '" OR text REGEXP "' . \site\utils::dbp( $search ) . '")';
        }

        if( !empty( $categories['language'] ) ) {
            if( strcasecmp( $categories['language'], 'all' ) != 0 ) {
                $where[] = 'lang = "' . \site\utils::dbp( $categories['language'] ) . '"';
            }
        } else {
            $where[] = 'lang = "' . \site\utils::dbp( current_language()['id'] ) . '"';
        }

        if( isset( $categories['show'] ) ) {
            $show = array_map( 'trim', explode( ',', strtolower( $categories['show'] ) ) );
            foreach( $show as $v ) {
                switch( $v ) {
                    case 'all': break;
                    default: $where[] = 'date <= NOW()'; break;
                }
            }
        } else {
            $where[] = 'visible = 1';
            $where[] = 'date <= NOW()';
        }

        /* */

        $stmt = $db->stmt_init();
        $stmt->prepare( "SELECT COUNT(*) FROM " . DB_TABLE_PREFIX . "blog_posts" . ( !empty( $where ) ? ' WHERE ' . implode( ' AND ', array_filter( $where ) ) : '' ) );
        $stmt->execute();
        $stmt->bind_result( $count );
        $stmt->fetch();
        $stmt->close();

        if( isset( $special['only_count'] ) ) {
            return $count;
        }

        $pags = array();
        $pags['results'] = $count;
        $pags['per_page'] = ( !empty( $categories['per_page'] ) ? (int) $categories['per_page'] : \query\main::get_option( 'blog_items_per_page' ) );
        $pags['pages'] = ceil( $pags['results'] / $pags['per_page'] );
        $page = ( !empty( $categories['page'] ) ? (int) $categories['page'] : ( !empty( $_GET['page'] ) ? (int) $_GET['page'] : 1 ) );
        if( $page < 1 ) $page = 1;
        if( $page > $pags['pages'] ) $page = $pags['pages'];
        $pags['page'] = $page;
        if( $pags['pages'] > $pags['page'] ) $pags['next_page'] = \site\utils::update_uri( '', array( 'page' => ($pags['page']+1) ) );
        if( $pags['pages'] > 1 && $pags['page'] > 1 ) $pags['prev_page'] = \site\utils::update_uri( '', array( 'page' => ($pags['page']-1) ) );

        return $pags;

    }

    /* FETCH THE POSTS */

    public static function fetch_posts( $category = array() ) {

        global $db;

        /** make or not seo links */
        $seo_link = defined( 'SEO_LINKS' ) && SEO_LINKS ? true : false;
        $extension = \query\main::get_option( 'extension' );

        $categories = \site\utils::validate_user_data( $category );

        $where = $orderby = $limit = array();

        if( isset( $categories['max'] ) ) {
            if( !empty( $categories['max'] ) ) {
                $limit[] = $categories['max'];
            }
        } else {
            $page = ( !empty( $categories['page'] ) ? (int) $categories['page'] : ( !empty( $_GET['page'] ) ? (int) $_GET['page'] : 1 ) );
            $per_page = ( isset( $categories['per_page'] ) ? (int) $categories['per_page'] : \query\main::get_option( 'blog_items_per_page' ) );
            $offset = isset( $page ) && $page > 1 ? ( $page - 1 ) * $per_page : 0;

            $limit[] = $offset;
            $limit[] = $per_page;
        }

        /* WHERE / ORDER BY */

        if( !empty( $categories['search'] ) ) {
            $search = implode( '.*', explode( ' ', trim( $categories['search'] ) ) );
            $where[] = '(title REGEXP "' . \site\utils::dbp( $search ) . '" OR text REGEXP "' . \site\utils::dbp( $search ) . '")';
        }

        if( !empty( $categories['language'] ) ) {
            if( strcasecmp( $categories['language'], 'all' ) != 0 ) {
                $where[] = 'lang = "' . \site\utils::dbp( $categories['language'] ) . '"';
            }
        } else {
            $where[] = 'lang = "' . \site\utils::dbp( current_language()['id'] ) . '"';
        }

        if( isset( $categories['show'] ) ) {
            $show = array_map( 'trim', explode( ',', strtolower( $categories['show'] ) ) );
            foreach( $show as $v ) {
                switch( $v ) {
                    case 'all': break;
                    default: $where[] = 'date <= NOW()'; break;
                }
            }
        } else {
            $where[] = 'visible = 1';
            $where[] = 'date <= NOW()';
        }

        if( isset( $categories['orderby'] ) ) {
            $order = array_map( 'trim', explode( ',', strtolower( $categories['orderby'] ) ) );
            foreach( $order as $v ) {
                switch( $v ) {
                    case 'rand': $orderby[] = 'RAND()'; break;
                    case 'title': $orderby[] = 'title'; break;
                    case 'title desc': $orderby[] = 'title DESC'; break;
                    case 'date': $orderby[] = 'date'; break;
                    case 'date desc': $orderby[] = 'date DESC'; break;
                }
            }
        } else {
            $orderby[] = 'date DESC';
        }

        /* */

        $stmt = $db->stmt_init();
        $stmt->prepare( "SELECT id, user, title, text, image, lang, visible, url_title, meta_title, meta_keywords, meta_desc, lastupdate_by, lastupdate, date FROM " . DB_TABLE_PREFIX . "blog_posts" . ( !empty( $where ) ? ' WHERE ' . implode( ' AND ', array_filter( $where ) ) : '' ) . ( empty( $orderby ) ? '' : ' ORDER BY ' . implode( ', ', array_filter( $orderby ) ) ) . ( empty( $limit ) ? '' : ' LIMIT ' . implode( ',', $limit ) ) );
        $stmt->execute();
        $stmt->bind_result( $id, $user, $title, $text, $image, $language, $visible, $url_title, $meta_title, $meta_keywords, $meta_desc, $last_update_by, $last_update, $date );

        $data = array();
        while( $stmt->fetch() ) {

            $data[] = (object) array( 'ID' => $id, 'user' => $user, 'title' =>  $title, 'text' => $text, 'content' => \site\content::content( 'blog_text', nl2br( $text ) ), 'image' => ( !empty( $image ) ? $image : '' ), 'language' => $language, 'is_visible' => $visible, 'link' => ( $seo_link ? \site\utils::make_seo_link( BLOG_INDEX_SLUG . '/' . BLOG_SINGLE_SLUG, $title, $url_title, $id, $extension ) : \site\utils::make_template_seo_link( BLOG_INDEX_SLUG . '/' . BLOG_SINGLE_SLUG, $title, $url_title, $id, $extension ) ), 'meta_title' => esc_html( $meta_title ), 'meta_keywords' => esc_html( $meta_keywords ), 'meta_description' => esc_html( $meta_desc ), 'last_update_by' => $last_update_by, 'last_update' => $last_update, 'date_time' => strtotime( $date ), 'date' => $date );

        }

        $stmt->close();

        return $data;

    }

}