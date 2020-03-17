<?php

switch( $_GET['action'] ) {

default:

echo '<div class="title">

<h2>Blog Options</h2>

<span>Modify Blog settings</span>

</div>';

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['csrf'] ) && isset( $_POST['options'] ) && check_csrf( $_POST['csrf'], 'blog_plugin_csrf' ) ) {

  $options = $_POST['options'];

  if( isset( $options['title'] ) && isset( $options['index_slug'] ) && isset( $options['single_slug'] ) && isset( $options['date_format'] ) && isset( $options['hero_image'] ) )
  if( admin\actions::set_option( [
    'blog_title'            => $options['title'],
    'blog_index_slug'       => $options['index_slug'],
    'blog_single_slug'      => $options['single_slug'],
    'blog_date_format'      => $options['date_format'],
    'blog_hero_image'       => $options['hero_image'],
    'blog_items_per_page'   => $options['items_per_page']
    ] ) ) {

    do_action( 'blog_options_saved', $options );

    echo '<div class="a-success">Saved!</div>';

  } else
  echo '<div class="a-error">Error!</div>';

}

$csrf = $_SESSION['blog_plugin_csrf'] = \site\utils::str_random(10);

echo '<div class="form-table">

<form action="#" method="POST">';

$fields                     = [];
$fields['title']            = [ 'type' => 'text',      'title' => 'Blog Title' ];
$fields['index_slug']       = [ 'type' => 'text',      'title' => 'Blog Index Slug',   'info' => 'Change blog\'s location from ' . site_url() . 'blog' ];
$fields['single_slug']      = [ 'type' => 'text',      'title' => 'Blog Article Slug', 'info' => 'Change article\'s location from ' . site_url() . BLOG_INDEX_SLUG . '/article' ];
$fields['date_format']      = [ 'type' => 'text',      'title' => 'Date Format' ];
$fields['hero_image']       = [ 'type' => 'image',     'title' => 'Hero Cover Image',  'info' => 'Format example: m.d.Y, H:i', 'cat_id' => 'blog' ];
$fields['items_per_page']   = [ 'type' => 'number',    'title' => 'Posts Per Page' ];
echo build_form( 'options', value_with_filter( 'blog_options', $fields ), value_with_filter( 'blog_options_values', [
  'title'           => \query\main::get_option( 'blog_title' ),
  'index_slug'      => \query\main::get_option( 'blog_index_slug' ),
  'single_slug'     => \query\main::get_option( 'blog_single_slug' ),
  'date_format'     => \query\main::get_option( 'blog_date_format' ),
  'hero_image'      => \query\main::get_option( 'blog_hero_image' ),
  'items_per_page'  => \query\main::get_option( 'blog_items_per_page' )
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