<?php

/* DEFINE CONSTANTS */
define( 'THEME_LOCATION', theme_location() );
define( 'COUPONSCMS_CORE_LOCATION', theme_location2() . '/core' );

/* REQUIRED PARTS AND FUNCTIONS */
require_once 'core/theme_options.php';
require_once 'core/shortcodes.php';
require_once 'core/functions.php';
require_once 'extend/store.php';
require_once 'extend/product.php';
require_once 'extend/coupon.php';
require_once 'extend/review.php';
require_once 'extend/reward.php';
require_once 'extend/plans.php';
require_once 'extend/pagination.php';
require_once 'extend/menu.php';
require_once 'extras/banner_advertising.php';

/* ADD THEME STYLES */
add( 'styles', THEME_LOCATION . '/assets/css/bootstrap.min.css',        [ 'media' => 'all', 'rel' => 'stylesheet' ] );
add( 'styles', THEME_LOCATION . '/assets/css/fontawesome-all.min.css',  [ 'media' => 'all', 'rel' => 'stylesheet' ] );
add( 'styles', THEME_LOCATION . '/style.css',                           [ 'media' => 'all', 'rel' => 'stylesheet' ] );
add( 'styles', THEME_LOCATION . '/assets/css/couponscms.css',           [ 'media' => 'all', 'rel' => 'stylesheet' ] );
add( 'styles', THEME_LOCATION . '/assets/css/responsive.css',           [ 'media' => 'all', 'rel' => 'stylesheet' ] );
add( 'styles', THEME_LOCATION . '/assets/css/owl.carousel.min.css',     [ 'media' => 'all', 'rel' => 'stylesheet' ] );
add( 'styles', THEME_LOCATION . '/assets/css/rating.css',           [ 'media' => 'all', 'rel' => 'stylesheet' ] );
add( 'styles', '//fonts.googleapis.com/css?family=Quicksand:500,700',   [ 'rel' => 'stylesheet' ] );

/* ADD THEME SCRIPTS */
add( 'scripts', '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js' );
add( 'scripts', THEME_LOCATION . '/assets/js/functions.js' );
add( 'scripts', THEME_LOCATION . '/assets/js/ajax.js' );
add( 'scripts', THEME_LOCATION . '/assets/js/owl.carousel.min.js' );
add( 'scripts', THEME_LOCATION . '/assets/js/rating.js' );

/* USE OR DON'T USE REWARDS */
function theme_has_rewards() {
    return true;
}

/* LANGUAGES LOCATION */
function theme_languages_location() {
    return 'languages';
}

/* ADD THEME MENUS */
add( 'menu', 'main', 'theme_menu' );
add( 'menu', 'footer_company', 'theme_footer_company_menu' );

/* BUILD SITE'S MENU */
function theme_menu() {
    $links = [];

    $links['home'] = [ 'type' => 'home', 'name' => t( 'theme_home', 'Home' ) ];

    $links['coupons'] = [ 'name' => t( 'theme_nav_coupons', 'Coupons' ), 'url' => '#' ];
    $links['coupons']['links'][] = [ 'name' => t( 'theme_coupons_recently_added', 'Recently Added' ), 'url' => tlink( 'tpage/coupons', 'type=recent' ) ];
    $links['coupons']['links'][] = [ 'name' => t( 'theme_coupons_expiring_soon', 'Expiring Soon' ), 'url' => tlink( 'tpage/coupons', 'type=expiring' ) ];
    $links['coupons']['links'][] = [ 'name' => t( 'theme_coupons_printable', 'Printable' ), 'url' => tlink( 'tpage/coupons', 'type=printable' ) ];
    $links['coupons']['links'][] = [ 'name' => t( 'theme_coupons_codes', 'Coupon Codes' ), 'url' => tlink( 'tpage/coupons', 'type=codes' ) ];
    $links['coupons']['links'][] = [ 'name' => t( 'theme_coupons_exclusive', 'Exclusive' ), 'url' => tlink( 'tpage/coupons', 'type=exclusive' ) ];
    $links['coupons']['links'][] = [ 'name' => t( 'theme_coupons_popular', 'Popular' ), 'url' => tlink( 'tpage/coupons', 'type=popular' ) ];
    $links['coupons']['links'][] = [ 'name' => t( 'theme_coupons_verified', 'Verified' ), 'url' => tlink( 'tpage/coupons', 'type=verified' ) ];

    $links['stores'] = [ 'name' => t( 'theme_nav_stores', 'Stores' ), 'url' => tlink( 'stores' ) ];
    $links['stores']['links'][] = [ 'name' => t( 'theme_all_stores', 'All Stores' ), 'url' => tlink( 'stores' ) ];
    $links['stores']['links'][] = [ 'name' => t( 'theme_top_stores', 'Top Stores' ), 'url' => tlink( 'stores', 'type=top' ) ];
    $links['stores']['links'][] = [ 'name' => t( 'theme_most_voted', 'Most Voted' ), 'url' => tlink( 'stores', 'type=most-voted' ) ];
    $links['stores']['links'][] = [ 'name' => t( 'theme_popular', 'Popular' ), 'url' => tlink( 'stores', 'type=popular' ) ];

    $links['more'] = [ 'name' => t( 'theme_more', 'More' ), 'url' => '#' ];

    if( couponscms_has_products() ) {
        $products = [ 'name' => t( 'theme_nav_products', 'Products' ), 'url' => '#' ];
        $products['links'][] = [ 'name' => t( 'theme_products_recently_added', 'Recently Added' ), 'url' => tlink( 'tpage/products', 'type=recent' ) ];
        $products['links'][] = [ 'name' => t( 'theme_products_expiring_soon', 'Expiring Soon' ), 'url' => tlink( 'tpage/products', 'type=expiring' ) ];
        $products['links'][] = [ 'name' => t( 'theme_products_popular', 'Popular' ), 'url' => tlink( 'tpage/products', 'type=popular' ) ];
        $links['more']['links'][] = $products;
    }

    $categories = [ 'name' => t( 'theme_nav_categories', 'Categories' ), 'type' => 'categories', 'url' => '#' ];

    $links['more']['links'][] = $categories;

    return $links;
}

