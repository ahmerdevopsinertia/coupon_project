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



<div class="newslet">
    <div class="bgwhite hero-search pt-75 pb-75 clearfix" id="newsletter_form">
        <div class="container">
            <h2 class="bucket-title1">Never miss another deal.</h2>
            <div class="search-form-container mt-50">
                <div class="subscribe_form other_form">
                    <form method="POST" action="custom_newsletter.php">
                        <input type="email" name="newsletter_form_index_form[email]" value="" placeholder="Email Address" required=""><input type="hidden" name="newsletter_form_index_form[csrf]" value="mKhA7YUQ68ZR">
                        <button>Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        console.log('location', location.search);
        var queryString = (location.search != undefined ? location.search.split('=') : FALSE);
        if (queryString) {
            if (queryString[0] == '?sub') {
                if (queryString[1] == 1) {
                    alert('Successfully Subscribed');
                } else {
                    alert('Sorry failed to Subscribed');
                }
            }
        }
    });
</script>