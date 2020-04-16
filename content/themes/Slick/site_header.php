<!DOCTYPE html>
<html>

<head>
<?php echo add_head(); ?>
<script data-ad-client="ca-pub-1602320060135073" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body<?php echo ( ( $body_classes = body_classes() ) ? ' class="' . $body_classes . '"' : ''); ?>>

<div class="bgGray">

<header class="menu-container">
    <div class="header-menu container">
        <div class="logo">
            <a href="<?php echo tlink( 'index' ); ?>"><img src="<?php echo site_logo( THEME_LOCATION . '/assets/img/logo.png' ); ?>" alt="" /></a>
        </div>
        <ul class="menu">

        </ul>
        <ul class="menu text-right">
                    <?php echo ( $menu = couponscms_menu( 'main' ) ); ?>


        </ul>
        <div class="mob-menu">
            <a href="#">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
        </div>
    </div>

    <div class="mobile-overlay">
        <div class="mobile-menu">
            <div>
                <ul class="menu">
                <?php echo $menu; ?>
                </ul>
                <ul class="user-links">
                 <li><a href="#" class="show-search"><i class="fas fa-search"></i></a></li>
                    <?php echo $languages; ?>
                </ul>
            </div>
            <div>
                <div class="container">
                    <?php echo couponscms_search_form( 'clearfix', false ); ?>
                    <a href="#" class="mt-30 d-block close-search"><i class="fa fa-angle-left"></i> <?php te( 'back_to_menu', 'Back to menu' ); ?></a>
                </div>
            </div>
        </div>
    </div>

</header>

<div class="menu-spacer"></div>

<?php if( this_is_home_page() ) { 
    echo couponscms_search_form();
} ?>

</div>