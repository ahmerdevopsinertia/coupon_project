<?php

use plugin\Blog\inc as blog_inc;

// add( 'action', 'after_theme_functions_loaded', function() {

/* Define constants */

define( 'BLOG_INDEX_SLUG',  value_with_filter( 'blog_index_slug', \query\main::get_option( 'blog_index_slug' ) ) );
define( 'BLOG_SINGLE_SLUG', value_with_filter( 'blog_single_slug', \query\main::get_option( 'blog_single_slug' ) ) );
define( 'BLOG_DATE_FORMAT', value_with_filter( 'blog_date_format', \query\main::get_option( 'blog_date_format' ) ) );

/* Index Page */

add( 'theme-page', BLOG_INDEX_SLUG, function( $path ) {

    if( $path !== BLOG_INDEX_SLUG && $path !== 'index' ) {
        return false;
    }

    // add classes in body tag
    add( 'body-class', 'blog blog-index' );

    require_once 'inc/functions.php';

    /* Blog personalization - using own template */

    $def_params     = [];

    if( isset( $_GET['s'] ) ) {
        $def_params['search'] = $_GET['s'];
    }

    $params         = value_with_filter( 'blog_posts_params', $def_params );
    $results        = blog_inc\posts::have_posts( $params );
    $posts          = blog_inc\posts::fetch_posts( array_merge( $params, [ 'page' => $results['page'] ] ) );

    $use_template   = value_with_filter( 'blog_posts_template', theme_location( true ) . '/blog_templates/posts.php' );
    if( file_exists( $use_template ) ) {
        require_once $use_template;
    }

    else {

    /* Include required styles */                                           
    add( 'styles', site_url( UPDIR ) . '/Blog/assets/main.css', [ 'media' => 'all', 'rel' => 'stylesheet' ] );

    /* Declare language directory */
    add( 'translation', 'blog', UPDIR . '/Blog/languages/' ) ;

    if( ( $hero_bg = \query\main::get_option( 'blog_hero_image' ) ) && !empty( $hero_bg ) ) {
        if( !filter_var( $hero_bg, FILTER_VALIDATE_URL ) ) {
            $box_gallery = @json_decode( $hero_bg );
            if( $box_gallery ) {
                $hero_bg = site_url( current( $box_gallery ) );
            }
        }

        add( 'inline-style', '.blog-hero:before { background-image: url(\'' . esc_html( $hero_bg ) . '\'); }' );
    }

    do_action( 'blog_before_hero_outside' );

    echo '<div class="blog-hero">
    <div class="container">';

    do_action( 'blog_before_hero_inside' );

    echo '<h2>' . esc_html( ts( \query\main::get_option( 'blog_title' ) ) ) . '</h2>';

    do_action( 'blog_after_hero_inside' );

    echo '</div>
    </div>';

    do_action( 'blog_after_hero_outside' );

    do_action( 'blog_before_container_outside' );

    echo '<div class="container">';

    do_action( 'blog_before_container_inside' );

    if( $results['results'] ) {
        echo '<ul class="blog-posts">';
        foreach( $posts as $post ) {
            if( !filter_var( $post->image, FILTER_VALIDATE_URL ) ) {
                $image = @json_decode( $post->image );
                if( $image ) {
                    $post->image = site_url( current( $image ) );
                }
            }
            echo '<li class="blog-post">
                    <div class="blog-post-image" style="background-image: url(\'' . $post->image . '\');"><a href="' . $post->link . '"></a></div>
                    <div class="blog-post-info">';
                    $blog_date_format = BLOG_DATE_FORMAT;
                    if( !empty( $blog_date_format ) ) {
                        echo '<span class="blog-post-date">' . date( BLOG_DATE_FORMAT, $post->date_time ) . '</span>';
                    }
                    echo '</div>
                    <div class="blog-post-link">
                        <a href="' . $post->link . '">' . $post->title . '</a>
                    </div>
                </li>';
        }
        echo '</ul>';
    }

    do_action( 'blog_after_container_inside' );

    do_action( 'blog_index_before_pagination' );
    echo blog_pagination( $results );
    do_action( 'blog_index_after_pagination' );

    echo '</div>';

    do_action( 'blog_after_container_outside' );

    echo '<div class="blog-subscribe-form">
    <div class="container">';
    echo '<h3>' . t( 'blog_subscribe_title', 'Subscribe for the latest news and coupons' ) . '</h3>';
    echo newsletter_form( '_blog_form' );
    echo '</div>
    </div>';

    }

} );

/* Single Page */

