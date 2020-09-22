
<?php 

$loc = '_index_form';
$pd = \site\utils::validate_user_data( $_POST['newsletter_form' . $loc] );
$id = $GLOBALS['me'] ? $GLOBALS['me']->ID : 0;

try {
  $type = \user\main::subscribe( $id, $pd );  
}
catch (Exception $e) {
  echo $e->getMessage();
}
header( 'Location: /' );
?>