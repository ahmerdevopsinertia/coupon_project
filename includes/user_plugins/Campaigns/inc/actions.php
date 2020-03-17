<?php

namespace plugin\Campaigns\inc;

class actions {

    /* ADD CAMPAIGN */

    public static function add( $opt = array() ) {

        global $db;

        $opt = \site\utils::array_map_recursive( 'trim', $opt );

        $stmt = $db->stmt_init();
        $stmt->prepare( "INSERT INTO " . DB_TABLE_PREFIX . "campaigns (user, title, coupons, products, image, visible, meta_title, meta_keywords, meta_desc, lastupdate_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)" );
        $stmt->bind_param( "isiisisssi", $GLOBALS['me']->ID, $opt['title'], $opt['accept_coupons'], $opt['accept_products'], $opt['image'], $opt['publish'], $opt['meta_title'], $opt['meta_keywords'], $opt['meta_desc'], $GLOBALS['me']->ID );
        $execute = $stmt->execute();
        $insert_id = $stmt->insert_id;

        if( $execute ) {
            return $insert_id;
        }

        return false;

    }

    /* UPDATE CAMPAIGN */

    public static function update( $opt = array(), $id = 0 ) {

        global $db;

        $id = empty( $id ) && !empty( $_GET['id'] ) ? $_GET['id'] : $id;

        if( empty( $id ) ) {
            return false;
        }

        $opt = \site\utils::array_map_recursive( 'trim', $opt );

        $stmt = $db->stmt_init();
        $stmt->prepare( "UPDATE " . DB_TABLE_PREFIX . "campaigns SET title = ?, image = ?, coupons = ?, products = ?, visible = ?, meta_title = ?, meta_keywords = ?, meta_desc = ?, lastupdate_by = ?, lastupdate = NOW() WHERE id = ?" );
        $stmt->bind_param( "ssiiisssii", $opt['title'], $opt['image'], $opt['accept_coupons'], $opt['accept_products'], $opt['publish'], $opt['meta_title'], $opt['meta_keywords'], $opt['meta_desc'], $GLOBALS['me']->ID, $id );
        $execute = $stmt->execute();
        $stmt->close();

        if( $execute ) {
            return true;
        }

        $stmt->close();

        return false;

    }

    /* DELETE CAMPAIGN */

    public static function delete( $id ) {

        global $db;

        $id = (array) $id;

        $stmt = $db->stmt_init();

        foreach( $id as $ID ) {

            if( \plugin\Campaigns\inc\campaigns::exists( $ID ) ) {

                $info = \plugin\Campaigns\inc\campaigns::info( $ID );

                $stmt->prepare( "DELETE FROM " . DB_TABLE_PREFIX . "campaigns WHERE id = ?" );
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

    /* EDIT CAMPAIGN URL */

    public static function edit_url( $id, $opt = array() ) {

        global $db;

        $opt = array_map( 'trim', $opt );

        if( !isset( $opt['title'] ) ) {
            return false;
        }

        $url = strtolower( \site\utils::encodeurl( $opt['title'] ) );

        $stmt = $db->stmt_init();

        $stmt->prepare( "SELECT COUNT(*) FROM " . DB_TABLE_PREFIX . "campaigns WHERE id != ? AND url_title = ?" );
        $stmt->bind_param( "is", $id, $url );
        $stmt->execute();
        $stmt->bind_result( $count );
        $stmt->fetch();

        if( $count > 0 ) {
            return false;
        }

        $stmt->prepare( "UPDATE " . DB_TABLE_PREFIX . "campaigns SET url_title = ? WHERE id = ?" );
        $stmt->bind_param( "si", $url, $id );
        $execute = $stmt->execute();
        $stmt->close();

        if( $execute ) {
            return true;
        }

        return false;

    }

    /* SET ACTION TO CAMPAIGN */

    public static function action( $action, $id ) {

        global $db;

        $id = (array) $id;

        $stmt = $db->stmt_init();

        switch( $action ) {
            case 'publish':
                $stmt->prepare( "UPDATE " . DB_TABLE_PREFIX . "campaigns SET visible = 1 WHERE id = ?" );
            break;

            case 'unpublish':
                $stmt->prepare( "UPDATE " . DB_TABLE_PREFIX . "campaigns SET visible = 0 WHERE id = ?" );
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

    /* ADD COUPONS */

    public static function add_coupons( $campaign, $coupons ) {

        if( !is_array( $coupons ) ) {
            return false;
        }

        global $db;

        $stmt = $db->stmt_init();
        $stmt->prepare( "UPDATE " . DB_TABLE_PREFIX . "coupons SET campaign = ? WHERE id = ?" );

        foreach( array_filter( $coupons ) as $ID ) {
            $stmt->bind_param( "ii", $campaign, $ID );
            $stmt->execute();
        }

        $stmt->close();

        return true;

    }

    /* ADD PRODUCTS */

    public static function add_products( $campaign, $products ) {

        if( !is_array( $products ) ) {
            return false;
        }

        global $db;

        $stmt = $db->stmt_init();
        $stmt->prepare( "UPDATE " . DB_TABLE_PREFIX . "products SET campaign = ? WHERE id = ?" );

        foreach( array_filter( $products ) as $ID ) {
            $stmt->bind_param( "ii", $campaign, $ID );
            $stmt->execute();
        }

        $stmt->close();

        return true;

    }    

}