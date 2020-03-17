<?php $me = me(); ?>

<div class="bgGray hero-title">
    <div class="container">
        <div class="row">
            <div class="col-3 col-md-2 text-left user-avatar">
                <img src="<?php echo user_avatar( $me->Avatar ); ?>" alt="<?php echo $me->Name; ?>" />
            </div>
            <div class="col-9 col-md-7 text-left">
                <h3 class="mb-25"><?php echo $me->Name; ?></h3>
                <ul class="ul-list">
                    <li><?php echo t( 'theme_points', 'Points:' ) . ' <strong>' . $me->Points . '</strong>'; ?></li>
                    <li><?php echo t( 'theme_credits', 'Credits:' ) . ' <strong>' . $me->Credits . '</strong>'; ?></li>
                    <li><a href="<?php echo get_update( [ 'action' => 'purchase' ], tlink( 'user/account' ) ); ?>" class="button"><i class="fas fa-dollar-sign"></i> <?php te( 'theme_admin_add_credits', 'Add <span>Credits</span>' ); ?></a></li>
                </ul>
            </div>
            <div class="col-12 col-md-3 text-left text-md-right align-self-center m-mt-30">
                <a href="<?php echo get_update( [ 'action' => 'add-coupon' ], tlink( 'user/account' ) ); ?>" class="button big d-inline-block"><i class="fas fa-plus"></i><?php te( 'theme_admin_add_coupons', 'Add Coupons' ); ?></a>
            </div>
        </div>
    </div>
</div>

<?php if( !$me->is_confirmed ) { ?>

<div class="alert">
    <div class="container">
        <?php echo sprintf( t( 'theme_not_confirmed_msg', "Your account is not verified yet ! Please check your inbox (%s) and verify it as fast as possible." ), $me->Email ); ?>
    </div>
</div>

<?php } ?>

<?php

/* USER NAVIGATION LINKS */

$user_nav = [];

$user_nav['favorites']['parent'] = t( 'theme_admin_nav_favorites', 'Favorites' );
$user_nav['favorites']['fav-stores'] = t( 'theme_admin_nav_stores', 'Stores' );
$user_nav['favorites']['fav-coupons'] = t( 'theme_admin_nav_coupons', 'Coupons' );
if( couponscms_has_products() ) {
    $user_nav['favorites']['fav-products'] = t( 'theme_admin_nav_products', 'Products' );
}

$user_nav['saved']['parent'] = t( 'theme_admin_nav_saved', 'Saved' );
$user_nav['saved']['saved-stores'] = t( 'theme_admin_nav_stores', 'Stores' );
$user_nav['saved']['saved-coupons'] = t( 'theme_admin_nav_coupons', 'Coupons' );
if( couponscms_has_products() ) {
    $user_nav['saved']['saved-products'] = t( 'theme_admin_nav_products', 'Products' );
}

$user_nav['my-claims'] = t( 'theme_admin_nav_my_claims', 'Claimed Coupons' );

if( theme_has_rewards() ) {
    $user_nav['rewards']['parent'] = t( 'theme_admin_nav_rewards', 'Rewards' );
    $user_nav['rewards']['rewards'] = t( 'theme_admin_nav_rewards', 'View Rewards' );
    $user_nav['rewards']['reward-reqs'] = t( 'theme_admin_nav_reward_requests', 'Reward Reqests' );
}

if( is_store_owner() ) {
    $user_nav['my-stores']['parent'] = t( 'theme_admin_nav_my_stores', 'My Stores' );
    $user_nav['my-stores']['add-store'] = t( 'theme_admin_nav_add_store', 'Add' );
    $user_nav['my-stores']['my-stores'] = t( 'theme_admin_nav_view_stores', 'View' );

    $user_nav['my-coupons']['parent'] = t( 'theme_admin_nav_my_coupons', 'My Coupons' );
    $user_nav['my-coupons']['add-coupon'] = t( 'theme_admin_nav_add_coupon', 'Add' );
    $user_nav['my-coupons']['my-coupons'] = t( 'theme_admin_nav_view_coupons', 'View' );
    $user_nav['my-coupons']['check'] = t( 'theme_admin_nav_check_coupons', 'Check Codes' );

    if( couponscms_has_products() ) {
        $user_nav['my-products']['parent'] = t( 'theme_admin_nav_my_products', 'My Products' );
        $user_nav['my-products']['add-product'] = t( 'theme_admin_nav_add_product', 'Add' );
        $user_nav['my-products']['my-products'] = t( 'theme_admin_nav_view_products', 'View' );
    }
} else {
    $user_nav['add-store'] = t( 'theme_admin_nav_add_your_store', 'Add Your Store' );
}

