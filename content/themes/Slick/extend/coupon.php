<?php

function couponscms_coupon_item( $item = object, $owner_view = false ) {

    $item->is_owner_view = $owner_view;

    $markup = do_action( 'before_coupon_outside', $item );

    $markup = '
    <div class="item" id="coupon-' . $item->ID . '">
        ' . do_action( 'before_coupon_inside', $item ) . '
        <div class="item-content">
            <div class="image">';
            if( $item->is_show_in_store && ( $claimed = is_coupon_claimed( $item->ID ) )  ) {
                $markup .= '<div class="qr-code">
                <img src="https://chart.googleapis.com/chart?cht=qr&chl=' . urlencode( tlink( 'user/account', 'action=check&code=' . $claimed->code ) ) . '&chs=120x120&choe=UTF-8&chld=L|2" alt="qr code" />
                </div>';
            }
            $markup .= '<img src="' . store_avatar( ( !empty( $item->image ) ? $item->image : $item->store_img ) ) . '" alt="" />
            </div>
            <div class="content">
                <div class="title"><h4>' . ts( $item->title ) . '</h4></div>
                <p class="date">';
                if( $item->is_expired ) {
                    $markup .= t( 'theme_expired', 'Expired' );
                } else if( !$item->is_started ) {
                    $markup .= sprintf( t( 'theme_starts', 'Starts %s' ), couponscms_dateformat( $item->start_date ) );
                } else {
                    $markup .= sprintf( t( 'theme_expires', 'Expires %s' ), couponscms_dateformat( $item->expiration_date ) );
                }
                $markup .= '</p>
                <div class="description">' . ( !empty( $item->description ) ? '<p>' . $item->description . '</p>' : t( 'theme_no_description', 'No description.' ) ) . '</div>
            </div>
        </div>
        <div class="bottom clearfix">
            <a href="' . $item->store_link . '">' . ts( $item->store_name ) . '</a>';
            if( ( $rating = couponscms_rating( (int) $item->stars, $item->reviews ) ) ) {
                $markup .= '<a href="' . $item->store_reviews_link . '#reviews" class="rating">' . $rating . '</a>';
            }
            $markup .= '<div>
                <ul class="options">
                    <li><a href="#"><i class="fas fa-share"></i></a>
                        <ul>';
                        $markup .= couponscms_share_links( $item->link );
                        $markup .= '</ul>
                    </li>
                </ul>';
                if( !( $owner_view || $item->is_expired ) ) {
                    $markup .= '<a href="#" data-ajax-call="' . ajax_call_url( "save" ) . '" data-data=\'' . json_encode( array( 'item' => $item->ID, 'type' => 'coupon', 'added_message' => '<i class="fa fa-star"></i>', 'removed_message' => '<i class="far fa-star"></i>' ) ) . '\'' . ( is_saved( $item->ID, 'coupon' ) ? ' class="favorite"><i class="fa fa-star"></i>' : '><i class="far fa-star"></i>' ) . '</a>';
                }
                if( $owner_view ) {
                    if( $item->is_show_in_store ) {
                        $markup .= '<a href="' . get_update( array( 'action' => 'coupon-claims', 'id' => $item->ID ) ) . '" class="button">' . sprintf( t( 'theme_claims', 'Claims (%s)' ), $item->claims ) . '</a>';
                    }
                    $markup .= '<a href="' . get_update( array( 'action' => 'edit-coupon', 'id' => $item->ID ) ) . '" class="button">' . t( 'edit', 'Edit' ) . '</a>';
                } else {
                    if( $item->is_printable ) {
                        $markup .= '<a href="' . get_target_link( 'coupon', $item->ID ) . '" class="button">' . t( 'theme_print', 'Print It' ) . '</a>';
                    } else if( $item->is_show_in_store ) {
                        if( $claimed ) {
                            $markup .= '<a href="#" data-code="' . $claimed->code . '" class="button">' . t( 'theme_claimed_show_code', 'Show the Code' ) . '</a>';
                        } else if( $item->claim_limit == 0 || $item->claim_limit > $item->claims ) {
                            $markup .= '<a href="#" data-ajax-call="' . ajax_call_url( "claim" ) . '" data-data=\'' . json_encode( array( 'item' => $item->ID, 'claimed_message' => '<i class="fa fa-check"></i><span> ' . t( 'theme_claimed', 'Claimed !' ) ) ) . '\' data-after-ajax="coupon_claimed" data-confirmation="' . t( 'theme_claim_ask', 'Do you want to claim and use this coupon in store?' ) . '" class="button">' . t( 'theme_claim', 'Claim' ) . '</span></a>';
                        }
                    } else if( $item->is_coupon ) {
                        if( couponscms_view_store_coupons( $item->storeID ) ) {
                            $markup .= '<a href="#" class="code-revealed button"><i class="fas fa-cut"></i> ' . $item->code . '<input type="text" name="copy" value="' . $item->code . '" /></a>';
                        } else {
                            $markup .= '<a href="' . get_target_link( 'coupon', $item->ID, array( 'reveal_code' => true, 'backTo' => base64_encode( $item->store_link ) ) ) . '" target="_blank" class="button" data-target-on-click="' . get_target_link( 'coupon', $item->ID ) . '">' . t( 'theme_claimed_show_code', 'View Code' ) . '</a>';
                        }
                    } else {
                        $markup .= '<a href="' . get_target_link( 'coupon', $item->ID ) . '" target="_blank" class="button">' . t( 'theme_get_deal', 'Get Deal' ) . '</a>';
                    }
                }
            $markup .= '</div>
        </div>
        ' . do_action( 'after_coupon_inside', $item ) . '
    </div>';

    $markup .= do_action( 'after_coupon_outside', $item );

    return $markup;

}

function couponscms_claims_item( $item = object ) {

    $markup = do_action( 'before_claims_item_outside', $item );

    $markup .= '<div class="item">
    <div class="info">';

    $markup .= do_action( 'before_claims_item_inside', $item );

    $markup .= '<div class="list-item-content claims-item-content">';
    $markup .= '<div class="middle">';
    $markup .= '<h3>' . ( $item->is_used ? $item->code : '***' . substr( $item->code, -3 ) ) . '</h3>';
    $markup .= '<div class="list-info">' . sprintf( t( 'theme_claims_used_state', 'Used: %s' ), ( $item->is_used ? t( 'yes', 'Yes' ) : t( 'no', 'No' ) ) ) . '</div>';
    if( $item->is_used ) {
        $markup .= '<div class="list-info">' . sprintf( t( 'theme_claims_used_date', 'Used Date: %s' ), $item->used_date ) . '</div>';
    }
    $markup .= '<div class="list-info">' . sprintf( t( 'theme_claims_claimed_date', 'Claimed Date: %s' ), $item->date ) . '</div>';
    $markup .= '</div>

    </div>';

    $markup .= do_action( 'after_reward_reqest_inside', $item );

    $markup .= '</div>
    </div>';

    $markup .= do_action( 'after_reward_reqest_outside', $item );

    return $markup;

}