<div class="bgGray">
    <div class="hero-title">
        <div class="container">
            <h2><?php tse( $campaign->title ); ?></h2>
        </div>
    </div>
</div>

<div class="pt-75 pb-75 clearfix">
    <div class="container">
        <?php if( count( $types ) > 1 ) { ?>
        <div class="mb-40 clearfix">
            <ul class="options float-left">
                <li class="contains-sub-menu pb-10"><a href="#"><?php echo $types[$type]['label']; ?> <i class="fa fa-angle-down"></i></a>
                    <ul>
                    <?php foreach( $types as $type_id => $type_nav ) {
                        echo '<li' . ( $type_id == $type ? ' class="selected"' : '' ) . '><a href="' . $type_nav['url'] . '">' . $type_nav['label'] . '</a></li>';
                    } ?>
                    </ul>
                </li>
            </ul>
        </div>
        <?php } ?>
        <div class="list clearfix">
        <?php if( $type === 'products' ) {
            if( ( $pagination = have_products_custom( [ 'show' => 'current_campaign', 'per_page' => ( $items_per_page = \query\main::get_option( 'campaigns_items_per_page' ) ) ] ) ) && $pagination['results'] ) {
                foreach( products_custom( [ 'show' => 'current_campaign', 'per_page' => $items_per_page, 'page' => $pagination['page'] ] ) as $item ) {
                    echo couponscms_product_item( $item );
                }
            }
        } else {
            if( ( $pagination = have_items_custom( [ 'show' => 'current_campaign', 'per_page' => ( $items_per_page = \query\main::get_option( 'campaigns_items_per_page' ) ) ] ) ) && $pagination['results'] ) {
                foreach( items_custom( [ 'show' => 'current_campaign', 'per_page' => $items_per_page, 'page' => $pagination['page'] ] ) as $item ) {
                    echo couponscms_coupon_item( $item );
                } 
            } 
        } ?>
        </div>
        <?php echo couponscms_theme_pagination( $pagination ); ?>
    </div>
</div>