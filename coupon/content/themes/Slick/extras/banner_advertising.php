<?php

/* BANNER ADVERTISING */

function banner_advertising_order_page() {
    echo '<div class="pt-100 pb-100 clearfix">
        <div class="container">
            <div class="title-options">
                <h2>Banner advertising</h2>
            </div>
        </div>
    </div>';

    echo '<div class="mb-100 clearfix">
        <div class="container">
            <div class="row">';

                if( !me() ) {
                    echo '<div class="col-md-12 other_form"><div class="alert">Please sign in to add a banner into this place.</div></div>';
                } else if( \plugin\BannerAdvertising\inc\banners::exists() ) {
                    $info = \plugin\BannerAdvertising\inc\banners::info();
                    $my_credits = me()->Credits;

                    if( $info->ph_visible && $info->is_available ) {

                        echo '<div class="col-md-8 banner_advertising_form other_form">';

                            if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['csrf'] ) && isset( $_POST['opt'] ) && \site\utils::check_csrf( $_POST['csrf'], 'banner_advertising_csrf' ) ) {

                                try {
                                    \plugin\BannerAdvertising\inc\actions::user_update( array_merge( $_POST['opt'], array( 'image' => isset( $_FILES['banner_image'] ) ? $_FILES['banner_image'] : array() ) ) );
                                    echo '<div class="success">Your banner has been uploaded.</div>';
                                }

                                catch( Exception $e ) {
                                    echo '<div class="error">' . $e->getMessage() . '</div>';
                                }

                            }

                            $csrf = $_SESSION['banner_advertising_csrf'] = \site\utils::str_random(10);
                            $cmin = array();

                            echo '<form action="#" method="POST" enctype="multipart/form-data">

                                <div class="form_field">
                                    <label>Terms of Use:</label>
                                    <div>' . nl2br( esc_html( \query\main::get_option( 'banner_adv_tos' ) ) ) . '</div>
                                </div>

                                <div class="form_field banner-advertising-lp">
                                    <label>Choose An Option:</label>';
                                    if( !empty( $info->plans ) ) {
                                        foreach( $info->plans as $plan_index => $plan ) {
                                            if( isset( $plan['credits'] ) && isset( $plan['days'] ) ) {
                                                $cmin[] = $plan['credits'];
                                                echo '<div><input name="opt[plan]" id="bannerPlan_' . $plan_index . '" type="radio" value="' . $plan_index . '" style="float:left; width:auto; margin-right:5px;"' . ( $plan_index == 0 ? ' checked' : '' ) . ( $plan['credits'] > $my_credits ? ' disabled' : '' ) . '><label for="bannerPlan_' . $plan_index . '">' . sprintf( '%s Credits for %s Days', $plan['credits'], $plan['days'] ) . '</label></div>';
                                            }
                                        }
                                    } else echo '<div>-</div>';

                                echo '</div>

                                <div class="form_field">
                                    <label for="opt[image]">Banner Image (size: ' . $info->width . 'x' . $info->height . '):</label>
                                    <div><input name="banner_image" id="opt[image]" class="inputFile" type="file"></div>
                                </div>

                                <div class="form_field">
                                    <label for="opt[target]">Target URL:</label>
                                    <div><input name="opt[target]" id="opt[target]" type="text" placeholder="http://" required></div>
                                </div>

                                <input type="hidden" name="csrf" value="' . $csrf . '" />

                                <button' . ( empty( $cmin ) || min($cmin ) > $GLOBALS['me']->Credits ? ' class="button-disabled" onClick="return false;"' : '' ) . '>Add Banner</button>

                            </form>
                        </div>

                        <div class="col-md-4 other_form text-center">
                            <h5>' . sprintf( 'Your Balance: %s Credits', $my_credits ) . '</h5>';
                            if( have_payment_plans() ) {
                                echo '<form action="' . tlink( 'pay' ) . '" method="GET">

                                    <div class="form_field"><div>
                                        <select name="plan">';
                                        foreach( payment_plans( array( 'max' => 0, 'orderby' => 'price' ) ) as $payment_plan ) {
                                            echo '<option value="' . $payment_plan->ID . '">' . $payment_plan->credits . ' Credits (' . $payment_plan->price_format . ')</option>';
                                        }
                                        echo '</select>
                                    </div></div>

                                    <button>Add Credits</button>

                                </form>';
                            }
                        echo '</div>';

                    } else echo '<div class="col-md-12 other_form"><div class="error">This place is no longer available.</div></div>';
                } else echo '<div class="col-md-12 other_form"><div class="error">This place is no longer available.</div></div>';

            echo '</div>
        </div>
    </div>';
}