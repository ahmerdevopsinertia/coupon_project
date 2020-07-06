<?php

$types              = [];
$types['all']       = array('label' => t('theme_all_stores', 'All Stores'),  'url' => get_remove(array('page', 'type', 'firstchar')),                                                'orderby' => 'name',        'firstchar' => true,    'show' => 'visible');
$types['top']       = array('label' => t('theme_top_stores', 'Top Stores'),  'url' => get_update(array('type' => 'top'), get_remove(array('page', 'type', 'firstchar'))),        'orderby' => 'rating desc', 'firstchar' => false,   'show' => 'visible',       'limit' => 50);
$types['popular']   = array('label' => t('theme_most_popular', 'Popular'),   'url' => get_update(array('type' => 'popular'), get_remove(array('page', 'type', 'firstchar'))),    'orderby' => 'votes desc',  'firstchar' => false,   'show' => 'visible,popular', 'limit' => 500);

$type = isset($_GET['type']) && in_array($_GET['type'], array_keys($types)) ? $_GET['type'] : 'all';

$atts = [];

if (isset($_GET['firstchar']) && $types[$type]['firstchar']) {
    $atts['firstchar'] = substr($_GET['firstchar'], 0, 1);
}

$atts['show'] = $types[$type]['show'];

if (isset($types[$type]['limit'])) {
    $atts['limit'] = $types[$type]['limit'];
}

have_items($atts); ?>
</br></br></br></br></br>
<div class="bgGray">

</div>

<div class="backgrnd">
    <div class="pt-50 pb-50 hr-bottom clearfix">
        <div class="container">
            <div class="list3 owl-carousel clearfix">
                <?php foreach (categories_custom(['show' => 'cats', 'max' => 0]) as $cat) { ?>
                    <div class="item">
                        <div class="icon">
                            <i class="<?php echo (!empty($cat->extra['icon']) ? esc_html($cat->extra['icon']) : 'fas fa-list-ul'); ?>"></i>
                        </div>
                        <div class="bottom clearfix">
                            <div class="title">
                                <a href="<?php echo get_update(['type' => 'stores'], $cat->link); ?>"><?php echo $cat->name; ?></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="bgGray pt-75 pb-75 clearfix">
    <div class="container">
        <div class="mb-40 clearfix">
            <ul class="options float-left">
                <li class="contains-sub-menu pb-10"><a href="#"><?php echo $types[$type]['label']; ?> <i class="fa fa-angle-down"></i></a>
                    <ul>
                        <?php foreach ($types as $cur_type => $type2) {
                            echo '<li' . ($cur_type == $type ? ' class="active"' : '') . '><a href="' . $type2['url'] . '">' . $type2['label'] . '</a></li>';
                        } ?>
                    </ul>
                </li>
            </ul>
        </div>
        <?php if ($type === 'all') {
            if (results()) {
                $last_letter = '';
                $markup = '';
                $newItemsArray = items_custommmm(NULL, NULL);
                foreach ($newItemsArray as $item) {
                    $markup .= couponscms_store_item_two($item);
                }
                echo "<div class='list2 clearfix'>" . $markup . "</div>";
            } else {
                $markup = '<div class="alert">' . t('theme_no_stores_list',  'Huh :( No stores found here.') . '</div>';
                echo $markup;
            };
        } else { ?>
            <div class="list2 clearfix">
                <?php if (results()) {
                    foreach (items((array('orderby' => $types[$type]['orderby']) + $atts)) as $item) {
                        echo couponscms_store_item($item);
                    }
                } else echo '<div class="alert">' . t('theme_no_stores_list',  'Huh :( No stores found here.') . '</div>'; ?>
            </div>
            <?php echo couponscms_theme_pagination(navigation()); ?>
        <?php } ?>
    </div>
</div>