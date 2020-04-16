<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 text-center text-md-left m-mb-30">
                <a href="<?php echo tlink( 'index' ); ?>"><img src="https://www.xxcoupons.com/Asset 3.png" class="w50" alt="" /></a>
</br></br>© 2020 xxcoupons</br>
All Rights Reserved
            </div>

            <div class="col-6 col-md-2 text-center text-md-left">
                <h6><?php te( 'theme_company', 'Company' ); ?></h6>
                <ul>
                    <?php echo couponscms_menu( 'footer_company' ); ?>
                    <li><a href="https://www.xxcoupons.com/about_us"><?php te( 'theme_about_title', 'About Us' ); ?></a></li>
                    <li><a href="https://www.xxcoupons.com/privacy_policy"><?php te( 'theme_privacy_title', 'Privacy Policy' ); ?></a></li>
                    <li><a href="https://www.xxcoupons.com/contact"><?php te( 'theme_contact_title', 'Contact Us' ); ?></a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2 text-center text-md-left">
                <h6><?php te( 'stores', 'Stores' ); ?></h6>
                <ul class="flinks">
                    <li><a href="<?php echo tlink( 'stores' ); ?>"><?php te( 'theme_all_stores', 'All Stores' ); ?></a></li>
                    <li><a href="<?php echo tlink( 'stores', 'type=top' ); ?>"><?php te( 'theme_top_stores', 'Top Stores' ); ?></a></li>
                    <li><a href="<?php echo tlink( 'tpage/suggest' ); ?>"><?php te( 'theme_make_a_suggestion', 'Make A Suggestion' ); ?></a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2 text-center text-md-left m-mt-30">
                <h6><?php te( 'coupons', 'Coupons' ); ?></h6>
                <ul class="flinks">
                    <li><a href="<?php echo tlink( 'tpage/coupons', 'type=recent' ); ?>"><?php te( 'theme_coupons_recently_added', 'Recently Added' ); ?></a></li>
                    <li><a href="<?php echo tlink( 'tpage/coupons', 'type=expiring_soon' ); ?>"><?php te( 'theme_coupons_expiring_soon', 'Expiring Soon' ); ?></a></li>
                    <li><a href="<?php echo tlink( 'tpage/coupons', 'type=codes' ); ?>"><?php te( 'theme_coupons_codes', 'Coupon Codes' ); ?></a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2 text-center text-md-left m-mt-30">
            <?php $networks = social_networds();
            if( isset( $networks['myspace'] ) ) unset( $networks['myspace'] );
            if( !empty( $networks ) ) {
                echo '<h6>' . t( 'theme_social_profiles', 'Connect' ) . '</h6>';

                echo '<ul class="social-links">';
                foreach( $networks as $name => $url ) {
                    echo '<li><a href="' . esc_html( $url ) . '"><i class="fab fa-' . $name . '"></i> ' . ucfirst( $name ) . '</a></li>';
                }
                echo '</ul>';
            } ?>
            </div>
        </div>
    </div>
  <div class="footer text-center text-md-left bgGray">
        <div class="container">
        <?php $site_desc = description();
        if( !empty( $site_desc ) ) {
            echo '<span class="site_desc">' . $site_desc . '</span>';
        } ?>
        </div>
    </div>
</footer>



</body>

</html>