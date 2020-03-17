<?php

function couponscms_reward_item( $item = object ) {

    global $me;

    $markup = do_action( 'before_reward_outside', $item );

    $markup = '
    <div class="item">
        ' . do_action( 'before_reward_inside', $item ) . '
        <div class="item-content">
            <div class="image">
                <img src="' . reward_avatar( $item->image ) . '" alt="" />
            </div>
            <div class="content">
                <div class="title"><h4>' . ts( $item->title ) . '</h4></div>
                <p class="date">' . sprintf( t( 'theme_redeem_required_points', '<b>%s</b> points required to redeem this' ), $item->points ) . '</p>
                <div class="description">' . ( !empty( $item->description ) ? '<p>' . $item->description . '</p>' : t( 'theme_no_description', 'No description.' ) ) . '</div>
            </div>
        </div>
        <div class="bottom clearfix">';
        if( $me->Points >= $item->points ) {
            $markup .= '<div class="form-box dnone">';
            $markup .= create_reward_request( $item );
            $markup .= '</div>';
            $markup .= '<div>';
            $markup .= '<a href="#" class="button reward-claim">' . t( 'theme_redeem_button', 'Redeem' ) . '</a>';
        } else {
            $markup .= '<div>';
            $markup .= sprintf( t( 'theme_redeem_need_more', 'You still need %s points to claim this reward.' ), ( $item->points - $me->Points ) );               
        }
        $markup .= '</div>
        </div>
        ' . do_action( 'after_reward_inside', $item ) . '
    </div>';

    $markup .= do_action( 'after_reward_outside', $item );

    return $markup;

}

function couponscms_reward_request_item( $item = object ) {

    $markup = do_action( 'before_reward_reqest_outside', $item );

    $markup .= '
    <div class="item">
        ' . do_action( 'before_reward_reqest_inside', $item ) . '
        <div class="info">
            <h5 title="' . $item->name . '">' . $item->name . '</h5>';
            $markup .= '<div class="state">' . sprintf( t( 'theme_reward_request_state', 'State: %s' ), ( !$item->claimed ? t( 'theme_claim_reqest_pending', 'Pending' ) : t( 'theme_claim_reqest_completed', 'Completed' )) ) . '</div>';
            $markup .= '<div class="points">' . sprintf( t( 'theme_reward_required_points_used', '<b>%s</b> points used' ), $item->points ) . '</div>
        </div>
    ' . do_action( 'after_reward_request_inside', $item ) . '
    </div>
    ' . do_action( 'after_reward_request_outside', $item );

    return $markup;

}