<?php

function couponscms_plans_item( $item = object ) {

    $markup = do_action( 'before_plans_outside', $item );

    $markup = '
    <div class="item">
        ' . do_action( 'before_plans_inside', $item ) . '
        <div class="item-content">
            <div class="image">
                <img src="' . payment_plan_avatar( $item->image ) . '" alt="" />
            </div>
            <div class="content">
                <div class="title"><h4>' . ts( $item->name ) . '</h4></div>
                <div class="description">' . ( !empty( $item->description ) ? '<p>' . $item->description . '</p>' : t( 'theme_no_description', 'No description.' ) ) . '</div>
                <div class="price"><span class="current-price">' . $item->price_format . '</span></div>
            </div>
        </div>
        <div class="bottom clearfix">
            <div><a href="' . tlink( 'pay', 'plan=' . $item->ID ) . '" class="button">' . sprintf( t( 'theme_admin_payment_plan_button', 'Add %s credits' ), $item->credits ) . '</a></div>
        </div>
        ' . do_action( 'after_plans_inside', $item ) . '
    </div>';

    $markup .= do_action( 'after_plans_outside', $item );

    return $markup;



    $markup = do_action( 'before_plans_outside', $item );

    $markup .= '
    <div class="item">
        ' . do_action( 'before_plans_inside', $item ) . '
        <div class="top">
            <img src="' . payment_plan_avatar( $item->image ) . '" alt="" />
        </div>
        <div class="info">
            <a href="' . tlink( 'pay', 'plan=' . $item->ID ) . '" title="' . ts( $item->name ) . '"><h5>' . ts( $item->name ) . '</h5></a>';
            $markup .= '<div class="description">
            <span>' . ts( $item->description ) . '</span>
            </div>
            <div class="price">';
            if( !empty( $item->price_format ) ) {
                $price = explode( MONEY_DECIMAL_SEPARATOR, $item->price_format );
            }

            $markup .= '<div class="current-price">
                ' . ( isset( $price[0] ) ? $price[0] : '' ) . ( isset( $price[1] ) ? '<sup>' . MONEY_DECIMAL_SEPARATOR . $price[1] . '</sup>' : '' ) . '
            </div>';
            $markup .= '</div>
            <a href="' . tlink( 'pay', 'plan=' . $item->ID ) . '" class="link">' . sprintf( t( 'theme_admin_payment_plan_button', 'Add %s credits' ), $item->credits ) . '</a>
        </div>
    ' . do_action( 'after_plans_inside', $item ) . '
    </div>
    ' . do_action( 'after_plans_outside', $item );

    return $markup;

}