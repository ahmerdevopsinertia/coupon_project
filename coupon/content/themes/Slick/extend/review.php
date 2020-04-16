<?php

function couponscms_review_item( $item = object, $owner_view = false ) {

    $item->is_owner_view = $owner_view;

    $markup = do_action( 'before_review_outside', $item );

    $markup .= '
    <div class="item">
        ' . do_action( 'before_review_inside', $item ) . '
        <div class="image">
            <img src="' . user_avatar( $item->user_avatar ) . '" alt="' . $item->user_name . '" />
        </div>
        <div class="content">
            <h5>John Doe says:';
                if( ( $rating = couponscms_rating( (int) $item->stars ) ) ) {
                    $markup .= '<div class="rating">' . $rating . '</div>';
                }
            $markup .= '</h5>
            <p>' . $item->text . '</p>
            <p class="date">' . couponscms_dateformat( $item->date ) . '</p>
        </div>
        ' . do_action( 'after_review_inside', $item ) . '
    </div>
    ' . do_action( 'after_review_outside', $item );

    return $markup;

}