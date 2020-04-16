<?php

switch( $_GET['action'] ) {

/** ADD POST */

case 'add':

echo '<div class="title">

<h2>Add Post</h2>
<div style="float:right;margin:0 2px 0 0;">
    <a href="?plugin=Blog/blog.php&amp;action=list" class="btn">Posts</a>
</div>

<span>Add a new blog post</span>

</div>';

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['csrf'] ) && isset( $_POST['post'] ) && check_csrf( $_POST['csrf'], 'blog_plugin_csrf' ) ) {

    $post = $_POST['post'];

    if( isset( $post['title'] ) && isset( $post['text'] ) && isset( $post['image'] ) && isset( $post['language'] ) && isset( $post['publish_date'] ) )
    if( \plugin\Blog\inc\actions::add( [
        'title'         => $post['title'],
        'text'          => $post['text'],
        'image'         => $post['image'],
        'language'      => $post['language'],
        'publish_date'  => ( !empty( $post['post_now'] ) ? date( 'Y-m-d,H:i' ) : $post['publish_date']['date'] . ',' . $post['publish_date']['hour'] ),
        'publish'       => ( isset( $post['publish'] ) ? 1 : 0 ),
        'meta_title'    => $_POST['meta_title'],
        'meta_keywords' => $_POST['meta_keywords'],
        'meta_desc'     => $_POST['meta_desc']
    ] ) ) {

    echo '<div class="a-success">Added!</div>';
    } else
    echo '<div class="a-error">Error!</div>';

}

$csrf = $_SESSION['blog_plugin_csrf'] = \site\utils::str_random(10);

echo '<div class="form-table">

<form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">';

$fields                 = [];
$fields['title']        = [ 'type' => 'text',      'title' => 'Title' ];
$fields['text']         = [ 'type' => 'textarea',  'title' => 'Text', 'atts' => [ 'style' => 'height:250px;' ] ];
$fields['language']     = [ 'type' => 'select',    'title' => 'Language', 'options' => array_map( function( $lang ) {
    return $lang['name'];
}, \site\language::languages() ) ];
$fields['image']        = [ 'type' => 'image',     'title' => 'Featured Image', 'cat_id' => 'blog' ];
$fields['post_now']     = [ 'type' => 'checkbox',  'title' => 'Publish Date', 'label' => 'Set post date', 'default' => true ];
$fields['publish_date'] = [ 'type' => 'callback',  'title' => 'Set Publishing Date', 'callback' => function() {
    return '<input name="post[publish_date][date]" value="' . date( 'Y-m-d', strtotime( 'now' ) ) . '" class="datepicker" style="display:inline-block;width:68%;margin-right:2%" type="date"><input name="post[publish_date][hour]" value="' . date( 'H:i', strtotime( 'now' ) ) . '" class="hourpicker" style="display:inline-block;width:30%" type="time">';
}, 'atts' => [ 'style' => 'display:none;' ], 'required' => [ 'post[post_now]' => 0 ] ];
$fields['publish']      = [ 'type' => 'checkbox',  'title' => 'Publish', 'label' => 'Publish this post or uncheck to save it as draft', 'default' => true ];
echo build_form( 'post', $fields, [] )['markup'];

echo '<div id="modify_mt">

<div class="title">
    <h2>' . t( 'pages_title_meta', "Modify Personalized Meta-Tags" ) . '</h2>
</div>

<div class="content">';

$fields = $GLOBALS['admin_main_class']->meta_tags_fields( [], $csrf, true );

uasort( $fields, function( $a, $b ) {
    if( (double) $a['position'] === (double) $b['position'] ) return 0;
    return ( (double) $a['position'] < (double) $b['position'] ? -1 : 1 );
} );

foreach( $fields as $key => $f ) {
    echo $f['markup'];
}

echo '</div>

</div>

<input type="hidden" name="csrf" value="' . $csrf . '" />

<div class="twocols">
    <div>
        <button class="btn btn-important">Add Post</button>
    </div>
    <div>
        <a href="#" class="btn" id="modify_mt_but">' . t( 'pages_editmt_button', "Meta Tags" ) . '</a>
    </div>