$user_nav['edit-profile'] = t( 'theme_admin_nav_edit_profile', 'Edit Profile' );

$user_nav['refer-friend'] = t( 'theme_admin_nav_refer_friend', 'Refer a Friend' );

$user_nav[tlink( 'user/logout' )] = t( 'theme_admin_nav_logout', 'Logout' );

/* MENU VALUE */

$user_nav_value = isset( $_GET['action'] ) ? $_GET['action'] : 'edit-profile';

$menu_markup = $menu_label = '';

foreach( value_with_filter( 'user_nav', $user_nav ) as $parent_id => $parent ) {
    if( is_array( $parent ) ) {
        $menu_markup .= '<li class="contains-sub-menu' . ( $parent_id == $user_nav_value || in_array( $user_nav_value, array_keys( $parent ) ) ? ' active' : '' ) . '">';
        $menu_markup .= '<a href="' . ( filter_var( $parent_id, FILTER_VALIDATE_URL ) ? $parent_id : '#' ) . '">' . $parent['parent'] . ' <i class="fa fa-angle-right"></i></a>';
        $menu_markup .= '<ul class="sub-nav">';
        foreach( array_slice( $parent, 1 ) as $child_id => $child ) {
            if( $child_id == $user_nav_value ) $menu_label = $parent['parent'] . '<i class="fas fa-angle-right" style="margin:0 10px;"></i>' . $child;
            $menu_markup .= '<li' . ( $child_id == $user_nav_value ? ' class="active"' : '' ) . '><a href="' . ( filter_var( $child_id, FILTER_VALIDATE_URL ) ? $child_id : get_update( [ 'action' => $child_id ], tlink( 'user/account' ) ) ) . '">' . $child . '</a></li>';
        }
        $menu_markup .= '</ul>';
    } else {
        if( $parent_id == $user_nav_value ) $menu_label = $parent;
        $menu_markup .= '<li' . ( $parent_id == $user_nav_value ? ' class="active"' : '' ) . '>';
        $menu_markup .= '<a href="' . ( filter_var( $parent_id, FILTER_VALIDATE_URL ) ? $parent_id : get_update( [ 'action' => $parent_id ], tlink( 'user/account' ) ) ) . '">' . $parent . '</a>';
    }
    $menu_markup .= '</li>';
}

?>

