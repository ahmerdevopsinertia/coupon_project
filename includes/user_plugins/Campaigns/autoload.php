<?php

use plugin\Campaigns\inc as campaigns_inc;

// add( 'action', 'after_theme_functions_loaded', function() {

/* Define constants */

define( 'CAMPAIGNS_SLUG',  value_with_filter( 'campaigns_index_slug', \query\main::get_option( 'campaigns_slug' ) ) );

/* Campaign Page */

add( 'theme-page', CAMPAIGNS_SLUG, function( $filename, $id, $path ) {

    if( !campaigns_inc\campaigns::exists( $idf = ( !empty( $id ) ? $id : $filename ) ) ) {
        return false;
    }

    $campaign = campaigns_inc\campaigns::info( $idf );

    // add classes in body tag
    add( 'body-class', 'campaigns campaign-single campaign-' . $campaign->ID );

    // override the default meta title
    if( !empty( $campaign->meta_title ) ) {
        add( 'filter', [ 'site-title-tag', 'og-meta-title' ], function() use ( $campaign ) {
            return $campaign->meta_title;
        } );
    }

    // override the default meta description
    if( !empty( $campaign->meta_description ) ) {
        add( 'filter', [ 'meta-description', 'og-meta-description' ], function() use ( $campaign ) {
            return $campaign->meta_description;
        } );
    }

    // override the default meta keywords
    if( !empty( $campaign->meta_keywords ) ) {
        add( 'filter', 'meta-keywords', function() use ( $campaign ) {
            return $campaign->meta_keywords;
        } );
    }

    // override the default meta image
    if( !empty( $campaign->image ) ) {
        if( !filter_var( $campaign->image, FILTER_VALIDATE_URL ) ) {
            $campaign_image = @json_decode( $campaign->image );
            if( $campaign_image ) {
                $campaign->image = site_url( current( $campaign_image ) );
            }
        }
        add( 'filter', 'og-meta-image', function() use ( $campaign ) {
            return $campaign->image;
        } );
    }

    add( 'filter', 'items_where_clause', function( $where ) use ( $campaign ) {
        $where['current_campaign'] = 'c.campaign = ' . (int) $campaign->ID;
        return $where;
    } );

    add( 'filter', 'products_where_clause', function( $where ) use ( $campaign ) {
        $where['current_campaign'] = 'p.campaign = ' . (int) $campaign->ID;
        return $where;
    } );

    $type = isset( $_GET['type'] ) && $_GET['type'] === 'products' ? 'products' : 'coupons';
    $types              = [];
    if( $campaign->accept_coupons ) {
        $types['coupons']   = [ 'label' => t( 'coupons', 'Coupons' ), 'url' => get_update( [ 'type' => 'coupons' ], get_remove( [ 'page', 'type' ] ) ) ];
    }
    if( $campaign->accept_products ) {
        if( !$campaign->accept_coupons ) $type = 'products';
        $types['products'] = [ 'label' => t( 'products', 'Products' ), 'url' => get_update( [ 'type' => 'products' ], get_remove( [ 'page', 'type' ] ) ) ];
    }

    /* Campaigns personalization - using own template */

    $use_template   = value_with_filter( 'campaign_template', theme_location( true ) . '/campaigns_templates/campaign.php' );

    if( file_exists( $use_template ) ) {
        require_once $use_template;
    }

    else {

    /* Include required styles */
    add( 'styles', site_url( UPDIR ) . '/Campaigns/assets/main.css', [ 'media' => 'all', 'rel' => 'stylesheet' ] );

    /* Declare language directory */
    add( 'translation', 'campaigns', UPDIR . '/Campaigns/languages/' ) ;

    if( !empty( $campaign->image ) ) {
        add( 'inline-style', '.campaigns-hero:before { background-image: url(\'' . esc_html( $campaign->image ) . '\'); }' );
    }

    do_action( 'campaigns_before_hero_outside' );

    echo '<div class="campaigns-hero">
    <div class="container">';

    do_action( 'campaigns_before_hero_inside' );

    echo '<h2>' . ts( $campaign->title ) . '</h2>';

    do_action( 'campaigns_after_hero_inside' );

    echo '</div>
    </div>';

    do_action( 'campaigns_after_hero_outside' );

    do_action( 'campaigns_before_container_outside' );

    echo '<div class="container pt50 pb50">';

    do_action( 'campaigns_before_container_inside' );

    if( count( $types ) > 1 ) {
    echo '<div class="row mb15">
    <div class="col-md-8 offset-md-2">
    <ul class="button-set">';
    foreach( $types as $type_id => $type_nav ) {
        echo '<li' . ( $type_id == $type ? ' class="selected"' : '' ) . '><a href="' . $type_nav['url'] . '">' . $type_nav['label'] . '</a></li>';
    }
    echo '</ul>
    </div>
    </div>'; 
    } 
    
    if( $type === 'products' ) {

    if( ( $pagination = have_products_custom( [ 'show' => 'current_campaign', 'per_page' => ( $items_per_page = \query\main::get_option( 'campaigns_items_per_page' ) ) ] ) ) && $pagination['results'] ) { ?>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?php foreach( products_custom( [ 'show' => 'current_campaign', 'per_page' => $items_per_page, 'page' => $pagination['page'] ] ) as $item ) {
                    echo couponscms_product_item( $item );
                }

                echo couponscms_theme_pagination( $pagination ) ?>
            </div>
        </div>

    <?php }

    } else {

    if( ( $pagination = have_items_custom( [ 'show' => 'current_campaign', 'per_page' => ( $items_per_page = \query\main::get_option( 'campaigns_items_per_page' ) ) ] ) ) && $pagination['results'] ) { ?>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?php foreach( items_custom( [ 'show' => 'current_campaign', 'per_page' => $items_per_page, 'page' => $pagination['page'] ] ) as $item ) {
                    echo couponscms_coupon_item( $item );
                }

                echo couponscms_theme_pagination( $pagination ); ?>
            </div>
        </div>

    <?php }

    } ?>

    <?php do_action( 'campaigns_after_container_inside' );

    echo '</div>';

    do_action( 'campaigns_after_container_outside' );

    }

} );