</div>

</form>

</div>';

break;

/** EDIT POST */

case 'edit':

echo '<div class="title">

<h2>Edit Post</h2>

<div style="float:right;margin: 0 2px 0 0;">
    <a href="?plugin=Blog/blog.php&amp;action=list" class="btn">Posts</a>
</div>

<span>Edit post</span>

</div>';

if( isset( $_GET['id'] ) && \plugin\Blog\inc\posts::exists( $_GET['id'], true ) ) {

$info = \plugin\Blog\inc\posts::info( $_GET['id'], true );

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['csrf'] ) && check_csrf( $_POST['csrf'], 'blog_plugin_csrf' ) ) {

if( isset( $_POST['change_url_title'] ) ) {

    if( isset( $_POST['url_title'] ) )
    if( \plugin\Blog\inc\actions::edit_url( $_GET['id'], [ 'title' => $_POST['url_title'] ] ) ) {

    $info = \plugin\Blog\inc\posts::info( $_GET['id'] );

    echo '<div class="a-success">' . t( 'msg_saved', "Saved!" ) . '</div>';

    } else
    echo '<div class="a-error">' . t( 'msg_error', "Error!" ) . '</div>';

} else if( isset( $_POST['post'] ) ) {

    $post = $_POST['post'];

    if( isset( $post['title'] ) && isset( $post['text'] ) && isset( $post['image'] ) && isset( $post['language'] ) && isset( $post['publish_date'] ) )
    if( \plugin\Blog\inc\actions::update( [
        'title'         => $post['title'],
        'text'          => $post['text'],
        'image'         => $post['image'],
        'language'      => $post['language'],
        'publish_date'  => implode( ',', $post['publish_date'] ),
        'publish'       => ( isset( $post['publish'] ) ? 1 : 0 ),
        'meta_title'    => $_POST['meta_title'],
        'meta_keywords' => $_POST['meta_keywords'],
        'meta_desc'     => $_POST['meta_desc']
    ] ) ) {

    $info = \plugin\Blog\inc\posts::info( $_GET['id'], true );

    echo '<div class="a-success">Saved!</div>';
    } else
    echo '<div class="a-error">Error!</div>';

}

}

$csrf = $_SESSION['blog_plugin_csrf'] = \site\utils::str_random(10);

echo '<div class="form-table">

<form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">';

$fields                 = [];
$fields['title']        = [ 'type' => 'text',      'title' => 'Title' ];
$fields['text']         = [ 'type' => 'textarea',  'title' => 'Text', 'atts' => [ 'style' => 'height:250px;' ] ];
$fields['language']     = [ 'type' => 'select',    'title' => 'Language', 'options' => array_map( function( $lang ) {
    return $lang['name'];
}, \site\language::languages() ) ];
$fields['image']        = [ 'type' => 'image',     'title' => 'Featured Image', 'cat_id' => 'blog' ];
$fields['publish_date'] = [ 'type' => 'callback',  'title' => 'Publishing Date', 'callback' => function() use ( $info ) {
    return '<input name="post[publish_date][date]" value="' . date( 'Y-m-d', strtotime( $info->date ) ) . '" class="datepicker" style="display:inline-block;width:68%;margin-right:2%" type="date"><input name="post[publish_date][hour]" value="' . date( 'H:i', strtotime( $info->date ) ) . '" class="hourpicker" style="display:inline-block;width:30%" type="time">';
} ];
$fields['publish']      = [ 'type' => 'checkbox',  'title' => 'Publish', 'label' => 'Publish this post or uncheck to save it as draft' ];
echo build_form( 'post', $fields, [
    'title'     => $info->title,
    'text'      => $info->text,
    'language'  => $info->language,
    'image'     => $info->image,
    'publish'   => $info->is_visible
] )['markup'];

echo '<div id="modify_mt">

<div class="title">
    <h2>' . t( 'pages_title_meta', "Modify Personalized Meta-Tags" ) . '</h2>
</div>

<div class="content">';

