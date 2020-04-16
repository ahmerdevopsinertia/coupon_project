<?php

$type = searched_type();

$search_in_category = false;

$atts = [];

if( !empty( $_GET['category'] ) ) {
    if( category_exists( $_GET['category'] ) ) {
        list( $search_in_category, $category_info ) = [ true, category_info( $_GET['category'] ) ];
        $atts['category'] = $_GET['category'];
    }
}

$default_orderby = 'newest';
$orderby_attr = 'date desc';

if( !empty( $_GET['orderby'] ) ) {

    $orderby = [ 'newest' => 'date desc', 'oldest' => 'date' ];

    if( in_array( $_GET['orderby'], array_keys( $orderby ) ) ) {
        $default_orderby = $_GET['orderby'];
    }

    $orderby_attr = $orderby[$default_orderby];

}

if( $type !== 'stores' ) {

    $active = [ 1, '<i class="far fa-circle"></i>'];

    if( !empty( $_GET['active'] ) ) {
        $active = [ 0, '<i class="fas fa-check-circle"></i>' ];
        $atts['show'] = 'active';
    }

}

have_items( $atts );

$types = [];
$types['coupons'] = [ 'label' => t( 'coupons', 'Coupons' ), 'url' => get_update( [ 'type' => 'coupons' ], get_remove( [ 'page', 'type' ] ) ) ];
if( couponscms_has_products() ) {
    $types['products'] = [ 'label' => t( 'products', 'Products' ), 'url' => get_update( [ 'type' => 'products' ], get_remove( [ 'page', 'type' ] ) ) ];
}
$types['stores'] = [ 'label' => t( 'stores', 'Stores' ), 'url' => get_update( [ 'type' => 'stores' ], get_remove( [ 'page', 'type' ] ) ) ];
if( couponscms_has_local_stores() ) {
    $types['locations'] = [ 'label' => t( 'theme_stores_by_location', 'Stores By Location' ), 'url' => get_update( [ 'type' => 'locations' ], get_remove( [ 'page', 'type' ] ) ) ];
} ?>

<div class="bgGray">
    <div class="hero-title">
        <div class="container">
            <h2><?php if( $search_in_category ) {
                echo sprintf( t( 'theme_results_for_in', 'Results for "%s" in %s' ), searched(), $category_info->name );
            } else {
                echo sprintf( t( 'theme_results_for', 'Results for "%s"' ), searched() );
            } ?></h2>
        </div>
    </div>
</div>

