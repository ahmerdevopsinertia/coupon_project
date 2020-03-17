<?php $store = the_item();
$review_form = write_review_form(); ?>

<div class="bgGray">
    <div class="hero-title">
        <div class="container">
            <h2><?php echo sprintf( t( 'theme_store_reviews', '%s Reviews' ), ts( $store->name ) ); ?></h2>
        </div>
    </div>
</div>

<div class="pt-75 pb-75 hr-bottom clearfix">
    <div class="container">
        <?php echo do_action( 'store_reviews_before_info' ); ?>
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="store-logo text-center">
                    <img src="<?php echo store_avatar( ( !empty( $store->image ) ? $store->image : '' ) ); ?>" alt="<?php tse( $store->name ); ?>" />
                    <a href="<?php echo $store->reviews_link; ?>"><?php echo couponscms_rating( (int) $store->stars, $store->reviews ); ?></a>
                </div>
                <div class="button-set">
                    <?php if( !empty( $store->url ) ) { ?>
                    <a href="<?php echo get_target_link( 'store', $store->ID ); ?>" class="button big"><i class="fa fa-link"></i> <?php te( 'theme_store_visit', 'Visit Website' ); ?></a>
                    <?php } ?>
                    <a href="<?php echo $store->link; ?>" class="button big"><i class="fa fa-arrow-left"></i><?php echo sprintf( t( 'theme_back_to_store', 'Back to %s' ), ts( $store->name ) ); ?></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 offset-lg-1 m-mt-30">
                <?php if( have_items() ) { ?>
                <div class="list4 clearfix">
                    <?php foreach( items( array( 'orderby' => 'date desc' ) ) as $item ) { ?>
                        <?php echo couponscms_review_item( $item ); ?>
                    <?php } ?>
                </div>
                <?php echo couponscms_theme_pagination( navigation() );
                } else echo '<div class="alert">' . sprintf( t( 'theme_no_reviews_store',  '%s has no reviews yet.' ), ts( $store->name ) ) . '</div>'; ?>
            </div>
        </div>
        <?php echo do_action( 'store_reviews_after_info' ); ?>
    </div>
</div>

<div class="bgGray text-center pt-75 pb-75 clearfix">
    <div class="container">
        <h2 class="mb-40"><?php te( 'theme_add_review_title', 'Add Review' ); ?></h2>
        <div class="form-box text-left form-remove-box">
        <?php echo $review_form; ?>
        </div>
    </div>
</div>