$fields = $GLOBALS['admin_main_class']->meta_tags_fields( $info, $csrf, true );

uasort( $fields, function( $a, $b ) {
    if( (double) $a['position'] === (double) $b['position'] ) return 0;
    return ( (double) $a['position'] < (double) $b['position'] ? -1 : 1 );
} );

foreach( $fields as $key => $f ) {
    echo $f['markup'];
}

echo '</div>

</div>

<input type="hidden" name="csrf" value="' . $csrf . '" />

<div class="twocols">
    <div><button class="btn btn-important">Edit Post</button></div>
    <div>
        <a href="#" class="btn" id="modify_mt_but">' . t( 'pages_editmt_button', "Meta Tags" ) . '</a>
    </div>
</div>

</form>

</div>';

echo '<div class="title" style="margin-top:40px;">

<h2>Information About This Post</h2>

</div>';

echo '<div class="info-table" id="info-table" style="padding-bottom:20px;">

<form action="?plugin=Blog/blog.php&amp;action=edit&amp;id=' . $info->ID . '#info-table" method="POST" autocomplete="off">';
echo '<div class="row"><span>Page URL:</span> <div class="modify_url">
<div' . ( isset( $_GET['editurl'] ) ? ' style="display: none;"' : '' ) . '><a href="' . $info->link . '" target="_blank">' . $info->link . '</a> / <a href="?plugin=Blog/blog.php&amp;action=edit&amp;id=' . $info->ID . '&amp;editurl#info-table">Edit</a></div>
<div' . ( !isset( $_GET['editurl'] ) ? ' style="display: none;"' : '' ) . '>
<input type="text" name="url_title" value="' . $info->url_title . '" placeholder="' . $info->title . '" style="display:block;width:100%;box-sizing:border-box;" />
<input type="hidden" name="csrf" value="' . $csrf . '" />
<button name="change_url_title" class="btn save">' . t( 'save', "Save" ) . '</button> <a href="?plugin=Blog/blog.php&amp;action=edit&amp;id=' . $info->ID . '#info-table" class="btn close">' . t( 'cancel', "Cancel" ) . '</a>
</div>
</div></div>';

if( \query\main::user_exists( $info->last_update_by ) ) {
    $user = \query\main::user_info( $info->last_update_by );
    echo '<div class="row"><span>Last update by:</span> <div><a href="?route=users.php&amp;action=edit&amp;id=' . $info->last_update_by . '"">' . $user->name . '</a></div></div>  ';
}

echo '<div class="row"><span>Last update on:</span> <div>' . $info->last_update . '</div></div>  ';

if( \query\main::user_exists( $info->user ) ) {
    $user = \query\main::user_info( $info->user );
    echo '<div class="row"><span>Author:</span> <div><a href="?route=users.php&amp;action=edit&amp;id=' . $info->user . '"">' . $user->name . '</a></div></div>  ';
}

echo '</form>

</div>';

} else echo '<div class="a-error">Invalid ID</div>';

break;

/** LIST OF POSTS */

default:

echo '<div class="title">

<h2>Blog Posts</h2>';

echo '<div style="float:right;margin:0 2px 0 0;">
    <a href="?plugin=Blog/blog.php&amp;action=add" class="btn">Add Post</a>
</div>

<span>Posts list</span>

