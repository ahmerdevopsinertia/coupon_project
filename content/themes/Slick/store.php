<?php

$store = the_item();

$atts = [];

$default_orderby = 'newest';
$orderby_attr = 'date desc';

if( !empty( $_GET['orderby'] ) ) {

    $orderby = [ 'newest' => 'date desc', 'oldest' => 'date' ];

    if( in_array( $_GET['orderby'], array_keys( $orderby ) ) ) {
        $default_orderby = $_GET['orderby'];
    }

    $orderby_attr = $orderby[$default_orderby];

}

$active = [ 1, '<i class="far fa-circle"></i>'];

if( !empty( $_GET['active'] ) ) {
    $active = [ 0, '<i class="fas fa-check-circle"></i>' ];
    $atts['show'] = 'active';
}

$type = searched_type(); ?>

<div class="bgGray">
    <div class="hero-title">
        <div class="container">
            <h2><?php tse( $store->name ); ?></h2>
        </div>
    </div>
</div>

<div class="pt-75 pb-75 hr-bottom clearfix">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="store-logo text-center">
                    <img src="<?php echo store_avatar( ( !empty( $store->image ) ? $store->image : '' ) ); ?>" alt="<?php tse( $store->name ); ?>" />
                    <a href="<?php echo $store->reviews_link; ?>"><?php echo couponscms_rating( (int) $store->stars, $store->reviews ); ?></a>
                </div>
                <div class="button-set">
                    <a href="#" class="button big" data-ajax-call="<?php echo ajax_call_url( "favorite" ); ?>" data-data='<?php echo json_encode( array( 'store' => $store->ID, 'added_message' => '<i class="fa fa-heart"></i> ' . t( 'theme_remove_favorite', 'Remove favorite' ), 'removed_message' => '<i class="far fa-heart"></i> ' . t( 'theme_add_favorite', 'Add favorite' ) ) ); ?>'><?php echo ( is_favorite( $store->ID ) ? '<i class="fa fa-heart"></i> ' . t( 'theme_remove_favorite', 'Remove favorite' ) : '<i class="far fa-heart"></i> ' . t( 'theme_add_favorite', 'Add favorite' ) ); ?></a>
                    <a href="#" class="button big" data-ajax-call="<?php echo ajax_call_url( "save" ); ?>" data-data='<?php echo json_encode( array( 'item' => $store->ID, 'type' => 'store', 'added_message' => '<i class="fa fa-star"></i> ' . t( 'theme_unsave_store', 'Unsave this store' ), 'removed_message' => '<i class="far fa-star"></i> ' . t( 'theme_save_store', 'Save this store' ) ) ); ?>'><?php echo ( is_saved( $store->ID, 'store' ) ? '<i class="fa fa-star"></i> ' . t( 'theme_unsave_store', 'Unsave this store' ) : '<i class="far fa-star"></i> ' . t( 'theme_save_store', 'Save this store' ) ); ?></a>
                    <a href="<?php echo tlink( 'plugin/rss2', 'store=' . $store->ID ); ?>" class="button big"><i class="fa fa-rss"></i> <?php te( 'theme_store_rss', 'RSS Feed' ); ?></a>
                    <a href="<?php echo $store->reviews_link; ?>" class="button big"><i class="fa fa-pencil-alt"></i> <?php te( 'theme_write_review', 'Write Review' ); ?></a>
                    <?php if( !empty( $store->url ) ) { ?>
                    <a href="<?php echo get_target_link( 'store', $store->ID ); ?>" class="button big"><i class="fa fa-link"></i> <?php te( 'theme_store_visit', 'Visit Website' ); ?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 offset-lg-1 m-mt-30">
            <h6><?php te( 'theme_t_s_description', 'Description' ); ?></h6>
            <?php echo ( !empty( $store->description ) ? ts( $store->description ) : t( 'theme_no_description', 'No description.' ) );
            if( $store->is_physical ) {
                echo '<ul class="store-info-list">';
                if( !empty( $store->hours ) ) {
                    $today = strtolower( date( 'l' ) );
                    echo '<li><a href="#" class="hours"><h6><i class="far fa-clock"></i> ' . sprintf( t( 'theme_store_hours_today', 'Hours ( Today: %s )' ), ( isset( $store->hours[$today]['opened'] ) ? $store->hours[$today]['from'] . ' - ' . $store->hours[$today]['to'] : t( 'theme_store_closed', 'Closed' ) ) ) . '</a></h6>';
                    $daysofweek = days_of_week();
                    echo '<ul class="store-hours">';
                    foreach( $daysofweek as $day => $dayn ) {
                        echo '<li' . ( $day === $today ? ' class=\'htoday\'' : '' ) . '><span>' . $dayn . ':</span> <b>' . ( isset( $store->hours[$day]['opened'] ) ? $store->hours[$day]['from'] . ' - ' . $store->hours[$day]['to'] : t( 'theme_store_closed', 'Closed' ) ) . '</b></li>';
                    }
                    echo '</ul>
                    </li>';
                }
                if( !empty( $store->phone_no ) ) {
                    echo '<li><h6><i class="fa fa-phone"></i> ' . t( 'theme_phone_no', 'Phone Number' ) . '</h6>' . $store->phone_no . '</li>';
                }
                $locations = store_locations( $store->ID );
                if( !empty( $locations ) ) {
                    echo '<li><h6><i class="fas fa-map-marker-alt"></i> ' . t( 'theme_t_s_locations', 'Locations' ) . '</h6><ul class="store-locations">';
                    foreach( $locations as $location ) {
                        echo '<li data-lat="' . $location->lat . '" data-lng="' . $location->lng . '" data-title="' . implode( ', ', array( $location->city, $location->state ) ) . '" data-content="' . implode( ', ', array( $location->address, $location->zip ) ) . '">
                            <a href="#" data-map-recenter="' . $location->lat . ',' . $location->lng . '">' . implode( ', ', array( $location->address, $location->zip, $location->city, $location->state, $location->country ) ) . '</a> <a href="//www.google.com/maps?saddr=My+Location&daddr=' . implode( ',', [$location->lat, $location->lng] ) . '" class="get-direction" target="_blank"><i class="fas fa-walking"></i> ' . t( 'theme_get_directions', 'Get directions' ) . '</a>
                        </li>';
                    }
                    echo '</ul>';
                }
                if( google_maps() && !empty( $locations ) ) {
                $map_zoom = get_theme_option( 'map_zoom' );
                $map_marker_icon = get_theme_option( 'map_marker_icon' ); ?>
                <li id="map_wrapper">
                    <div id="map_canvas" data-zoom="<?php echo ( !empty( $map_zoom ) && is_numeric( $map_zoom ) ? (int) $map_zoom : 16 ); ?>" data-lat="<?php echo $locations[0]->lat; ?>" data-lng="<?php echo $locations[0]->lng; ?>" data-marker-icon="<?php echo ( !empty( $map_marker_icon ) ? $map_marker_icon : THEME_LOCATION . '/assets/img/pin.png' ); ?>"></div>
                </li>
                <?php }
                echo '</ul>';
            } ?>
            </div>
        </div>
    </div>
</div>

<div class="bgGray pt-75 pb-75 clearfix">
    <div class="container">
        <?php echo do_action( 'store_before_items' ); ?>

        <div class="mb-40 clearfix">
            <?php $types = array();
            $types['coupons'] = array( 'label' => t( 'coupons', 'Coupons' ), 'url' => get_update( array( 'type' => 'coupons' ), get_remove( array( 'page', 'type' ) ) ) );
            if( couponscms_has_products() ) {
                $types['products'] = array( 'label' => t( 'products', 'Products' ), 'url' => get_update( array( 'type' => 'products' ), get_remove( array( 'page', 'type' ) ) ) );
            } ?>
            <ul class="options float-left">
                <li class="contains-sub-menu pb-10"><a href="#"><?php echo $types[$type]['label']; ?> <i class="fa fa-angle-down"></i></a>
                    <ul>
                    <?php foreach( $types as $cur_type => $type2 ) {
                        echo '<li' . ( $cur_type == $type ? ' class="active"' : '' ) . '><a href="' . $type2['url'] . '">' . $type2['label'] . '</a></li>';
                    } ?>
                    </ul>
                </li>
            </ul>
            <a href="<?php echo get_update( [ 'active' => $active[0] ], get_remove( [ 'page' ] ) ); ?>" class="float-right"><?php echo $active[1] . ' ' . t( 'theme_active_only', 'Active only' ); ?></a>
        </div>

        <?php if( $type === 'products' ) {

            if( ( $results = have_products( array( 'show' => ( !empty( $atts ) ? implode( ',', $atts ) : '' ) ) ) ) && $results['results'] ) {
                echo '<div class="list clearfix">';
                foreach( products( array( 'show' => ( !empty( $atts ) ? implode( ',', $atts ) : '' ), 'orderby' => $orderby_attr ) ) as $item ) {
                    echo couponscms_product_item( $item );
                }
                echo '</div>';
            } else {
                echo '<div class="alert">' . sprintf( t( 'theme_no_products_store',  '%s has no products yet.' ), ts( $store->name ) ) . '</div>';
                echo '<div class="list clearfix">';
                foreach( products_custom( array( 'show' => 'visible,active', 'orderby' => 'rand', 'max' => option( 'items_per_page' ) ) ) as $item ) {
                    echo couponscms_product_item( $item );
                }
                echo '</div>';
            }

        } else {

            if( ( $results = have_items( array( 'show' => ( !empty( $atts ) ? implode( ',', $atts ) : '' ) ) ) ) && $results['results'] ) {
                echo '<div class="list clearfix">';
                foreach( items( array( 'show' => ( !empty( $atts ) ? implode( ',', $atts ) : '' ), 'orderby' => $orderby_attr ) ) as $item ) {
                    echo couponscms_coupon_item( $item );
                }
                echo '</div>';
            } else {
                echo '<div class="alert">' . sprintf( t( 'theme_no_coupons_store',  '%s has no coupons yet.' ), ts( $store->name ) ) . '</div>';
                echo '<div class="list clearfix">';
                foreach( items_custom( array( 'show' => ',active', 'orderby' => 'rand', 'max' => option( 'items_per_page' ) ) ) as $item ) {
                    echo couponscms_coupon_item( $item, false, true );
                }
                echo '</div>';
            }

        } ?>
        <?php if( isset( $results ) ) {
            echo couponscms_theme_pagination( $results );
        } 
        
        echo do_action( 'store_after_items' ); ?>
    </div>
</div>