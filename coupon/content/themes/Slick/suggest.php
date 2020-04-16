<div class="bgGray">
    <div class="hero-title">
        <div class="container">
            <h2><?php te( 'theme_suggest_title', 'Suggest a Store/Brand' ); ?></h2>
        </div>
    </div>
</div>

<div class="pt-75 pb-75 clearfix">
    <div class="container">
        <div class="form-box">
            <?php echo suggest_store_form( array('intent' => ( me() ? 1 : 2 ) ) ); ?>
        </div>
    </div>
</div>