<div class="bgGray hr-top hr-white pt-75 pb-75 clearfix">
    <div class="container">
        <div class="mb-40 clearfix">
            <?php echo do_action( 'user_before_nav' ); ?>
            <ul class="options float-left">
                <li class="contains-sub-menu pb-10"><a href="#"><?php echo ( !empty( $menu_label ) ? $menu_label : t( 'theme_admin_user_menu', 'Menu' ) ); ?> <i class="fa fa-angle-down"></i></a>
                    <ul>
                    <?php echo $menu_markup; ?>
                    </ul>
                </li>
            </ul>
            <?php echo do_action( 'user_after_nav' ); ?>
        </div>

    <?php echo do_action( 'user_account_before' );

    $action = isset( $_GET['action'] ) ? $_GET['action'] : 'general';

    if( ( $custom_content = value_with_filter( 'user_nav_content_' . $action, false ) ) ) {
        echo $custom_content;
    } else {

        switch( $action ) {

            case 'fav-stores':
                if( ( $pagination = have_favorites() ) && $pagination['results'] > 0 ) {
                    echo '<div class="list2 clearfix">';
                    foreach( favorites( [ 'orderby' => 'date desc', 'page' => $pagination['page'] ] ) as $item ) {
                        echo couponscms_store_item( $item );
                    }
                    echo '</div>';
                } else echo '<div class="alert">' . t( 'theme_no_favorite_stores',  "You don't have favorite stores yet!" ) . '</div>';
            break;

            case 'fav-coupons':
                if( ( $pagination = have_favorite_items() ) && $pagination['results'] > 0 ) {
                    echo '<div class="list clearfix">';
                    foreach( favorite_items( [ 'orderby' => 'date desc', 'page' => $pagination['page'] ] ) as $item ) {
                        echo couponscms_coupon_item( $item );
                    }
                    echo '</div>';
                } else echo '<div class="alert">' . t( 'theme_no_favorite_coupons',  "No coupons from your favorite stores!" ) . '</div>';
            break;

            case 'fav-products':
                if( ( $pagination = have_favorite_products() ) && $pagination['results'] > 0 ) {
                    echo '<div class="list clearfix">';
                    foreach( favorite_products( [ 'orderby' => 'date asc', 'page' => $pagination['page'] ] ) as $item ) {
                        echo couponscms_product_item( $item );
                    }
                    echo '</div>';
                } else echo '<div class="alert">' . t( 'theme_no_favorite_products',  "No products from your favorite stores!" ) . '</div>';
            break;

            case 'saved-stores':
                if( ( $pagination = have_saved_stores() ) && $pagination['results'] > 0 ) {
                    echo '<div class="list2 clearfix">';
                    foreach( saved_stores( [ 'orderby' => 'added_date desc', 'page' => $pagination['page'] ] ) as $item ) {
                        echo couponscms_store_item( $item );
                    }
                    echo '</div>';
                } else echo '<div class="alert">' . t( 'theme_no_saved_stores',  "You don't have stores saved!" ) . '</div>';
            break;

            case 'saved-coupons':
                if( ( $pagination = have_saved_items() ) && $pagination['results'] > 0 ) {
                    echo '<div class="list clearfix">';
                    foreach( saved_items( [ 'orderby' => 'added_date desc', 'page' => $pagination['page'] ] ) as $item ) {
                        echo couponscms_coupon_item( $item );
                    }
                    echo '</div>';
                } else echo '<div class="alert">' . t( 'theme_no_saved_coupons',  "You don't have coupons saved!" ) . '</div>';
            break;

            case 'saved-products':
                if( ( $pagination = have_saved_products() ) && $pagination['results'] > 0 ) {
                    echo '<div class="list clearfix">';
                    foreach( saved_products( [ 'orderby' => 'added_date desc', 'page' => $pagination['page'] ] ) as $item ) {
                        echo couponscms_product_item( $item );
                    }
                    echo '</div>';
                } else echo '<div class="alert">' . t( 'theme_no_saved_products',  "You don't have products saved!" ) . '</div>';
            break;

            case 'rewards':
                if( ( $pagination = have_rewards() ) && $pagination['results'] > 0 ) {
                    echo '<div class="list clearfix">';
                    foreach( rewards( [ 'orderby' => 'name desc', 'page' => $pagination['page'] ] ) as $item ) {
                        echo couponscms_reward_item( $item );
                    }
                    echo '</div>';
                } else echo '<div class="alert">' . t( 'theme_no_rewards',  'No rewards at this time!' ) . '</div>';
            break;

            case 'reward-reqs':
                if( ( $pagination = have_reward_reqs() ) && $pagination['results'] > 0 ) {
                    echo '<div class="list4 list5 clearfix">';
                    foreach( reward_reqs( [ 'orderby' => 'date desc', 'page' => $pagination['page'] ] ) as $item ) {
                        echo couponscms_reward_request_item( $item );
                    }
                    echo '</div>';
                } else echo '<div class="alert">' . t( 'theme_no_reward_reqs',  "You don't have any reward request yet!" ) . '</div>';
            break;

            case 'my-stores':
                if( ( $pagination = have_stores( [ 'show' => 'all' ] ) ) && $pagination['results'] > 0 ) {
                    echo '<div class="list2 clearfix">';
                    foreach( stores( [ 'orderby' => 'date desc', 'page' => $pagination['page'], 'show' => 'all' ] ) as $item ) {
                        echo couponscms_store_item( $item, true );
                    }
                    echo '</div>';
                } else echo '<div class="alert">' . t( 'theme_owner_no_stores',  "You don't have stores added yet!" ) . '</div>';
            break;

            case 'add-store':
                if( ( $store_price = store_price() ) > my_credits() ) echo '<div class="msg-warning">' . sprintf( t( 'theme_no_credits_add_store', "You need %s more credits to add a store. Please add more credits." ),  ( $store_price - my_credits() ) ) . '</div>';
                else {
                    if( $store_price ) echo '<div class="alert">' . sprintf( t( 'theme_credits_to_add_store', 'You will be charged with %s credits for adding a new store.' ), $store_price ) . '</div>';
                    echo '<div class="form-box full-box">';
                    echo submit_store_form();
                    echo '</div>';
                }
            break;

            case 'edit-store':
                if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) echo '<div class="alert">' . t( 'theme_no_credits_edt_store', 'You will not be charged for editing this store.' ) . '</div>';
                echo '<div class="form-box full-box">';
                echo edit_store_form( ( $storeID = ( isset( $_GET['id'] ) ? $_GET['id'] : 0 ) ), [ 'LOCATION_ADD_LINK' => '?action=add-store-location&id=' . $storeID, 'LOCATION_EDIT_LINK' => '?action=edit-store-location&id=%ID%', 'LOCATION_DELETE_LINK' => '?action=delete_store_location&id=%ID%' ] );
                echo '</div>';
            break;

            case 'add-store-location':
                echo '<div class="form-box full-box">';
                echo submit_store_location_form( ( isset( $_GET['id'] ) ? $_GET['id'] : 0 ) );
                echo '</div>';
            break;

            case 'edit-store-location':
                echo '<div class="form-box full-box">';
                echo edit_store_location_form( ( isset( $_GET['id'] ) ? $_GET['id'] : 0 ) );
                echo '</div>';
            break;

            case 'my-coupons':
                if( ( $pagination = have_coupons( [ 'show' => 'all' ] ) ) && $pagination['results'] > 0 ) {
                    echo '<div class="list mt-75 clearfix">';
                    foreach( coupons( [ 'orderby' => 'date desc', 'page' => $pagination['page'], 'show' => 'all' ] ) as $item ) {
                        echo couponscms_coupon_item( $item, true );
                    }
                    echo '</div>';
                } else echo '<div class="alert">' . t( 'theme_owner_no_coupons',  "You don't have coupons added yet!" ) . '</div>';
            break;

            case 'add-coupon':
                if( ( $coupon_price = coupon_price() ) > my_credits() ) echo '<div class="msg-warning">' . sprintf( t( 'theme_no_credits_add_coupon', "You need %s more credits to add a coupon. Please add more credits." ),  ( $coupon_price - my_credits() ) ) . '</div>';
                else {
                    if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) echo '<div class="msg-warning">' . sprintf( t( 'theme_credits_to_add_coupon', 'You will be charged with %s credits for adding a new coupon. Also, you should know that you will be charged with %s credits for every %s days when this coupon is active. Example: if the expiration date for this coupon will be after %s days (3 x %s days) you will be charged with %s credits (3 x %s credits)' ), $coupon_price, $coupon_price, ( $coupon_days = coupon_price_days() ), ( $coupon_days * 3 ), $coupon_days, ( $coupon_price * 3 ), $coupon_price ) . '</div>';
                    echo '<div class="form-box full-box">';
                    echo submit_coupon_form();
                    echo '</div>';
                }
            break;

            case 'edit-coupon':
                if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) echo '<div class="alert">' . sprintf( t( 'theme_credits_to_edit_coupon', 'You will be charged with %s credits for every %s days when this coupon is active. Example: if the expiration date for this coupon will be after %s days (3 x %s days) you will be charged with %s credits (3 x %s credits)' ), ( $coupon_price = coupon_price() ), $coupon_price, ( $coupon_days = coupon_price_days() ), ( $coupon_days * 3 ), $coupon_days, ( $coupon_price * 3 ), $coupon_price ) . '</div>';
                echo '<div class="form-box full-box">';
                echo edit_coupon_form( ( isset( $_GET['id'] ) ? $_GET['id'] : 0 ) );
                echo '</div>';
            break;

            case 'coupon-claims':
            if( isset( $_GET['id'] ) && \query\main::item_exists( $_GET['id'] ) )  {
                $coupon = \query\main::item_info( $_GET['id'] );
                if( \query\main::have_store( $coupon->storeID, $me->ID ) ) {
                    if( ( $pagination = \query\claims::have_claims( [ 'coupon' => $coupon->ID ] ) ) && $pagination['results'] > 0 ) {
                        echo '<div class="list4 list5 clearfix">';
                        foreach( \query\claims::fetch_claims( [ 'coupon' => $coupon->ID, 'orderby' => 'date desc', 'page' => $pagination['page'], 'show' => 'all' ] ) as $item ) {
                            echo couponscms_claims_item( $item );
                        }
                        echo '</div>';
                    } else echo '<div class="alert">' . t( 'theme_owner_no_coupons',  "You don't have coupons added yet!" ) . '</div>';
                } else echo '<div class="alert">' . t( 'theme_owner_not_own_coupon', "You don't own this coupon." ) . '</div>';
            } else echo '<div class="alert">' . t( 'theme_owner_not_own_coupon', "You don't own this coupon." ) . '</div>';
            break;

            case 'check':
                echo '<div class="form-box full-box">';
                echo check_coupon_code();
                echo '</div>';
            break;

            case 'my-products':
                if( ( $pagination = have_products( [ 'show' => 'all' ] ) ) && $pagination['results'] > 0 ) {
                    echo '<div class="list clearfix">';
                    foreach( products( [ 'orderby' => 'date desc', 'page' => $pagination['page'], 'show' => 'all' ] ) as $item ) {
                        echo couponscms_product_item( $item, true );
                    }
                    echo '</div>';
                } else echo '<div class="alert">' . t( 'theme_owner_no_products',  "You don't have products added yet!" ) . '</div>';
            break;

            case 'add-product':
                if( ( $product_price = product_price() ) > my_credits() ) echo '<div class="msg-warning">' . sprintf( t( 'theme_no_credits_add_product', "You need %s more credits to add a product. Please add more credits." ),  ( $product_price - my_credits() ) ) . '</div>';
                else {
                    if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) echo '<div class="alert">' . sprintf( t( 'theme_credits_to_add_product', 'You will be charged with %s credits for adding a new product. Also, you should know that you will be charged with %s credits for every %s days when this product is active. Example: if the expiration date for this product will be after %s days (3 x %s days) you will be charged with %s credits (3 x %s credits)' ), $product_price, $product_price, ( $product_days = product_price_days() ), ( $product_days * 3 ), $product_days, ( $product_price * 3 ), $product_price ) . '</div>';
                    echo '<div class="form-box full-box">';
                    echo submit_product_form();
                    echo '</div>';
                }
            break;

            case 'edit-product':
                if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) echo '<div class="alert">' . sprintf( t( 'theme_credits_to_edit_product', 'You will be charged with %s credits for every %s days when this product is active. Example: if the expiration date for this product will be after %s days (3 x %s days) you will be charged with %s credits (3 x %s credits)' ), ( $product_price = product_price() ), $product_price, ( $product_days = product_price_days() ), ( $product_days * 3 ), $product_days, ( $product_price * 3 ), $product_price ) . '</div>';
                echo '<div class="form-box full-box">';
                echo edit_product_form( ( isset( $_GET['id'] ) ? $_GET['id'] : 0 ) );
                echo '</div>';
            break;

            case 'my-claims':
                if( ( $pagination = have_claimed_items( [ 'show' => 'all' ] ) ) && $pagination['results'] > 0 ) {
                    echo '<div class="list clearfix">';
                    foreach( claimed_items( [ 'orderby' => 'date desc', 'page' => $pagination['page'], 'show' => 'all' ] ) as $item ) {
                        echo couponscms_coupon_item( $item );
                    }
                    echo '</div>';
                } else echo '<div class="alert">' . t( 'theme_owner_no_claimed_coupons',  "You don't have coupons claimed yet!" ) . '</div>';
            break;

            case 'refer-friend':
                echo '<div class="text-center">
                <h2>' . t( 'theme_referer_share_text', 'Share the following link everywhere:' ) . '</h2>
                <div class="form-box form-remove-box">
                    <input type="text" value="' . site_url() . '?ref=' . $me->ID . '" class="share-link" onClick="$(this).select()" />
                </div>
                </div>';
            break;

            case 'purchase':
                if( ( $pagination = have_payment_plans( [ 'show' => 'active' ] ) ) && $pagination['results'] > 0 ) {
                    echo '<div class="list clearfix">';
                    foreach( payment_plans( [ 'orderby' => 'date desc', 'page' => $pagination['page'], 'show' => 'active' ] ) as $item ) {
                        echo couponscms_plans_item( $item );
                    }
                    echo '</div>';
                } else echo '<div class="alert">' . t( 'theme_no_plans',  'No plans at this moment. Please check again later.' ) . '</div>';
            break;

            default:
                echo '<div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-box full-box">
                        ' . add( 'filter', 'top_profile_link_classes', function( $classes ) {
                            return $classes . ' button-active';
                        }) .
                        edit_profile_form() . '
                        </div>
                    </div>
                    <div class="col-12 col-md-6 m-mt-30">
                        <div class="form-box full-box">
                        ' . change_password_form() . '
                        </div>
                    </div>
                </div>';
            break;
        }

    }

    echo do_action( 'user_account_after' ); 
    
    if( isset( $pagination ) ) {
        echo couponscms_theme_pagination( $pagination );
    } ?>

    </div>
</div>