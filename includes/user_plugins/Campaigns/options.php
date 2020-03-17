<?php

switch( $_GET['action'] ) {

default:

echo '<div class="title">

<h2>Campaigns Options</h2>

<span>Modify Campaigns settings</span>

</div>';

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['csrf'] ) && isset( $_POST['options'] ) && check_csrf( $_POST['csrf'], 'campaigns_plugin_csrf' ) ) {

  $options = $_POST['options'];

  if( isset( $options['single_slug'] ) )
  if( admin\actions::set_option( [
    'campaigns_slug'            => $options['single_slug'],
    'campaigns_items_per_page'  => $options['items_per_page']
    ] ) ) {

    do_action( 'campaigns_options_saved', $options );

    echo '<div class="a-success">Saved!</div>';

  } else
  echo '<div class="a-error">Error!</div>';

}

$csrf = $_SESSION['campaigns_plugin_csrf'] = \site\utils::str_random(10);

echo '<div class="form-table">

<form action="#" method="POST">';

$fields                     = [];
$fields['single_slug']      = [ 'type' => 'text',      'title' => 'Campaign Slug', 'info' => 'Change campaign\'s location from ' . site_url() . CAMPAIGNS_SLUG . '/black_friday' ];
$fields['items_per_page']   = [ 'type' => 'number',    'title' => 'Items Per Page' ];
echo build_form( 'options', value_with_filter( 'campaigns_options', $fields ), value_with_filter( 'campaigns_options_values', [
  'single_slug'     => \query\main::get_option( 'campaigns_slug' ),
  'items_per_page'  => \query\main::get_option( 'campaigns_items_per_page' )
] ) )['markup'];

echo '<input type="hidden" name="csrf" value="' . $csrf . '" />

<div class="twocols">
    <div><button class="btn btn-important">Save Options</button></div>
    <div></div>
</div>

</form>

</div>';

break;

}