function theme_footer_company_menu() {

    $links = [];

    $links['home'] = [ 'type' => 'home', 'name' => t( 'theme_home', 'Home' ) ];

    return $links;

}

/* AJAX SEARCH */

add( 'ajax-call', 'slick_ajax_search', function() {
    $text = !empty( $_POST['text'] ) ? $_POST['text'] : '';
    if( strlen( $text ) < 2 ) return ;

    $coupons = $products = $stores = $categories = []; 

    foreach( items_custom( ['search' => $text, 'max' => 5] ) as $coupon ) {
        $coupons[] = '<li><a href="' . get_target_link( 'coupon', $coupon->ID, array( 'reveal_code' => true, 'backTo' => base64_encode( $coupon->store_link ) ) ) . '" target="_blank" data-target-on-click="' . get_target_link( 'coupon', $coupon->ID ) . '">' . ts( $coupon->title ) . '</a></li>';
    }
    if( couponscms_has_products() ) {
        foreach( products_custom( ['search' => $text, 'max' => 5] ) as $product ) {
            $products[] = '<li><a href="' .  get_target_link( 'product', $product->ID ) . '" target="_blank">' . ts( $product->title ) . '</a></li>';
        }
    }
    foreach( stores_custom( ['search' => $text, 'max' => 5] ) as $store ) {
        $stores[] = '<li><a href="' . $store->link . '">' . ts( $store->name ) . '</a></li>';
    }
    foreach( categories_custom( ['search' => $text, 'max' => 5] ) as $category ) {
        $categories[] = '<li><a href="' . $category->link . '">' . ts( $category->name ) . '</a></li>';
    }

    if( !empty( $coupons ) ) {
        echo '<h6>' . t( 'coupons', 'Coupons' ) . '</h6>';
        echo '<ul>' . implode( "\n", $coupons );
    }
    if( !empty( $products ) ) {
        echo '<h6>' . t( 'products', 'Products' ) . '</h6>';
        echo '<ul>' . implode( "\n", $products );
    }
    if( !empty( $stores ) ) {
        echo '<h6>' . t( 'stores', 'Stores' ) . '</h6>';
        echo '<ul>' . implode( "\n", $stores );
    }
    if( !empty( $categories ) ) {
        echo '<h6>' . t( 'categories', 'Categories' ) . '</h6>';
        echo '<ul>' . implode( "\n", $categories );
    }
});

/* APPLY OPTIONS */
if( ( $search_box_bg = get_theme_option( 'search_image' ) ) && !empty( $search_box_bg ) ) {
    if( !filter_var( $search_box_bg, FILTER_VALIDATE_URL ) ) {
        $search_box_gallery = @json_decode( $search_box_bg ); 
        if( $search_box_gallery ) {
            $search_box_bg = current( $search_box_gallery );
        }
    }
    add( 'inline-style', '.search-container:not(.fixed-popup)::after {background-image:url("' . $search_box_bg . '")}' );
}

/* ADD EXTRA CSS */
add( 'in-head', add_extra_css() );

function add_extra_css() {
    if( ( $ecss = get_theme_option( 'extra_css' ) ) ) {
        return "<style>\n" . $ecss . "\n</style>";
    }
}

/* ADD EXTRA JS */
add( 'in-head', add_extra_js() );

function add_extra_js() {
    if( ( $ejs = get_theme_option( 'extra_js' ) ) ) {
        return "<script>" . $ejs . "\n</script>";
    }
}

/* BANNER ADVERISING PLUGIN */
add( 'action', 'banner-advertising-page', 'banner_advertising_order_page' );

/* CATEGORY EXTRA FIELDS */
add( 'category-fields', [ 'position' => 3.1, 'fields' => [ 'icon' => [ 'type' => 'text', 'title' => t( 'theme_category_input_icon', 'Icon', true ), 'info' => t( 'theme_category_input_icon', 'Font-awesome icons.', true ) ] ] ] );