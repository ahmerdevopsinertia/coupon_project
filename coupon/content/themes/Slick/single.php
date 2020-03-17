<?php $item = the_item(); ?>

<div class="pt50 pb50">

<div class="bgWhite pt-100 pb-100 clearfix">
    <div class="container">
        <?php echo do_action( 'coupon_before_info' ); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="avatar">
                    <img src="<?php echo store_avatar( ( !empty( $item->image ) ? $item->image : $item->store_img ) ); ?>" alt="" />
                </div>
                <ul class="links-list">
                    <li class="line-after"><a href="#" data-ajax-call="<?php echo ajax_call_url( "save" ); ?>" data-data='<?php echo json_encode( array( 'item' => $item->ID, 'type' => 'coupon', 'added_message' => '<i class="fa fa-star"></i> ' . t( 'theme_unsave_coupon', 'Unsave this coupon' ), 'removed_message' => '<i class="far fa-star"></i> ' . t( 'theme_save_coupon', 'Save this coupon' ) ) ); ?>'><?php echo ( is_saved( $item->ID, 'coupon' ) ? '<i class="fa fa-star"></i> ' . t( 'theme_unsave_coupon', 'Unsave this coupon' ) : '<i class="far fa-star"></i> ' . t( 'theme_save_coupon', 'Save this coupon' ) ); ?></a></li>
                    <li class="line-after"><a href="<?php echo $item->store_link; ?>"><i class="fas fa-arrow-left"></i> <?php tse( $item->store_name ); ?></a></li>
                    <?php if( !empty( $item->store_url ) ) { ?>
                    <li><a href="<?php echo get_target_link( 'store', $item->storeID ); ?>"><i class="fa fa-link"></i> <?php te( 'theme_store_visit', 'Visit Website' ); ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-8 offset-md-1 m-mt-60">
                <h2><?php tse( $item->title ); ?>
                    <?php if( !empty( $item->reviews ) ) { ?>
                        <div class="rating"><a href="<?php echo $item->store_reviews_link; ?>"><?php echo couponscms_rating( (int) $item->stars, $item->reviews ); ?></a></div>
                    <?php } ?>
                </h2>
                <div class="description">
                <?php echo ( !empty( $item->description ) ? ts( $item->description ) : t( 'theme_no_description', 'No description.' ) ); ?>
                <ul class="description-links">
                    <?php if( $item->is_printable ) {
                        echo '<li><a href="' . get_target_link( 'coupon', $item->ID ) . '"><i class="fas fa-print"></i> ' . t( 'theme_print', 'Print It' ) . '</a></li>';
                    } else if( $item->is_show_in_store ) {
                        if( ( $claimed = is_coupon_claimed( $item->ID ) ) ) {
                            echo '<li><div class="qr-code">
                            <img src="https://chart.googleapis.com/chart?cht=qr&chl=' . urlencode( tlink( 'user/account', 'action=check&code=' . $claimed->code ) ) . '&chs=160x160&choe=UTF-8&chld=L|2" alt="qr code" />
                            </div>';
                            echo '<a href="#" data-code="' . $claimed->code . '"><i class="far fa-eye"></i> <span>' . t( 'theme_claimed_show_code', 'Show Code' ) . '</span></a></li>';
                        } else if( $item->claim_limit == 0 || $item->claim_limit > $item->claims ) {
                            echo '<li><i class="fas fa-hourglass-half"></i> <a href="#" data-ajax-call="' . ajax_call_url( "claim" ) . '" data-data=\'' . json_encode( array( 'item' => $item->ID, 'claimed_message' => '<i class="fa fa-check"></i><span> ' . t( 'theme_claimed', 'Claimed !' ) ) ) . '\' data-after-ajax="coupon_claimed" data-confirmation="' . t( 'theme_claim_ask', 'Do you want to claim and use this coupon in store?' ) . '">' . t( 'theme_claim', 'Claim' ) . '</a></li>';
                        }
                    } else if( $item->is_coupon ) {
                        if( couponscms_view_store_coupons( $item->storeID ) ) {
                            echo '<li><div class="link">' . $item->code . '<div><input type="text" name="copy" value="' . $item->code . '" /><a href="#" data-copied>' . t( 'theme_copy', 'Copy' ) . '</a></div></div></li>';
                        } else {
                            $code_preview = strlen( $item->code ) > 2 ? '<i>' . substr( $item->code, 0, 2 ) . '...</i>' : '<i>...</i>';
                            echo '<li><a href="' . get_target_link( 'coupon', $item->ID, array( 'reveal_code' => true, 'backTo' => base64_encode( $item->link ) ) ) . '" target="_blank" data-target-on-click="' . get_target_link( 'coupon', $item->ID ) . '"><i class="far fa-eye"></i> ' . t( 'theme_claimed_show_code', 'View Code' ) . '</a></li>';
                        }
                    } else {
                        echo '<li><a href="' . get_target_link( 'coupon', $item->ID ) . '" target="_blank"><i class="fas fa-link"></i> ' . t( 'theme_get_deal', 'Get Deal' ) . '</a></li>';
                    }
                    echo '<li class="text-center"><div class="rate-coupon">
                        Have you tried this coupon ?
                        <ul class="vote-form">
                            <li><a href="#" data-ajax-call="' . ajax_call_url( "vote" ) . '" data-after-ajax="ajax_voted" data-message="' . t( 'theme_ty_for_rate', 'Thank you !' ) . '" data-data=\'' . json_encode( array( 'item' => $item->ID, 'vote' => 1 ) ) . '\'><i class="fas fa-thumbs-up"></i> It works</a></li>
                            <li><a href="#" data-ajax-call="' . ajax_call_url( "vote" ) . '" data-after-ajax="ajax_voted" data-message="' . t( 'theme_ty_for_rate', 'Thank you !' ) . '" data-data=\'' . json_encode( array( 'item' => $item->ID, 'vote' => 0 ) ) . '\'><i class="fas fa-thumbs-down"></i> Doesn\'t work</a></li>
                        </ul>
                    </div></li>';

                    $stats = array();
                    if( $item->is_verified ) {
                        $stats[] = '<li>' . sprintf( t( 'theme_verified_msg', '<span title="last time on %s"><i class="fas fa-check"></i> Verified manually</span>' ), couponscms_dateformat( $item->last_check ) ) . '</li>';
                    }
                    if( $item->clicks > 0 ) {
                        $stats[] = '<li><i class="fas fa-bookmark"></i> <span>' . sprintf( t( 'theme_stats_used', '%s used' ), $item->clicks )  . '</span></li>';
                    }
                    if( $item->votes > 0 ) {
                        $stats[] = '<li><i class="fas fa-thumbs-up"></i> <span>' . sprintf( t( 'theme_stats_percent_rate', '%s success rate' ), (int) $item->votes_percent . '%' )  . '</span></li>';
                    }
                    echo implode( "\n", $stats ); ?>
                    <li><i class="fas fa-hourglass-half"></i>
                    <?php if( $item->is_expired ) {
                        echo '<span class="expired exp-date">' . t( 'theme_expired', 'Expired' ) . '</span>';
                    } else if( !$item->is_started ) {
                        echo '<span class="starts exp-date">' . sprintf( t( 'theme_starts', 'Starts <strong>%s</strong>' ), couponscms_dateformat( $item->start_date ) ) . '</span>';
                    } else {
                        echo '<span class="expires exp-date">' . sprintf( t( 'theme_expires', 'Expires <strong>%s</strong>' ), couponscms_dateformat( $item->expiration_date ) ) . '</span>';
                    } ?>
                    </li>
                </ul>
                </div>
            </div>
        </div>
        <?php echo do_action( 'coupon_after_info' ); ?>
    </div>
</div>

<div class="bgBlack pt-50 pb-50 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
            <?php echo sprintf( t( 'theme_store_share_links', '<h3>Share With Friends</h3> %s' ), couponscms_share_links( $item->link ) ); ?>
            </div>
        </div>
    </div>
</div>

<div class="pt-100 clearfix">
    <div class="container">
        <div class="title-options">
            <h2><?php te( 'theme_related_coupons', 'Related Coupons' );  ?></h2>
        </div>
    </div>
</div>

<div class="pt-100 pb-100 clearfix">
    <div class="container">
        <?php echo do_action( 'coupon_before_items' ); ?>
        <div class="items clearfix">
        <?php foreach( items_custom( array( 'show' => 'visible,active', 'orderby' => 'rand', 'max' => option( 'items_per_page' ) ) ) as $item ) {
            echo couponscms_coupon_item( $item );
        } ?>
        </div>
        <?php echo do_action( 'coupon_after_items' ); ?>
    </div>
</div>

</div>