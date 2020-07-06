<?php

function couponscms_store_item($item = object, $owner_view = false)
{

    $item->is_owner_view = $owner_view;

    $markup = do_action('before_store_outside', $item);

    $markup .= '
    <div class="item">
        ' . do_action('before_store_inside', $item) . '
        <div class="image">
        ' . ($item->image != NULL ? '<img src="' . store_avatar($item->image) . '" alt="' . ts($item->name) . '" />' : '<div style="margin: 18px;">' . $item->name . '</div>') . '
        </div>
        <div class="bottom clearfix">
            <a href="' . $item->link . '">' . ts($item->name) . '</a>';
    if (($rating = couponscms_rating((int) $item->stars, $item->reviews))) {
        $markup .= '<a href="' . $item->reviews_link . '#reviews" class="rating">' . $rating . '</a>';
    }
    if ($owner_view) {
        $markup .= '<div><a href="' . get_update(array('action' => 'edit-store', 'id' => $item->ID)) . '" class="button">' . t('edit', 'Edit') . '</a></div>';
    }
    $markup .= '</div>
    ' . do_action('after_store_inside', $item) . '
    </div>'
        . do_action('after_store_outside', $item);

    return $markup;
}

function couponscms_store_item_custom($item = object, $owner_view = false)
{

    $item->is_owner_view = $owner_view;

    $markup = do_action('before_store_outside', $item);

    $markup .= '
    <div class="item">
        ' . do_action('before_store_inside', $item) . '
        <div class="image">
        ' . ($item->image != NULL ? '<img src="' . store_avatar($item->image) . '" alt="' . ts($item->name) . '" />' : '<div style="margin: 18px;">' . $item->name . '</div>') . '
        </div>
        <div class="bottom clearfix">
            <a href="' . $item->link . '">' . ts($item->name) . '</a>';
    if (($rating = couponscms_rating((int) $item->stars, $item->reviews))) {
        $markup .= '<a href="' . $item->reviews_link . '#reviews" class="rating">' . $rating . '</a>';
    }
    if ($owner_view) {
        $markup .= '<div><a href="' . get_update(array('action' => 'edit-store', 'id' => $item->ID)) . '" class="button">' . t('edit', 'Edit') . '</a></div>';
    }
    $markup .= '</div>
    ' . do_action('after_store_inside', $item) . '
    </div>'
        . do_action('after_store_outside', $item);

    return $markup;
}

function couponscms_store_item_two($item = object, $owner_view = false)
{ 
    $markup = '<div class="item"><div class="bottom clearfix"><a href="' . $item->link . '">' . ts($item->name) . '</a></div></div>';
    return $markup;
}

function couponscms_store_item_three($item = object, $owner_view = false)
{

    $item->is_owner_view = $owner_view;

    $markup = do_action('before_store_outside', $item);

    $markup .= '
    <div class="item">
        ' . do_action('before_store_inside', $item) . '
        <div class="image">
        ' . ($item->image != NULL ? '<img src="' . store_avatar($item->image) . '" alt="' . ts($item->name) . '" />' : '<div style="margin: 18px;">' . $item->name . '</div>') . '
        </div>
        <div class="bottom clearfix">
            <a href="' . $item->link . '">' . ts($item->name) . '</a>';
    if ($owner_view) {
        echo "Owner View";
        $markup .= '<div><a href="' . get_update(array('action' => 'edit-store', 'id' => $item->ID)) . '" class="button">' . t('edit', 'Edit') . '</a></div>';
    }
    $markup .= '</div>
    ' . do_action('after_store_inside', $item) . '
    </div>'
        . do_action('after_store_outside', $item);

    return $markup;
}
