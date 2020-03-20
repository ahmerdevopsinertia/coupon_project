<?php echo couponscms_home_items(); ?>
<?php echo couponscms_view_store_coupons(); ?>





<div class="pt-50 pb-50 hr-bottom clearfix">
    <div class="container">
        <div class="list3 owl-carousel clearfix">
            <?php foreach (categories_custom(['show' => 'cats', 'max' => 0]) as $cat) { ?>
                <div class="item">
                    <div class="icon">
                        <i class="<?php echo (!empty($cat->extra['icon']) ? esc_html($cat->extra['icon']) : 'fas fa-list-ul'); ?>"></i>
                    </div>
                    <div class="bottom clearfix">
                        <div class="title">
                            <a href="<?php echo get_update(['type' => 'stores'], $cat->link); ?>"><?php echo $cat->name; ?></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>



<div class="bgGray hero-search pt-75 pb-75 clearfix" id="subscribe_form">
    <div class="container">
        <h2 class="text-center mb-0">Don't miss anything !</h2>
        <div class="search-form-container mt-50">
            <div class="subscribe_form other_form">
                <div class="success">You had been successfully subscribed, thank you!</div>
                <form method="POST" action="#subscribe_form">
                    <input type="email" name="newsletter_form_index_form[email]" value="" placeholder="Email Address" required=""><input type="hidden" name="newsletter_form_index_form[csrf]" value="HARni7e5zaFp">
                    <button>Subscribe</button>
                </form>

            </div>
        </div>
    </div>
</div>