/* Custom category for gallery */

add( 'filter', 'gallery-categories', function( $cats ) {

    $cats['campaigns'] = 'Campaigns';
    return $cats;

} );

/* Add coupon fields label */

$coupon_extra_fields                = [];
$coupon_extra_fields['campaign']    = [ 'section' => 'Campaign', 'section_id' => 'campaign', 'title' => 'Add coupon to', 'type' => 'select', 'options' => array_merge( [ 0 => 'Select a campaign' ], \plugin\Campaigns\inc\campaigns::fetch_campaigns_accept_coupons() ) ];
add( 'coupon-fields', [ 'position' => 1, 'fields' => $coupon_extra_fields ] );

/* Add product fields label */

$product_extra_fields               = [];
$product_extra_fields['campaign']   = [ 'section' => 'Campaign', 'section_id' => 'campaign', 'title' => 'Add product to', 'type' => 'select', 'options' => array_merge( [ 0 => 'Select a campaign' ], \plugin\Campaigns\inc\campaigns::fetch_campaigns_accept_products() ) ];
add( 'product-fields', [ 'position' => 1, 'fields' => $product_extra_fields ] );

/* Saving the campaign */

add( 'action', 'admin_coupon_added_edited', function( $id ) {
    if( isset( $_POST['extra']['campaign'] ) ) {
        global $db;
        $stmt = $db->stmt_init();
        $stmt->prepare( "UPDATE " . DB_TABLE_PREFIX . "coupons SET campaign = ? WHERE id = ?" );
        $stmt->bind_param( "ii", $_POST['extra']['campaign'], $id );
        $stmt->execute();
        $stmt->close();
    }
} );

add( 'action', 'admin_product_added_edited', function( $id ) {
    if( isset( $_POST['extra']['campaign'] ) ) {
        global $db;
        $stmt = $db->stmt_init();
        $stmt->prepare( "UPDATE " . DB_TABLE_PREFIX . "products SET campaign = ? WHERE id = ?" );
        $stmt->bind_param( "ii", $_POST['extra']['campaign'], $id );
        $stmt->execute();
        $stmt->close();
    }
} );

add( 'filter', 'admin_view_items_args', function( $where ) {
    if( isset( $_GET['campaign'] ) ) {
        add( 'filter', 'items_where_clause', function( $where ) {
            $where['current_campaign'] = 'c.campaign = ' . (int) $_GET['campaign'];
            return $where;
        } );

        add( 'filter', 'admin_items_list_reset_view', function() {
            return true;
        } );

        $where['show'] = 'current_campaign';
    }

    return $where;
} );

add( 'filter', 'admin_view_products_args', function( $where ) {
    if( isset( $_GET['campaign'] ) ) {
        add( 'filter', 'products_where_clause', function( $where ) {
            $where['current_campaign'] = 'p.campaign = ' . (int) $_GET['campaign'];
            return $where;
        } );

        add( 'filter', 'admin_products_list_reset_view', function() {
            return true;
        } );

        $where['show'] = 'current_campaign';
    }

    return $where;
} );

// } );