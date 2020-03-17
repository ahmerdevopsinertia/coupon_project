<?php echo couponscms_home_items(); ?>

<div class="bgGray">
    <div class="hero-title">
        <div class="container">
            <h2><?php echo esc_html( ts( option( 'blog_title' ) ) ); ?></h2>
        </div>
    </div>
</div>

<div class="bgWhite mt-75 mb-75 clearfix">
    <div class="container">
        <?php if( $results['results'] ) { ?>
        <div class="row posts">
        <?php foreach( $posts as $post ) { ?>
            <div class="col-12 col-md-4">
                <div class="post">
                <?php if( !filter_var( $post->image, FILTER_VALIDATE_URL ) ) {
                    $image = @json_decode( $post->image );
                    if( $image ) {
                        $post->image = site_url( current( $image ) );
                    }
                } ?>
                <a href="<?php echo $post->link; ?>">
                    <div class="img-container">
                        <div class="image" style="background-image:url('<?php echo $post->image; ?>');"></div>
                    </div>
                    <h6><?php echo $post->title; ?></h6>
                </a>
                </div>
            </div>
        <?php } ?>
        </div>
        <?php echo couponscms_theme_pagination( $results ); ?> 
        <?php } ?>
    </div>
</div>