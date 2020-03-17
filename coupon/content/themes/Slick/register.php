<div class="bgGray">
    <div class="hero-title">
        <div class="container">
            <h2><?php te( 'theme_register_title', 'Create Account' ); ?></h2>
        </div>
    </div>
</div>

<div class="pt-75 pb-75 clearfix">
    <div class="container">
        <div class="form-box">
            <?php echo register_form( tlink( 'user/account' ) ); ?>
            <div class="bottom-box text-left"><a href="<?php echo tlink( 'tpage/login' ); ?>"><i class="fas fa-angle-left"></i> <?php te( 'theme_login_button', 'Sign In' ); ?></a></div>
        </div>
    </div>
</div>