add( 'theme-page', BLOG_INDEX_SLUG . '/' . BLOG_SINGLE_SLUG, function( $filename, $id, $path ) {

    if( !blog_inc\posts::exists( $idf = ( !empty( $id ) ? $id : $filename ) ) ) {
        return false;
    }

    require_once 'inc/functions.php';

    $post = blog_inc\posts::info( $idf );

    // add classes in body tag
    add( 'body-class', 'blog blog-single blog-post-' . $post->ID );

    // override the default meta title
    if( !empty( $post->meta_title ) ) {
        add( 'filter', [ 'site-title-tag', 'og-meta-title' ], function() use ( $post ) {
            return $post->meta_title;
        } );
    }

    // override the default meta description
    if( !empty( $post->meta_description ) ) {
        add( 'filter', [ 'meta-description', 'og-meta-description' ], function() use ( $post ) {
            return $post->meta_description;
        } );
    }

    // override the default meta keywords
    if( !empty( $post->meta_keywords ) ) {
        add( 'filter', 'meta-keywords', function() use ( $post ) {
            return $post->meta_keywords;
        } );
    }

    // override the default meta image
    if( !empty( $post->image ) ) {
        if( !filter_var( $post->image, FILTER_VALIDATE_URL ) ) {
            $post_image = @json_decode( $post->image );
            if( $post_image ) {
                $post->image = site_url( current( $post_image ) );
            }
        }
        add( 'filter', 'og-meta-image', function() use ( $post ) {
            return $post->image;
        } );
    }

    /* Blog personalization - using own template */

    $use_template   = value_with_filter( 'blog_post_template', theme_location( true ) . '/blog_templates/post.php' );

    if( file_exists( $use_template ) ) {
        require_once $use_template;
    }

    else {

    /* Include required styles */
    add( 'styles', site_url( UPDIR ) . '/Blog/assets/main.css', [ 'media' => 'all', 'rel' => 'stylesheet' ] );

    /* Declare language directory */
    add( 'translation', 'blog', UPDIR . '/Blog/languages/' ) ;

    if( ( $hero_bg = \query\main::get_option( 'blog_hero_image' ) ) && !empty( $hero_bg ) ) {
        if( !filter_var( $hero_bg, FILTER_VALIDATE_URL ) ) {
            $box_gallery = @json_decode( $hero_bg );
            if( $box_gallery ) {
                $hero_bg = site_url( current( $box_gallery ) );
            }
        }

        add( 'inline-style', '.blog-hero:before { background-image: url(\'' . esc_html( $hero_bg ) . '\'); }' );
    }

    do_action( 'blog_before_hero_outside' );

    echo '<div class="blog-hero">
    <div class="container">';

    do_action( 'blog_before_hero_inside' );

    echo '<h2>' . $post->title . '</h2>';

    do_action( 'blog_after_hero_inside' );

    echo '</div>
    </div>';

    do_action( 'blog_after_hero_outside' );

    do_action( 'blog_before_container_outside' );

    echo '<div class="container">';

    do_action( 'blog_before_container_inside' );

    echo '<div class="blog-post-single">
            <div class="blog-post-content">';
            do_action( 'blog_before_content_inside' );
            echo $post->content;
            do_action( 'blog_after_content_inside' );
            echo '</div>
        </div>';

    do_action( 'blog_after_content_outside' );

    echo '<ul class="blog-pagination blog-pagination-single">';
    if( $post->navigation->prev_exists() ) {
        $prev_post = $post->navigation->prev_post();
        echo '<li class="blog-nav-left-post"><a href="' . $prev_post->link . '">&laquo; ' . $prev_post->title . '</a></li>';
    }
    echo '<li class="blog-nav-all-posts"><a href="' . blog_link() . '">' . t( 'blog_all_posts', 'All Posts' ) . '</a></li>';
    if( $post->navigation->next_exists() ) {
        $next_post = $post->navigation->next_post();
        echo '<li class="blog-nav-next-post"><a href="' . $next_post->link . '">' . $next_post->title . ' &raquo;</a></li>';
    }
    echo '</ul>';

    do_action( 'blog_after_container_inside' );

    echo '</div>';

    do_action( 'blog_after_container_outside' );

    echo '<div class="blog-subscribe-form">
    <div class="container">';
    echo '<h3>' . t( 'blog_subscribe_title', 'Subscribe for the latest news and coupons' ) . '</h3>';
    echo newsletter_form( '_blog_form' );
    echo '</div>
    </div>';

    }

} );

/* Custom category for gallery */

add( 'filter', 'gallery-categories', function( $cats ) {

    $cats['blog'] = 'Blog';
    return $cats;

} );

// } );