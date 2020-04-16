<?php 
echo do_action( 'index_before_search' );
couponscms_search_form();
echo do_action( 'index_after_search' ); ?>



<div class="container pt50 pb50">
<div class="row">
        <div class="col-md-4">
<a href="/out/12063110"><img class="" src="https://mediaservice.retailmenot.com/image/7LI2FCATMBFVRF7BT5LEB7JXV4?width=350" alt="20% Cash Back "><div class="carousel-slide-content"><div class="carousel-slide-media"><img class="" src="https://www.retailmenot.com/thumbs/logos/m/qvc.com-coupons.jpg?versionId=Gxs8ev.Syh3DwbrkFs_m_brD1oGa8q_d" alt="QVC"></div> <div class="carousel-slide-text-wrapper"> <h3 class="carousel-slide-title"> 20% Cash Back </h3> <p class="carousel-slide-text"> QVC Online Cash Back </p> </div></div></a>
</div>

<div class="col-md-4">
<a href="/out/12063110"><img class="" src="https://mediaservice.retailmenot.com/image/7LI2FCATMBFVRF7BT5LEB7JXV4?width=350" alt="20% Cash Back "><div class="carousel-slide-content"><div class="carousel-slide-media"><img class="" src="https://www.retailmenot.com/thumbs/logos/m/qvc.com-coupons.jpg?versionId=Gxs8ev.Syh3DwbrkFs_m_brD1oGa8q_d" alt="QVC"></div> <div class="carousel-slide-text-wrapper"> <h3 class="carousel-slide-title"> 20% Cash Back </h3> <p class="carousel-slide-text"> QVC Online Cash Back </p> </div></div></a>
</div>

<div class="col-md-4">
<a href="/out/12063110"><img class="" src="https://mediaservice.retailmenot.com/image/7LI2FCATMBFVRF7BT5LEB7JXV4?width=350" alt="20% Cash Back "><div class="carousel-slide-content"><div class="carousel-slide-media"><img class="" src="https://www.retailmenot.com/thumbs/logos/m/qvc.com-coupons.jpg?versionId=Gxs8ev.Syh3DwbrkFs_m_brD1oGa8q_d" alt="QVC"></div> <div class="carousel-slide-text-wrapper"> <h3 class="carousel-slide-title"> 20% Cash Back </h3> <p class="carousel-slide-text"> QVC Online Cash Back </p> </div></div></a>
</div>
</div>
</div>




<div class="container pt50 pb50">

	 <?php if( $featured_top_widgets = show_widgets( 'featured_top' ) ) { ?>
    <div class="row">
        <div class="col-md-12">
            <?php echo do_action( 'before_widgets_featured_top' );
            echo $featured_top_widgets;
            echo do_action( 'after_widgets_featured_top' ); ?>
        </div>
    </div>
    <?php } ?>
  
    <div class="row">
        <div class="col-md-6">

        <?php echo couponscms_home_items(); ?>

        </div>

 <div class="col-md-6">

</div>


   <div class="col-md-4">
            <?php echo do_action( 'before_widgets_right' );
            echo show_widgets( 'right' );
            echo do_action( 'after_widgets_right' ); ?>
        </div>
    </div>

   <?php if( $featured_bottom_widgets = show_widgets( 'featured_bottom' ) ) { ?>
    <div class="row">
        <div class="col-md-12 bottom-widgets">
            <?php echo do_action( 'before_widgets_featured_bottom' );
            echo $featured_bottom_widgets;
            echo do_action( 'after_widgets_featured_bottom' ); ?>
        </div>
    </div>
    <?php } ?>

</div>