</div>';

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['csrf'] ) && check_csrf( $_POST['csrf'], 'blog_plugin_csrf' ) ) {

    if( isset( $_POST['delete'] ) ) {

        if( isset( $_POST['id'] ) )
        if( \plugin\Blog\inc\actions::delete( array_keys( $_POST['id'] ) ) )
        echo '<div class="a-success">Deleted!</div>';
        else
        echo '<div class="a-error">Error!</div>';

    } else if( isset( $_POST['set_action'] ) ) {

        if( isset( $_POST['id'] ) && isset( $_POST['action'] ) )
        if( plugin\Blog\inc\actions::action( $_POST['action'], array_keys( $_POST['id'] ) ) )
        echo '<div class="a-success">Saved!</div>';
        else
        echo '<div class="a-error">Error!</div>';

    }

} else if( isset( $_GET['action'] ) && isset( $_GET['token'] ) && check_csrf( $_GET['token'], 'blog_plugin_csrf' ) ) {

    if( $_GET['action'] == 'delete' ) {

        if( isset( $_GET['id'] ) )
        if( plugin\Blog\inc\actions::delete( $_GET['id'] ) )
        echo '<div class="a-success">Deleted!</div>';
        else
        echo '<div class="a-error">Error!</div>';

    } else if( $_GET['type'] == 'publish' || $_GET['type'] == 'unpublish' ) {

        if( isset( $_GET['id'] ) )
        if( plugin\Blog\inc\actions::action( $_GET['type'], $_GET['id'] ) )
        echo '<div class="a-success">Saved!</div>';
        else
        echo '<div class="a-error">Error!</div>';

    }

}

$languages = \site\language::languages();

$csrf = $_SESSION['blog_plugin_csrf'] = \site\utils::str_random(10);

echo '<div class="page-toolbar">

<form action="#" method="GET" autocomplete="off">
<input type="hidden" name="plugin" value="Blog/blog.php" />
<input type="hidden" name="action" value="list" />

 Order by:
<select name="orderby">';
foreach( [ 'date' => "Date", 'date desc' => "Date DESC" ] as $k => $v ) echo '<option value="' . $k . '"' . ( isset( $_GET['orderby'] ) && urldecode( $_GET['orderby'] ) == $k || !isset( $_GET['orderby'] ) && $k == 'date desc' ? ' selected' : '' ) . '>' . $v . '</option>';
echo '</select>

<select name="language">
<option value="all">All languages</option>';
foreach( $languages as $k => $v ) echo '<option value="' . $k . '"' . ( isset( $_GET['language'] ) && $_GET['language'] == $k ? ' selected' : '' ) . '>' . $v['name'] . '</option>';
echo '</select>';

if( isset( $_GET['search'] ) ) {
    echo '<input type="hidden" name="search" value="' . esc_html( $_GET['search'] ) . '" />';
}

echo ' <button class="btn">View</button>

</form>

<form action="#" method="GET" autocomplete="off">
<input type="hidden" name="plugin" value="Blog/blog.php" />
<input type="hidden" name="action" value="list" />';

if( isset( $_GET['orderby'] ) ) {
    echo '<input type="hidden" name="orderby" value="' . esc_html( $_GET['orderby'] ) . '" />';
}

if( isset( $_GET['category'] ) ) {
    echo '<input type="hidden" name="category" value="' . esc_html( $_GET['category'] ) . '" />';
}

echo '<input type="search" name="search" value="' . (isset( $_GET['search'] ) ? esc_html( $_GET['search'] ) : '') . '" placeholder="Search in posts" />
<button class="btn">Search</button>
</form>

</div>';

$p = \plugin\Blog\inc\posts::have_posts( $options = [ 'per_page' => 10, 'search' => ( isset( $_GET['search'] ) ? urldecode( $_GET['search'] ) : '' ), 'language' => ( !empty( $_GET['language'] ) && in_array( $_GET['language'], array_keys( $languages ) ) ? $_GET['language'] : 'all' ), 'show' => 'all' ] );

echo '<div class="results">' . ( (int) $p['results'] === 1 ? sprintf( "<b>%s</b> result", $p['results'] ) : sprintf( "<b>%s</b> results", $p['results'] ) );
if( !empty( $_GET['search'] ) || !empty( $_GET['language'] ) ) echo ' / <a href="?plugin=Blog/blog.php&amp;action=list">Reset view</a>';
echo '</div>';

