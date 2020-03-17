<?php

$category = the_item();

$type = searched_type();

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
$types['stores'] = [ 'label' => t( 'stores', 'Stores' ), 'url' => get_update( [ 'type' => 'stores' ], get_remove( [ 'page', 'type' ] ) ) ]; ?>

<div class="bgGray">
    <div class="hero-title">
        <div class="container">
            <h2><?php tse( $category->name ); ?></h2>
        </div>
    </div>
</div>

<div class="pt-50 pb-50 hr-bottom clearfix">
    <div class="container">
        <div class="list3 owl-carousel clearfix">
            <?php foreach( categories_custom( [ 'show' => 'cats', 'max' => 0 ] ) as $cat ) { ?>
            <div class="item<?php echo ( $category->ID == $cat->ID ? ' selected' : '' ); ?>">
                <div class="icon">
                    <i class="<?php echo ( !empty( $cat->extra['icon'] ) ? esc_html( $cat->extra['icon'] ) : 'fas fa-list-ul' ); ?>"></i>
                </div>
                <div class="bottom clearfix">
                    <div class="title">
                        <a href="<?php echo $cat->link; ?>"><?php echo $cat->name; ?></a>
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

    <?php if( $type === 'products' ) {

        if( results() ) {

            echo '<div class="list clearfix">';
            foreach( items( ( $atts + [ 'orderby' => $orderby_attr ] ) ) as $item ) {
                echo couponscms_product_item( $item );
            }
            echo '</div>';
            echo couponscms_theme_pagination( navigation() );

        } else {

            echo '<div class="alert">' . t( 'theme_no_products_category',  'No products in this category.' ) . '</div>';

            echo '<div class="list clearfix">';
            foreach( products_custom( [ 'show' => 'visible,active', 'orderby' => 'rand', 'max' => option( 'items_per_page' ) ] ) as $item ) {
                echo couponscms_product_item( $item );
            }
            echo '</div>';

        }

    } else if( $type === 'stores' ) {

        if( results() ) {

            echo '<div class="list2 clearfix">';
            foreach( items( [ 'orderby' => $orderby_attr ] ) as $item ) {
                echo couponscms_store_item( $item );
            }
            echo '</div>';
            echo couponscms_theme_pagination( navigation() );

        } else {

            echo '<div class="alert">' . t( 'theme_no_stores_category',  'No stores in this category.' ) . '</div>';

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

            echo '<div class="alert">' . t( 'theme_no_coupons_category',  'No coupons in this category.' ) . '</div>';

            echo '<div class="list clearfix">';
            foreach( items_custom( [ 'show' => 'visible,active', 'orderby' => 'rand', 'max' => option( 'items_per_page' ) ] ) as $item ) {
                echo couponscms_coupon_item( $item, false, true );
            }
            echo '</div>';

        }

    } ?>

    </div>
</div>