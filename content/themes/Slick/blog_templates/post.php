<?php if( !defined( 'DIR' ) ) die; ?>

<div class="bgGray">
    <div class="hero-title">
        <div class="container">
            <h2><?php echo $post->title; ?></h2>
        </div>
    </div>
</div>

<div class="bgWhite mt-75 mb-75 clearfix">
    <div class="container">
        <div class="row show-progress-bar">
            <div class="col-md-2 d-none d-md-block">
                <a href="<?php echo blog_link(); ?>" class="goto-link"><i class="fas fa-angle-left"></i><?php echo esc_html( ts( option( 'blog_title' ) ) ); ?></a>
            </div>
            <div class="col-md-8">
                <div class="blog-single-content">
                    <?php echo $post->text; ?>
                </div>
            </div>
            <div class="col-md-2 text-center text-md-right m-mt-30">
                <div class="goto-links">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post->link; ?>" class="goto-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $post->title ); ?>&url=<?php echo $post->link; ?>" class="goto-link"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <?php if( $post->navigation->prev_exists() || $post->navigation->next_exists() ) { ?>
        <div class="row mt-75">
            <div class="col-6">
            <?php if( $post->navigation->prev_exists() ) {
                $prev_post = $post->navigation->prev_post();
                echo '<a href="' . $prev_post->link . '" class="goto-link"><i class="fas fa-angle-left"></i><span>' . $prev_post->title . '</span></a>';
            } ?>
            </div>
            <div class="col-6 text-right">
            <?php if( $post->navigation->next_exists() ) {
                $next_post = $post->navigation->next_post();
                echo '<a href="' . $next_post->link . '" class="goto-link goto-link-right"><span>' . $next_post->title . '</span><i class="fas fa-angle-right"></i></a>';
            } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>