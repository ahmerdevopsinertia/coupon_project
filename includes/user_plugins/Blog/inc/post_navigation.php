<?php

namespace plugin\Blog\inc;

class post_navigation {

    function __construct( $post_id, $post_date ) {
        $this->post_id  = $post_id;
        $this->post_date= $post_date;
    }

    /* CHECK IF THE NEXT POST EXISTS */

    public function next_exists() {

        global $db;

        $stmt = $db->stmt_init();
        $stmt->prepare( "SELECT COUNT(*) FROM " . DB_TABLE_PREFIX . "blog_posts WHERE lang = ? AND visible = 1 AND date > ? AND date <= NOW()" );

        $lang =  \site\utils::dbp( current_language()['id'] );

        $stmt->bind_param( "ss", $lang, $this->post_date );
        $stmt->execute();
        $stmt->bind_result( $count );
        $stmt->fetch();
        $stmt->close();

        if( $count > 0 ) {
            return true;
        }

        return false;

    }

    /* GET INFORMATION ABOUT THE NEXT POST */

    public function next_post() {

        global $db;

        $stmt = $db->stmt_init();
        $stmt->prepare( "SELECT id, user, title, text, image, lang, visible, url_title, lastupdate_by, lastupdate, date FROM " . DB_TABLE_PREFIX . "blog_posts WHERE lang = ? AND visible = 1 AND date > ? AND date <= NOW() ORDER BY date LIMIT 1" );

        $lang =  \site\utils::dbp( current_language()['id'] );

        $stmt->bind_param( "ss", $lang, $this->post_date );
        $stmt->execute();
        $stmt->bind_result( $id, $user, $title, $text, $image, $language, $visible, $url_title, $last_update_by, $last_update, $date );
        $stmt->fetch();
        $stmt->close();

        return (object) array( 'ID' => $id, 'user' => $user, 'title' =>  $title, 'text' => $text, 'content' => \site\content::content( 'blog_text', nl2br( $text ) ), 'image' => ( !empty( $image ) ? ( !filter_var( $image, FILTER_VALIDATE_URL ) ? $GLOBALS['siteURL'] . esc_html( $image ) : esc_html( $image ) ) : '' ), 'language' => esc_html( $language ), 'url_title' => $url_title, 'is_visible' => $visible, 'link' => ( defined( 'SEO_LINKS' ) && SEO_LINKS ? \site\utils::make_seo_link( BLOG_INDEX_SLUG . '/' . BLOG_SINGLE_SLUG, $title, $url_title, $id, \query\main::get_option( 'extension' ) ) : \site\utils::make_template_seo_link( BLOG_INDEX_SLUG . '/' . BLOG_SINGLE_SLUG, $title, $url_title, $id, \query\main::get_option( 'extension' ) ) ), 'last_update_by' => $last_update_by, 'last_update' => $last_update, 'date_time' => strtotime( $date ), 'date' => $date );

    }

    /* CHECK IF THE PREVIOUS POST EXISTS */

    public function prev_exists() {

        global $db;

        $stmt = $db->stmt_init();
        $stmt->prepare( "SELECT COUNT(*) FROM " . DB_TABLE_PREFIX . "blog_posts WHERE lang = ? AND visible = 1 AND date < ? AND date <= NOW()" );

        $lang =  \site\utils::dbp( current_language()['id'] );

        $stmt->bind_param( "ss", $lang, $this->post_date );
        $stmt->execute();
        $stmt->bind_result( $count );
        $stmt->fetch();
        $stmt->close();

        if( $count > 0 ) {
            return true;
        }

        return false;

    }

    /* GET INFORMATION ABOUT THE PREVIOUS POST */

    public function prev_post() {

        global $db;

        $stmt = $db->stmt_init();
        $stmt->prepare( "SELECT id, user, title, text, image, lang, visible, url_title, lastupdate_by, lastupdate, date FROM " . DB_TABLE_PREFIX . "blog_posts WHERE lang = ? AND visible = 1 AND date < ? AND date <= NOW() ORDER BY date DESC LIMIT 1" );

        $lang =  \site\utils::dbp( current_language()['id'] );

        $stmt->bind_param( "ss", $lang, $this->post_date );
        $stmt->execute();
        $stmt->bind_result( $id, $user, $title, $text, $image, $language, $visible, $url_title, $last_update_by, $last_update, $date );
        $stmt->fetch();
        $stmt->close();

        return (object) array( 'ID' => $id, 'user' => $user, 'title' =>  $title, 'text' => $text, 'content' => \site\content::content( 'blog_text', nl2br( $text ) ), 'image' => ( !empty( $image ) ? ( !filter_var( $image, FILTER_VALIDATE_URL ) ? $GLOBALS['siteURL'] . esc_html( $image ) : esc_html( $image ) ) : '' ), 'language' => esc_html( $language ), 'url_title' => $url_title, 'is_visible' => $visible, 'link' => ( defined( 'SEO_LINKS' ) && SEO_LINKS ? \site\utils::make_seo_link( BLOG_INDEX_SLUG . '/' . BLOG_SINGLE_SLUG, $title, $url_title, $id, \query\main::get_option( 'extension' ) ) : \site\utils::make_template_seo_link( BLOG_INDEX_SLUG . '/' . BLOG_SINGLE_SLUG, $title, $url_title, $id, \query\main::get_option( 'extension' ) ) ), 'last_update_by' => $last_update_by, 'last_update' => $last_update, 'date_time' => strtotime( $date ), 'date' => $date );

    }

}