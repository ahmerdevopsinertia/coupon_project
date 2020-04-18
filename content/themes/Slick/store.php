<?php



$store = the_item();
$avg_store_rating = 0;

$atts = [];

$default_orderby = 'newest';
$orderby_attr = 'date desc';

if (!empty($_GET['orderby'])) {

    $orderby = ['newest' => 'date desc', 'oldest' => 'date'];

    if (in_array($_GET['orderby'], array_keys($orderby))) {
        $default_orderby = $_GET['orderby'];
    }

    $orderby_attr = $orderby[$default_orderby];
}

$active = [1, '<i class="far fa-circle"></i>'];

if (!empty($_GET['active'])) {
    $active = [0, '<i class="fas fa-check-circle"></i>'];
    $atts['show'] = 'active';
}

$type = searched_type(); ?>
<div class="backgrnd">
    <div class="hero-title">
        <div class="container">
            <h2><?php tse($store->name); ?></h2>
        </div>
    </div>
</div>

<div class="pt-75 pb-75 hr-bottom clearfix backgrnd">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="store-logo text-center">
                    <img src="<?php echo store_avatar((!empty($store->image) ? $store->image : '')); ?>" alt="<?php tse($store->name); ?>" />
                    <a href="<?php echo $store->reviews_link; ?>"><?php echo couponscms_rating((int) $store->stars, $store->reviews); ?></a>
                </div>
                <div class="button-set">
                    <!--      <a href="#" class="button big" data-ajax-call="<?php echo ajax_call_url("favorite"); ?>" data-data='<?php echo json_encode(array('store' => $store->ID, 'added_message' => '<i class="fa fa-heart"></i> ' . t('theme_remove_favorite', 'Remove favorite'), 'removed_message' => '<i class="far fa-heart"></i> ' . t('theme_add_favorite', 'Add favorite'))); ?>'><?php echo (is_favorite($store->ID) ? '<i class="fa fa-heart"></i> ' . t('theme_remove_favorite', 'Remove favorite') : '<i class="far fa-heart"></i> ' . t('theme_add_favorite', 'Add favorite')); ?></a>
                    <a href="#" class="button big" data-ajax-call="<?php echo ajax_call_url("save"); ?>" data-data='<?php echo json_encode(array('item' => $store->ID, 'type' => 'store', 'added_message' => '<i class="fa fa-star"></i> ' . t('theme_unsave_store', 'Unsave this store'), 'removed_message' => '<i class="far fa-star"></i> ' . t('theme_save_store', 'Save this store'))); ?>'><?php echo (is_saved($store->ID, 'store') ? '<i class="fa fa-star"></i> ' . t('theme_unsave_store', 'Unsave this store') : '<i class="far fa-star"></i> ' . t('theme_save_store', 'Save this store')); ?></a>
                    <a href="<?php echo tlink('plugin/rss2', 'store=' . $store->ID); ?>" class="button big"><i class="fa fa-rss"></i> <?php te('theme_store_rss', 'RSS Feed'); ?></a>
                    <a href="<?php echo $store->reviews_link; ?>" class="button big"><i class="fa fa-pencil-alt"></i> <?php te('theme_write_review', 'Write Review'); ?></a> -->
                    <?php if (!empty($store->url)) { ?>
                        <a href="<?php echo get_target_link('store', $store->ID); ?>" target="_blank" class="button big"><i class="fa fa-link"></i> Visit <?php tse($store->name); ?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 offset-lg-1 m-mt-30">
                <h6><?php te('theme_t_s_description', 'Description'); ?></h6>
                <?php echo (!empty($store->description) ? ts($store->description) : t('theme_no_description', 'No description.'));
                if ($store->is_physical) {
                    echo '<ul class="store-info-list">';
                    if (!empty($store->hours)) {
                        $today = strtolower(date('l'));
                        echo '<li><a href="#" class="hours"><h6><i class="far fa-clock"></i> ' . sprintf(t('theme_store_hours_today', 'Hours ( Today: %s )'), (isset($store->hours[$today]['opened']) ? $store->hours[$today]['from'] . ' - ' . $store->hours[$today]['to'] : t('theme_store_closed', 'Closed'))) . '</a></h6>';
                        $daysofweek = days_of_week();
                        echo '<ul class="store-hours">';
                        foreach ($daysofweek as $day => $dayn) {
                            echo '<li' . ($day === $today ? ' class=\'htoday\'' : '') . '><span>' . $dayn . ':</span> <b>' . (isset($store->hours[$day]['opened']) ? $store->hours[$day]['from'] . ' - ' . $store->hours[$day]['to'] : t('theme_store_closed', 'Closed')) . '</b></li>';
                        }
                        echo '</ul>
                    </li>';
                    }
                    if (!empty($store->phone_no)) {
                        echo '<li><h6><i class="fa fa-phone"></i> ' . t('theme_phone_no', 'Phone Number') . '</h6>' . $store->phone_no . '</li>';
                    }
                    $locations = store_locations($store->ID);
                    if (!empty($locations)) {
                        echo '<li><h6><i class="fas fa-map-marker-alt"></i> ' . t('theme_t_s_locations', 'Locations') . '</h6><ul class="store-locations">';
                        foreach ($locations as $location) {
                            echo '<li data-lat="' . $location->lat . '" data-lng="' . $location->lng . '" data-title="' . implode(', ', array($location->city, $location->state)) . '" data-content="' . implode(', ', array($location->address, $location->zip)) . '">
                            <a href="#" data-map-recenter="' . $location->lat . ',' . $location->lng . '">' . implode(', ', array($location->address, $location->zip, $location->city, $location->state, $location->country)) . '</a> <a href="//www.google.com/maps?saddr=My+Location&daddr=' . implode(',', [$location->lat, $location->lng]) . '" class="get-direction" target="_blank"><i class="fas fa-walking"></i> ' . t('theme_get_directions', 'Get directions') . '</a>
                        </li>';
                        }
                        echo '</ul>';
                    }
                    if (google_maps() && !empty($locations)) {
                        $map_zoom = get_theme_option('map_zoom');
                        $map_marker_icon = get_theme_option('map_marker_icon'); ?>
                        <li id="map_wrapper">
                            <div id="map_canvas" data-zoom="<?php echo (!empty($map_zoom) && is_numeric($map_zoom) ? (int) $map_zoom : 16); ?>" data-lat="<?php echo $locations[0]->lat; ?>" data-lng="<?php echo $locations[0]->lng; ?>" data-marker-icon="<?php echo (!empty($map_marker_icon) ? $map_marker_icon : THEME_LOCATION . '/assets/img/pin.png'); ?>"></div>
                        </li>
                <?php }
                    echo '</ul>';
                } ?>
                <div>
                    <script language="javascript" type="text/javascript">
                        $(function() {
                            var avgRating = $('#avg_rating').val();
                            $("#rating_star").spaceo_rating_widget({
                                starLength: '5',
                                initialValue: avgRating,
                                callbackFunctionName: 'processRating',
                                imageDirectory: '/content/uploads/images/',
                                inputAttr: 'post_id'
                            });
                        });

                        function processRating(val, attrVal) {
                            var storeId = $('#store_id_for_rating').val();
                            $.ajax({
                                type: 'POST',
                                url: '/rating.php',
                                data: 'post_id=' + storeId + '&points=' + val,
                                dataType: 'json',
                                success: function(data) {
                                    if (data.status == 'ok') {
                                        alert('You have rated ' + val);
                                        $('#avgrat').text(data.average_rating);
                                        $('#totalrat').text(data.rating_number);
                                    } else {
                                        alert('please after some time.');
                                    }
                                },
                                error: function(err) {
                                    // console.log('err', err);
                                    alert('You have rated ' + val);
                                }
                            });
                        }
                    </script>
                    <br>
                    <?php $avg_store_rating = get_store_rating($store->ID)['average_rating'];  ?>
                    <input id="avg_rating" name="avg_rating" value="<?php echo $avg_store_rating; ?>" type="hidden" />
                    <input id="store_id_for_rating" name="store_id_for_rating" value="<?php echo $store->ID; ?>" type="hidden" />
                    <input name="rating" value="0" id="rating_star" type="hidden" postID="1" />
                    <div class="overall-rating">(Average Rating <span id="avgrat"><?php echo $avg_store_rating; ?></span>
                        Based on <span id="totalrat"><?php echo get_store_rating($store->ID)['rating_number']; ?></span> rating)</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bgGray pt-75 pb-75 clearfix">
    <div class="container">
        <?php echo do_action('store_before_items'); ?>

        <div class="mb-40 clearfix">
            <?php $types = array();
            $types['coupons'] = array('label' => t('coupons', 'Coupons'), 'url' => get_update(array('type' => 'coupons'), get_remove(array('page', 'type'))));
            if (couponscms_has_products()) {
                $types['products'] = array('label' => t('', ''), 'url' => get_update(array('type' => 'products'), get_remove(array('page', 'type'))));
            } ?>
            <ul class="options float-left">
                <li class="contains-sub-menu pb-10"><a href="#"><?php echo $types[$type]['label']; ?> <i class="fa fa-angle-down"></i></a>
                    <ul>
                        <?php foreach ($types as $cur_type => $type2) {
                            echo '<li' . ($cur_type == $type ? ' class="active"' : '') . '><a href="' . $type2['url'] . '">' . $type2['label'] . '</a></li>';
                        } ?>
                    </ul>
                </li>
            </ul>
            <a href="<?php echo get_update(['active' => $active[0]], get_remove(['page'])); ?>" class="float-right"><?php echo $active[1] . ' ' . t('theme_active_only', 'Active only'); ?></a>
        </div>
        <div class="date-time">
            <strong><?php tse($store->name); ?> Coupons & Promo Codes For <?php echo date("jS F Y"); ?></strong> | Updated 5 hours ago
        </div>

        <?php if ($type === 'products') {

            if (($results = have_products(array('show' => (!empty($atts) ? implode(',', $atts) : '')))) && $results['results']) {
                echo '<div class="list clearfix">';
                foreach (products(array('show' => (!empty($atts) ? implode(',', $atts) : ''), 'orderby' => $orderby_attr)) as $item) {
                    echo couponscms_product_item($item);
                }
                echo '</div>';
            } else {
                echo '<div class="alert">' . sprintf(t('theme_no_products_store',  '%s has no products yet.'), ts($store->name)) . '</div>';
                echo '<div class="list clearfix">';
                foreach (products_custom(array('show' => 'visible,active', 'orderby' => 'rand', 'max' => option('items_per_page'))) as $item) {
                    echo couponscms_product_item($item);
                }
                echo '</div>';
            }
        } else {

            if (($results = have_items(array('show' => (!empty($atts) ? implode(',', $atts) : '')))) && $results['results']) {
                echo '<div class="list clearfix">';
                foreach (items(array('show' => (!empty($atts) ? implode(',', $atts) : ''), 'orderby' => $orderby_attr)) as $item) {
                    echo couponscms_coupon_item($item);
                }
                echo '</div>';
            } else {
                echo '<div class="list clearfix">';
                echo '<div class="">' . '<h3>Check Out Coupons For Similar Stores</h3>' . '</div>';
                foreach (items_custom(array('show' => ',active', 'orderby' => 'rand', 'max' => option('items_per_page'))) as $item) {
                    echo couponscms_coupon_item($item, false, true);
                }
                echo '</div>';
            }
        } ?>
        <?php if (isset($results)) {
            echo couponscms_theme_pagination($results);
        }

        echo do_action('store_after_items'); ?>


        <div class="coups_sidebar_inner">
            <div class="about_store">
                <h2>About <?php tse($store->name); ?></h2>
                <p></p>
                <p><?php tse($store->name); ?> has currently 35 deals &amp; coupons on xxcoupons.com that will help you to get discounts you wouldn't have imagined. <?php tse($store->name); ?>. offers the best prices &amp; more. <?php tse($store->name); ?> Coupon will help you save an average of $15. For more savings and discounts, please visit the official online store of <?php tse($store->name); ?></p>
                <p></p>
            </div>

            <div class="store_stats">
                <h2>Store Stats For <?php tse($store->name); ?></h2>
                <ul>
                    <li>Average Saving: $15</li>
                    <li>Total Active Coupons: 14</li>
                    <li>Coupon Codes: 0</li>
                    <li>Deals: 14</li>
                </ul>
            </div>

        </div>


        <div class="related_stores">
            <h2>Related Stores</h2>
            <ul>
                <li><a href="https://www.xxcoupons.com/store/debrox">Debrox <span>(6)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/adika">Adika Coupons
                        <span>(6)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/biore">Biore Coupons
                        <span>(6)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/mixtiles">Mixtiles Coupons
                        <span>(6)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/andersen">Andersen Coupons
                        <span>(6)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/osprey">Osprey Coupons <span>(6)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/dove">Dove Coupons <span>(6)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/colorescience">Colorescience Coupons <span>(5)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/kahoot">Kahoot Coupons <span>(5)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/tinkle">TINKLE Coupons <span>(4)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/crest">Crest Coupons <span>(7)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/revlon">Revlon Coupons <span>(4)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/maya_brenner">Maya Brenner Coupons <span>(4)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/krave_beauty">krave beauty Coupons <span>(8)</span></a></li>
                <li><a href="https://www.xxcoupons.com/store/beakey">BEAKEY Coupons <span>(5)</span></a></li>
            </ul>
        </div>



        <div class="storeInfo">
            <h2>Some quick FAQs about <?php tse($store->name); ?> coupons &amp; promo codes</h2>
            <p>Welcome to the <?php tse($store->name); ?> page on xxcoupons.com. Here you can find the biggest available collection of <?php tse($store->name); ?> coupons and online codes. We are excited to provide you 0 coupon codes, 14 promotional sales coupons. You can also find a variety of in-store deals for <?php tse($store->name); ?>. </p>

            <button class="accordion">
                <h4>What are the <?php tse($store->name); ?> newest coupon codes?</h4>
            </button>
            <div class="panel">
                <p>View all Products</br>
                    <?php tse($store->name); ?> Operator Cover with Screw Holes in White Color</p>
            </div>

            <button class="accordion">
                <h4>What amount can I save on average, using <?php tse($store->name); ?> coupon codes?</h4>
            </button>
            <div class="panel">
                <p>The average discount for <?php tse($store->name); ?> is you can have $15 at checkout.</p>
            </div>

            <button class="accordion">
                <h4>When did the last coupon update?</h4>
            </button>
            <div class="panel">
                <p>The latest coupon was updated 7 hours ago.</p>
            </div>

            <button class="accordion">
                <h4>How can I be notified about the latest coupon codes for <?php tse($store->name); ?>?</h4>
            </button>
            <div class="panel">
                <p>Simply subscribe to the xxcoupons.com newsletter for <?php tse($store->name); ?>. New deals and discount offers will be directly sent to your inbox. Trust us, we won't spam you at all.</p>

            </div>

            <button class="accordion">
                <h4>I'm an absolute noob. Please guide me how to use the codes?</h4>
            </button>
            <div class="panel">
                <p>Easy peasy...</p>
                <p>Just follow the process given below to use the <?php tse($store->name); ?> coupon:</p>
                <ul>
                    <li>First, shop your favorite product from <?php tse($store->name); ?></li <li>Add the product in cart and click <strong>"check out"</strong></li>
                    <li>Now, simply Google <strong>"xxcoupons <?php tse($store->name); ?> coupon"</strong></li>
                    <li>Click the link of store page of xxcoupons for <?php tse($store->name); ?></li>
                    <li>Locate your desired coupon or deal and click on <strong>"Show code"</strong></li>

                </ul>
                <p>Deals are automatically applied. In case of code, you need to copy and paste the <?php tse($store->name); ?> code in the discount box to save money. </p>
            </div>

            <button class="accordion">
                <h4>Can I submit a <?php tse($store->name); ?> coupon code?</h4>
            </button>
            <div class="panel">
                <p>That's great. Please submit the code by using our "Submit a code" form. After all, sharing is caring!</p>

            </div>

            <button class="accordion">
                <h4>What else can I do?</h4>
            </button>
            <div class="panel">
                <p>Subscribe for our new coupon alerts and bookmark this page for future use. Happy couponing!</p>

            </div>

            <script>
                var acc = document.getElementsByClassName("accordion");
                var i;
                for (i = 0; i < acc.length; i++) {
                    acc[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        var panel = this.nextElementSibling;
                        if (panel.style.display === "block") {
                            panel.style.display = "none";
                        } else {
                            panel.style.display = "block";
                        }
                    });
                }
            </script>
        </div>

    </div>
</div>