<!DOCTYPE html>
<html>

<head>
<?php echo add_head(); ?>
</head>

<body<?php echo ( ( $body_classes = body_classes() ) ? ' class="' . $body_classes . '"' : ''); ?>>


<?php

$tel = get_theme_option( 'contact_tel' );
$email = get_theme_option( 'contact_email' );
$languages = couponscms_site_languages();

if( !empty( $tel ) || !empty( $email ) || !empty( $languages ) ) { ?>

<div class="menu-top-links">
    <div class="container">
        <div class="row">
            <ul class="col-6 inline-ul-list">
                <?php if( !empty( $tel ) ) echo '<li><i class="fa fa-phone"></i> ' . esc_html( $tel ) . '</li>';
                if( !empty( $email ) ) echo '<li><i class="fa fa-envelope"></i> ' . esc_html( $email ) . '</li>'; ?>
            </ul>
            <?php echo $languages; ?>
        </div>
    </div>
</div>

<?php } ?>

<div class="menu-middle-links">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center-m">
                <a href="<?php echo tlink( 'index' ); ?>">
                    <img src="<?php echo site_logo( THEME_LOCATION . '/assets/img/logo.png' ); ?>" alt="" />
                </a>
            </div>
            <div class="col-md-6 text-right text-center-m dnone-m">
         <nav>
                    <div class="mobile-nav dnone dblock-m">
                        <div class="mmenu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="mobile-nav-links dnone">
                        
                        </div>
                    </div>
                    <ul class="main-nav dnone-m">
                        <?php echo couponscms_menu( 'main' ); ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="main-nav-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav>
                    <div class="mobile-nav dnone dblock-m">
                        <div class="mmenu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                       </div>
                   <ul class="main-nav dnone-m">
                        <?php echo couponscms_menu( 'main' ); ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>