if( $p['results'] ) {

echo '<form action="?plugin=Blog/blog.php&amp;action=list" method="POST">

<ul class="elements-list">

<li class="head"><input type="checkbox" id="selectall" data-checkall /> <label for="selectall"><span></span> Name</label></li>';

echo '<div class="bulk_options">';

echo 'Action: ';
echo '<select name="action">';
foreach( [ 'publish' => "Publish", 'unpublish' => "Unpublish" ] as $k => $v ) echo '<option value="' . $k . '">' . $v . '</option>';
echo '</select>
<button class="btn" name="set_action">Set to All</button> ';

echo '<button class="btn" name="delete" data-delete-msg="Are you sure that you want to delete this?">Delete All</button> ';

echo '</div>';

foreach( \plugin\Blog\inc\posts::fetch_posts( array_merge( [ 'page' => $p['page'], 'orderby' => ( isset( $_GET['orderby'] ) ? urldecode( $_GET['orderby'] ) : 'date desc' ) ], $options ) ) as $item ) {

    echo '<li>
    <div>

    <input type="checkbox" name="id[' . $item->ID . ']" id="id[' . $item->ID . ']" /> <label for="id[' . $item->ID . ']"><span></span></label>';

    if( !filter_var( $item->image, FILTER_VALIDATE_URL ) ) {
        $image = @json_decode( $item->image );
        if( $image ) {
            $item->image = site_url( current( $image ) );
        }
    }

    echo '<img src="' . $item->image . '" alt="" style="display:inline-block;width:80px;min-width:80px;height:auto;min-height:40px;" />

    <div class="info-div"><h2>' . ( !$item->is_visible ? '<span class="msg-alert">Not published</span> ' : '' ) . $item->title . '
    <span class="fright date">' . date( 'Y.m.d, ' . ( \query\main::get_option( 'hour_format' ) == 12 ? 'g:i A' : 'G:i' ), strtotime( $item->date ) ) . '</span></h2>';
    if( \query\main::user_exists( $item->user ) ) {
        $user = \query\main::user_info( $item->user );
        echo 'Published by: <a href="?route=users.php&amp;action=edit&amp;id=' . $item->user . '"">' . $user->name . '</a>';
    }
    if( in_array( $item->language, array_keys( $languages ) ) ) {
        echo '<div style="margin-top:10px;"><img src="' . $languages[$item->language]['image'] . '" style="height:20px;float:left;margin-right:10px;" alt="" /> ' . $languages[$item->language]['name'] . '</div>';
    }
    echo '</div>

    </div>

    <div style="clear:both;"></div>

    <div class="options">';
    echo '<a href="?plugin=Blog/blog.php&amp;action=edit&amp;id=' . $item->ID . '">Edit</a>
    <a href="' . \site\utils::update_uri( '', [ 'type' => ( !$item->is_visible ? 'publish' : 'unpublish' ), 'id' => $item->ID, 'token' => $csrf ] ) . '">' . ( !$item->is_visible ? 'Publish' : 'Unpublish' ) . '</a>
    <a href="' . \site\utils::update_uri( '', [ 'action' => 'delete', 'id' => $item->ID, 'token' => $csrf ] ) . '" data-delete-msg="Are you sure that you want to delete this?">Delete</a>';
    echo '</div>
    </li>';

}

echo '</ul>

<input type="hidden" name="csrf" value="' . $csrf . '" />

</form>';

if( isset( $p['prev_page'] ) || isset( $p['next_page'] ) ) {
    echo '<div class="pagination">';

    if( isset( $p['prev_page'] ) ) echo '<a href="' . $p['prev_page'] . '" class="btn">&larr; Prev</a>';
    if( isset( $p['next_page'] ) ) echo '<a href="' . $p['next_page'] . '" class="btn">Next &rarr;</a>';

    if( $p['pages'] > 1 ) {
    echo '<div class="pag_goto">' . sprintf( "Page <b>%s</b> of <b>%s</b>", $page = $p['page'], $pages = $p['pages'] ) . '
    <form action="#" method="GET">';
    foreach( $_GET as $gk => $gv ) if( $gk !== 'page' ) echo '<input type="hidden" name="' . esc_html( $gk ) . '" value="' . esc_html( $gv ) . '" />';
    echo '<input type="number" name="page" min="1" max="' . $pages . '" size="5" value="' . $page . '" />
    <button class="btn">Go</button>
    </form>
    </div>';
    }

    echo '</div>';
}

} else echo '<div class="a-alert">No posts yet.</div>';

break;

}