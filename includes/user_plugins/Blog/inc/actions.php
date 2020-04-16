<?php

namespace plugin\Blog\inc;

class actions {

    /* ADD POST */

    public static function add( $opt = array() ) {

        global $db;

        $opt = \site\utils::array_map_recursive( 'trim', $opt );

        $stmt = $db->stmt_init();
        $stmt->prepare( "INSERT INTO " . DB_TABLE_PREFIX . "blog_posts (user, title, text, image, lang, visible, meta_title, meta_keywords, meta_desc, lastupdate_by, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)" );
        $stmt->bind_param( "issssisssis", $GLOBALS['me']->ID, $opt['title'], $opt['text'], $opt['image'], $opt['language'], $opt['publish'], $opt['meta_title'], $opt['meta_keywords'], $opt['meta_desc'], $GLOBALS['me']->ID, $opt['publish_date'] );
        $execute = $stmt->execute();
        $insert_id = $stmt->insert_id;

        if( $execute ) {
            return $insert_id;
        }

        return false;

    }

    /* UPDATE POST */

    public static function update( $opt = array(), $id = 0 ) {

        global $db;

        $id = empty( $id ) && !empty( $_GET['id'] ) ? $_GET['id'] : $id;

        if( empty( $id ) ) {
            return false;
        }

        $opt = \site\utils::array_map_recursive( 'trim', $opt );

        $post = \plugin\Blog\inc\posts::info( $id );

        $stmt = $db->stmt_init();
        $stmt->prepare( "UPDATE " . DB_TABLE_PREFIX . "blog_posts SET title = ?, text = ?, image = ?, lang = ?, visible = ?, meta_title = ?, meta_keywords = ?, meta_desc = ?, lastupdate_by = ?, lastupdate = NOW(), date = ? WHERE id = ?" );
        $stmt->bind_param( "ssssisssisi", $opt['title'], $opt['text'], $opt['image'], $opt['language'], $opt['publish'], $opt['meta_title'], $opt['meta_keywords'], $opt['meta_desc'], $GLOBALS['me']->ID, $opt['publish_date'], $id );
        $execute = $stmt->execute();
        $stmt->close();

        if( $execute ) {
            return true;
        }

        $stmt->close();

        return false;

    }

    /* DELETE POST */

    public static function delete( $id ) {

        global $db;

        $id = (array) $id;

        $stmt = $db->stmt_init();

        foreach( $id as $ID ) {

            if( \plugin\Blog\inc\posts::exists( $ID ) ) {

                $info = \plugin\Blog\inc\posts::info( $ID );

                $stmt->prepare( "DELETE FROM " . DB_TABLE_PREFIX . "blog_posts WHERE id = ?" );
                $stmt->bind_param( "i", $ID );

                if( $stmt->execute() ) {
                    if( !empty( $info->image ) && !preg_match( '/^http(s)?/i', $info->image )    ) {
                        @unlink( DIR . '/' . $info->image );
                    }
                }

            }

        }

        @$stmt->close();

        return true;

    }

    /* EDIT POST URL */

    public static function edit_url( $id, $opt = array() ) {

        global $db;

        $opt = array_map( 'trim', $opt );

        if( !isset( $opt['title'] ) ) {
            return false;
        }

        $url = strtolower( \site\utils::encodeurl( $opt['title'] ) );

        $stmt = $db->stmt_init();

        $stmt->prepare( "SELECT COUNT(*) FROM " . DB_TABLE_PREFIX . "blog_posts WHERE id != ? AND url_title = ?" );
        $stmt->bind_param( "is", $id, $url );
        $stmt->execute();
        $stmt->bind_result( $count );
        $stmt->fetch();

        if( $count > 0 ) {
            return false;
        }

        $stmt->prepare( "UPDATE " . DB_TABLE_PREFIX . "blog_posts SET url_title = ? WHERE id = ?" );
        $stmt->bind_param( "si", $url, $id );
        $execute = $stmt->execute();
        $stmt->close();

        if( $execute ) {
            return true;
        }

        return false;

    }

    /* SET ACTION TO POST */

    public static function action( $action, $id ) {

        global $db;

        $id = (array) $id;

        $stmt = $db->stmt_init();

        switch( $action ) {
            case 'publish':
                $stmt->prepare( "UPDATE " . DB_TABLE_PREFIX . "blog_posts SET visible = 1 WHERE id = ?" );
            break;

            case 'unpublish':
                $stmt->prepare( "UPDATE " . DB_TABLE_PREFIX . "blog_posts SET visible = 0 WHERE id = ?" );
            break;

            default:
                return false;
            break;
        }

        foreach( $id as $ID ) {
            $stmt->bind_param( "i", $ID );
            $stmt->execute();
        }

        $stmt->close();

        return true;

    }

}