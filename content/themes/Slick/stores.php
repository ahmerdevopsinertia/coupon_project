<?php

$types              = [];
$types['all']       = array( 'label' => t( 'theme_all_stores', 'All Stores' ),  'url' => get_remove( array( 'page', 'type', 'firstchar' ) ),                                                'orderby' => 'name',        'firstchar' => true,    'show' => 'visible' );
$types['top']       = array( 'label' => t( 'theme_top_stores', 'Top Stores' ),  'url' => get_update( array( 'type' => 'top' ), get_remove( array( 'page', 'type', 'firstchar' ) ) ),        'orderby' => 'rating desc', 'firstchar' => false,   'show' => 'visible',       'limit' => 50 );
$types['most-voted']= array( 'label' => t( 'theme_most_voted', 'Most Voted' ),  'url' => get_update( array( 'type' => 'most-voted' ), get_remove( array( 'page', 'type', 'firstchar' ) ) ), 'orderby' => 'votes desc',  'firstchar' => false,   'show' => 'visible',       'limit' => 50 );
$types['popular']   = array( 'label' => t( 'theme_most_popular', 'Popular' ),   'url' => get_update( array( 'type' => 'popular' ), get_remove( array( 'page', 'type', 'firstchar' ) ) ),    'orderby' => 'votes desc',  'firstchar' => false,   'show' => 'visible,popular','limit' => 50 );

$type = isset( $_GET['type'] ) && in_array( $_GET['type'], array_keys( $types ) ) ? $_GET['type'] : 'all';

$atts = [];

if( isset( $_GET['firstchar'] ) && $types[$type]['firstchar'] ) {
    $atts['firstchar'] = substr( $_GET['firstchar'], 0, 1 );
}

$atts['show'] = $types[$type]['show'];

if( isset( $types[$type]['limit'] ) ) {
    $atts['limit'] = $types[$type]['limit'];
}

have_items( $atts ); ?>

<div class="bgGray">
    <div class="hero-title">
        <div class="container">
            <h2><?php te( 'stores', 'Stores' ); ?></h2>
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
                        <a href="<?php echo get_update( ['type' => 'stores'], $cat->link ); ?>"><?php echo $cat->name; ?></a>
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
        </div>
        <?php if( $type === 'all' ) {
        $markup = '';
        if( results() ) {
            $last_letter = '';
            foreach( items( [ 'orderby' => 'name', 'max' => 0 ] ) as $item ) {
                if( $item->name[0] !== $last_letter ) {
                    if( $last_letter !== '' ) $markup .= '</div>';
                    $markup .= '<div class="mb-50' . ( !empty( $last_letter ) ? ' mt-50' : '' ) . ' clearfix">
                                    <h2>' . $item->name[0] . '</h2>
                                </div>';
                    $markup .= '<div class="list2 clearfix">';
                    $last_letter = $item->name[0];
                }
                $markup .= couponscms_store_item( $item );
            }
            $markup .= '</div>';
        } else $markup = '<div class="alert">' . t( 'theme_no_stores_list',  'Huh :( No stores found here.' ) . '</div>';

        echo $markup;
        } else { ?>
        <div class="list2 clearfix">
            <?php if( results() ) {
                foreach( items( ( array( 'orderby' => $types[$type]['orderby'] ) + $atts ) ) as $item ) {
                    echo couponscms_store_item( $item );
                }
            } else echo '<div class="alert">' . t( 'theme_no_stores_list',  'Huh :( No stores found here.' ) . '</div>'; ?>
        </div>
        <?php echo couponscms_theme_pagination( navigation() ); ?>
        <?php } ?>
    </div>
</div>