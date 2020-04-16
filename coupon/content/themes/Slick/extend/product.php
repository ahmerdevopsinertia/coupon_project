<?php

function couponscms_product_item( $item = object, $owner_view = false ) {

    $item->is_owner_view = $owner_view;

    $markup = do_action( 'before_product_outside', $item );

    $markup .= '<div class="item">
            ' . do_action( 'before_product_inside', $item ) . '
                <div class="item-content">
                    <div class="image">
                        <img src="' . product_avatar( ( !empty( $item->image ) ? $item->image : '' ) ) . '" alt="' . ts( $item->title ) . '" />
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
                        <div class="price">';
                            if( !empty( $item->price ) ) {
                                $markup .= '<span class="current-price">' . $item->currency . ' ' . price_format( $item->price ) . '</span>';
                            }
                            if( !empty( $item->old_price ) ) {
                                $markup .= '<span class="old-price">' . price_format( $item->old_price ) . '</span>';
                            }
                        $markup .= '</div>
                    </div>
                </div>
                <div class="bottom clearfix">
                    <a href="' . $item->store_link . '">' . $item->store_name . '</a>';
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
                            $markup .= '<a href="#" data-ajax-call="' . ajax_call_url( "save" ) . '" data-data=\'' . json_encode( array( 'item' => $item->ID, 'type' => 'product', 'added_message' => '<i class="fa fa-star"></i>', 'removed_message' => '<i class="far fa-star"></i>' ) )  . '\'' . ( is_saved( $item->ID, 'product' ) ? ' class="favorite"><i class="fa fa-star"></i>' : '><i class="far fa-star"></i>' ) . '</a>';
                        }
                        if( $owner_view ) {
                            $markup .= '<a href="' . get_update( array( 'action' => 'edit-product', 'id' => $item->ID ) ) . '" class="button">' . t( 'edit', 'Edit' ) . '</a>';
                        } else {
                            $markup .= '<a href="' . get_target_link( 'product', $item->ID ) . '" class="button" target="_blank">' . t( 'theme_shop_now', 'Shop Now' ) . '</a>';
                        }
                    $markup .= '</div>
                </div>
            ' . do_action( 'after_product_inside', $item ) . '
            </div>
            ' . do_action( 'after_product_outside', $item );

    return $markup;

}