<div class="pt-50 pb-50 hr-bottom clearfix">
    <div class="container">
        <div class="list3 owl-carousel clearfix">
            <?php foreach( categories_custom( [ 'show' => 'cats', 'max' => 0 ] ) as $cat ) { ?>
            <div class="item<?php echo ( $search_in_category && $category_info->ID == $cat->ID ? ' selected' : '' ); ?>">
                <div class="icon">
                    <i class="<?php echo ( !empty( $cat->extra['icon'] ) ? esc_html( $cat->extra['icon'] ) : 'fas fa-list-ul' ); ?>"></i>
                </div>
                <div class="bottom clearfix">
                    <div class="title">
                        <a href="<?php echo get_update( [ 'category' => $cat->ID ] ); ?>"><?php echo $cat->name; ?></a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="bgGray pt-75 pb-75 clearfix">
    <div class="container">

    <div class="mb-40 clearfix">
        <ul class="options float-left">
            <li class="contains-sub-menu pb-10"><a href="#"><?php echo $types[$type]['label']; ?> <i class="fa fa-angle-down"></i></a>
                <ul>
                    <?php foreach( $types as $cur_type => $type2 ) {
                        echo '<li' . ( $cur_type == $type ? ' class="active"' : '' ) . '><a href="' . $type2['url'] . '">' . $type2['label'] . '</a></li>';
                    } ?>
                </ul>
            </li>
        </ul>
        <?php if( $type !== 'stores' ) { ?>
        <a href="<?php echo get_update( [ 'active' => $active[0] ], get_remove( [ 'page' ] ) ); ?>" class="float-right"><?php echo $active[1] . ' ' . t( 'theme_active_only', 'Active only' ); ?></a>
        <?php } ?>
    </div>

    <?php if( $type === 'products' || $type === 'product-locations' ) {

    if( results() ) {

        echo '<div class="list clearfix">';
        foreach( items( ( $atts + [ 'orderby' => $orderby_attr ] ) ) as $item ) {
            echo couponscms_product_item( $item );
        }
        echo '</div>';
        echo couponscms_theme_pagination( navigation() );

    } else {

        echo '<div class="alert">' . t( 'theme_no_products_found',  'No products found.' ) . '</div>';

        echo '<div class="list clearfix">';
        foreach( products_custom( [ 'show' => 'visible,active', 'orderby' => 'rand', 'max' => option( 'items_per_page' ) ] ) as $item ) {
            echo couponscms_product_item( $item );
        }
        echo '</div>';

    }

    } else if( $type === 'stores' || $type === 'locations' ) {

    if( results() ) {

        echo '<div class="list2 clearfix">';
        foreach( items( [ 'orderby' => $orderby_attr ] ) as $item ) {
            echo couponscms_store_item( $item );
        }
        echo '</div>';
        echo couponscms_theme_pagination( navigation() );

    } else {

        echo '<div class="alert">' . t( 'theme_no_stores_found',  'No stores found.' ) . '</div>';

        echo '<div class="list2 clearfix">';
        foreach( stores_custom( [ 'show' => 'visible,active', 'orderby' => 'rand', 'max' => option( 'items_per_page' ) ] ) as $item ) {
            echo couponscms_store_item( $item );
        }
        echo '</div>';

    }

    } else {

    if( results() ) {

        echo '<div class="list clearfix">';
        foreach( items( ( $atts + [ 'orderby' => $orderby_attr ] ) ) as $item ) {
            echo couponscms_coupon_item( $item );
        }
        echo '</div>';
        echo couponscms_theme_pagination( navigation() );
        
    } else {

        echo '<div class="alert">' . t( 'theme_no_coupons_found',  'No coupons found.' ) . '</div>';

        echo '<div class="list clearfix">';
        foreach( items_custom( [ 'show' => 'visible,active', 'orderby' => 'rand', 'max' => option( 'items_per_page' ) ] ) as $item ) {
            echo couponscms_coupon_item( $item, false, true );
        }
        echo '</div>';

    }

    } ?>

    </div>
</div>







<?php
if( 1 == 2 ) {
$type = searched_type();

$search_in_category = false;

$atts = [];

if( !empty( $_GET['category'] ) ) {
    if( category_exists( $_GET['category'] ) ) {
        list( $search_in_category, $category_info ) = [ true, category_info( $_GET['category'] ) ];
        $atts['category'] = $_GET['category'];
    }
}

$default_orderby = 'newest';
$orderby_attr = 'date desc';

if( !empty( $_GET['orderby'] ) ) {

    $orderby = [ 'newest' => 'date desc', 'oldest' => 'date' ];

    if( in_array( $_GET['orderby'], array_keys( $orderby ) ) ) {
        $default_orderby = $_GET['orderby'];
    }

    $orderby_attr = $orderby[$default_orderby];

}

if( $type !== 'stores' && $type !== 'locations' ) {

    $active = [ 1, '<i class="far fa-circle"></i>'];

    if( !empty( $_GET['active'] ) ) {
        $active = [ 0, '<i class="fas fa-check-circle"></i>' ];
        $atts['show'] = 'active';
    }

}

have_items( $atts );

$types = [];
$types['coupons'] = [ 'label' => t( 'coupons', 'Coupons' ), 'url' => get_update( [ 'type' => 'coupons' ], get_remove( [ 'page', 'type' ] ) ) ];
if( couponscms_has_products() ) {
    $types['products'] = [ 'label' => t( 'products', 'Products' ), 'url' => get_update( [ 'type' => 'products' ], get_remove( [ 'page', 'type' ] ) ) ];
}
$types['stores'] = [ 'label' => t( 'stores', 'Stores' ), 'url' => get_update( [ 'type' => 'stores' ], get_remove( [ 'page', 'type' ] ) ) ];
if( couponscms_has_local_stores() ) {
    $types['locations'] = [ 'label' => t( 'theme_stores_by_location', 'Stores By Location' ), 'url' => get_update( [ 'type' => 'locations' ], get_remove( [ 'page', 'type' ] ) ) ];
} ?>

<div class="pt50 pb50">

<div class="pt-100 clearfix">
    <div class="container">
        <div class="title-options">
            <h2>
            <?php if( $search_in_category ) {
                echo sprintf( t( 'theme_results_for_in', 'Results for "%s" in %s' ), searched(), $category_info->name );
            } else {
                echo sprintf( t( 'theme_results_for', 'Results for "%s"' ), searched() );
            } ?>
            </h2>
            <div class="options">
                <a href="#"><?php echo $types[$type]['label']; ?> <i class="fa fa-angle-down"></i></a>
                <ul>
                    <?php foreach( $types as $cur_type => $type2 ) {
                        echo '<li' . ( $cur_type == $type ? ' class="active"' : '' ) . '><a href="' . $type2['url'] . '">' . $type2['label'] . '</a></li>';
                    } ?>
                </ul>
            </div>
            <div class="options">
                <a href="#"><?php te( 'theme_filter', 'Filter' ); ?> <i class="fa fa-angle-down"></i></a>
                <ul>
                    <?php if( $type !== 'stores' && $type !== 'locations' ) { ?>
                        <li><a href="<?php echo get_update( [ 'active' => $active[0] ], get_remove( [ 'page' ] ) ); ?>"><?php echo $active[1] . ' ' . t( 'theme_active_only', 'Active only' ); ?></a></li>
                    <?php } ?>
                    <li class="contains-sub-menu">
                        <a href="#"><?php te( 'theme_order_by', 'Order by' ); ?> <i class="fa fa-angle-right"></i></a>
                        <ul>
                            <li<?php echo ( $default_orderby == 'newest' ? ' class="active"' : '' ); ?>><a href="<?php echo get_update( [ 'orderby' => 'newest' ], get_remove( [ 'page' ] ) ); ?>"><?php echo t( 'theme_filter_newest', 'Newest' ); ?> <i class="fas fa-long-arrow-alt-up"></i></a></li>
                            <li<?php echo ( $default_orderby == 'oldest' ? ' class="active"' : '' ); ?>><a href="<?php echo get_update( [ 'orderby' => 'oldest' ], get_remove( [ 'page' ] ) ); ?>"><?php echo t( 'theme_filter_oldest', 'Oldest' ); ?> <i class="fas fa-long-arrow-alt-down"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <h5><?php echo sprintf( t( 'theme_results_found', '%s results found' ), results() ); ?></h5>
        </div>
    </div>
</div>

<div class="pt-100 pb-100 clearfix">
    <div class="container">
    <?php if( $type === 'products' || $type === 'product-locations' ) {

        if( results() ) {

            echo '<div class="list clearfix">';
            foreach( items( ( $atts + [ 'orderby' => $orderby_attr ] ) ) as $item ) {
                echo couponscms_product_item( $item );
            }
            echo '</div>';

        } else {

                echo '<div class="alert">' . t( 'theme_no_products_found',  'No products found.' ) . '</div>';

                echo '<div class="list clearfix">';
                foreach( products_custom( [ 'show' => 'visible,active', 'orderby' => 'rand', 'max' => option( 'items_per_page' ) ] ) as $item ) {
                    echo couponscms_product_item( $item );
                }
                echo '</div>';

        }

    } else if( $type === 'stores' || $type === 'locations' ) {

        if( results() ) {

            echo '<div class="list clearfix">';
            foreach( items( [ 'orderby' => $orderby_attr ] ) as $item ) {
                echo couponscms_store_item( $item );
            }
            echo '</div>';

        } else {

            echo '<div class="alert">' . t( 'theme_no_stores_found',  'No stores found.' ) . '</div>';

            echo '<div class="list clearfix">';
            foreach( stores_custom( [ 'show' => 'visible,active', 'orderby' => 'rand', 'max' => option( 'items_per_page' ) ] ) as $item ) {
                echo couponscms_store_item( $item );
            }
            echo '</div>';

        }

    } else {

        if( results() ) {

            echo '<div class="list clearfix">';
            foreach( items( ( $atts + [ 'orderby' => $orderby_attr ] ) ) as $item ) {
                echo couponscms_coupon_item( $item );
            }
            echo '</div>';

        } else {

            echo '<div class="alert">' . t( 'theme_no_coupons_found',  'No coupons found.' ) . '</div>';

            echo '<div class="list clearfix">';
            foreach( items_custom( [ 'show' => 'visible,active', 'orderby' => 'rand', 'max' => option( 'items_per_page' ) ] ) as $item ) {
                echo couponscms_coupon_item( $item, false, true );
            }
            echo '</div>';

        }

    } ?>
    </div>
</div>

</div>

<?php } ?>