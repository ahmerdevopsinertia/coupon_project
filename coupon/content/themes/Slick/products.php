<?php

$types = [];
$types['recent']        = [ 'label' => t( 'theme_products_recently_added', 'Recently Added' ),  'url' => get_update( [ 'type' => 'recent' ], get_remove( [ 'page' ] ) ),             'orderby' => 'date desc',      'show' => 'visible',         'limit' => 100 ];
$types['expiring']      = [ 'label' => t( 'theme_products_expiring_soon', 'Expiring Soon' ),    'url' => get_update( [ 'type' => 'expiring' ], get_remove( [ 'page', 'type' ] ) ),   'orderby' => 'expiration',     'show' => 'visible',         'limit' => 100 ];
$types['popular']       = [ 'label' => t( 'theme_products_popular', 'Popular' ),                'url' => get_update( [ 'type' => 'popular' ], get_remove( [ 'page', 'type' ] ) ),    'orderby' => '',               'show' => 'visible,popular', 'limit' => 100 ];

$type = isset( $_GET['type'] ) && in_array( $_GET['type'], array_keys( $types ) ) ? $_GET['type'] : 'recent';

$atts = [];
$atts['show'] = $types[$type]['show'];
$atts['limit'] = $types[$type]['limit'];

$type_orderby = $types[$type]['orderby'];

if( empty( $type_orderby ) ) {

    $orderby = [ 'newest' => 'date desc', 'oldest' => 'date' ];
    $default_orderby = 'newest';

    if( isset( $_GET['orderby'] ) && in_array( $_GET['orderby'], array_keys( $orderby ) ) ) {
        $default_orderby = $_GET['orderby'];
    }

    $types[$type]['orderby'] = $orderby[$default_orderby];

}

$active = [ 1, '<i class="far fa-circle"></i>'];

if( !empty( $_GET['active'] ) ) {
    $active = [ 0, '<i class="fas fa-check-circle"></i>' ];
    $atts['show'] = $atts['show'] . ',active';
}

$pagination = have_products_custom( $atts ); ?>

<div class="bgGray">
    <div class="hero-title">
        <div class="container">
            <h2><?php te( 'products', 'Products' ); ?></h2>
        </div>
    </div>
</div>

<div class="pt-50 pb-50 hr-bottom clearfix">
    <div class="container">
        <div class="list3 owl-carousel clearfix">
            <?php foreach( categories_custom( [ 'show' => 'cats', 'max' => 0 ] ) as $cat ) { ?>
            <div class="item">
                <div class="icon">
                    <i class="<?php echo ( !empty( $cat->extra['icon'] ) ? esc_html( $cat->extra['icon'] ) : 'fas fa-list-ul' ); ?>"></i>
                </div>
                <div class="bottom clearfix">
                    <div class="title">
                        <a href="<?php echo get_update( ['type' => 'products'], $cat->link ); ?>"><?php echo $cat->name; ?></a>
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
            <a href="<?php echo get_update( [ 'active' => $active[0] ], get_remove( [ 'page' ] ) ); ?>" class="float-right"><?php echo $active[1] . ' ' . t( 'theme_active_only', 'Active only' ); ?></a>
        </div>
        <div class="list clearfix">
            <?php if( $pagination['results'] ) {
                foreach( products_custom( ( [ 'orderby' => $types[$type]['orderby'] ] + $atts ) ) as $item ) {
                    echo couponscms_product_item( $item );
                }
            } else echo '<div class="alert">' . t( 'theme_no_products_list',  'Huh :( No products found here.' ) . '</div>'; ?>
        </div>
        <?php echo couponscms_theme_pagination( $pagination ); ?>
    </div>
</div>