<?php if( ( $me = me() ) ) { ?>

<?php if( logout() ) { ?>

<div class="pt50 pb50">

<div class="pt-100 pb-100 clearfix">
    <div class="container text-center">
        <h1 class="mb-25"><?php echo sprintf( t( 'theme_logout_title', '<strong>%s</strong>, we hope you will come back soon !' ), $me->Name ); ?></h1>
        <h3><?php echo sprintf( t( 'theme_logout_msg', 'You will be redirected in %s seconds.' ), '<span id="redirect-in">5</span>' ); ?></h3>
    </div>
</div>

</div>

<script>

var redirect = document.getElementById( 'redirect-in' );
var seconds = parseInt( redirect.innerHTML );

var goto = setInterval(function(){

if( seconds < 2 ) {
  location.href = '<?php echo site_url(); ?>';
  clearInterval( goto );
} else {
  seconds--;
  redirect.innerHTML = seconds;
}

}, 1000);

</script>

<?php

} else echo read_template_part( '404' );

} else echo read_template_part( '404' );

?>