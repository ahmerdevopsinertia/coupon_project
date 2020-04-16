<div class="bgGray">
    <div class="hero-title">
        <div class="container">
            <h2><?php te( 'theme_login_title', 'Login' ); ?></h2>
        </div>
    </div>
</div>

<div class="pt-75 pb-75 clearfix">
    <div class="container">
        <div class="form-box">
            <?php echo login_form( tlink( 'user/account' ) ); ?>
            <div class="bottom-box"><a href="<?php echo tlink( 'tpage/password-recovery' ); ?>"><?php te( 'theme_password_recovery', 'Password recovery' ); ?></a></div>
        </div>
    </div>
</div>