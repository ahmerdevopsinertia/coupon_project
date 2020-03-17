<?php

/* THERE OPTIONS */
if( !function_exists( 'theme_options' ) ) {
    function theme_options() {
        // id => options
        $options                    =   [];
        $options['search_title']    =   [ 'type' => 'text',      'title' => t( 'theme_options_search_title', 'Search Box Title' ),   'placeholder' => t( 'theme_options_search_title_ph', 'Search for coupons, products or stores' ) ];
        $options['search_image']    =   [ 'type' => 'image',     'title' => t( 'theme_options_search_image', 'Search Box Image' ),   'cat_id' => 'to', 'info' => t( 'theme_options_search_image_info', 'Background image URL used for search box.' ) ];
        $options['date_format']     =   [ 'type' => 'text',      'title' => t( 'theme_options_date_format', 'Date Format' ),         'default' => 'd.m.Y', 'info' => t( 'theme_options_date_format_info', 'Default date format is: d.m.Y' ) ];
        $options['map_zoom']        =   [ 'type' => 'number',    'title' => t( 'theme_options_map_zoom', 'Map Zoom' ),               'default' => 16 ];
        $options['map_marker_icon'] =   [ 'type' => 'image',     'title' => t( 'theme_options_map_marker_icon', 'Map Marker Icon' ), 'default' => THEME_LOCATION . '/assets/img/pin.png', 'cat_id' => 'to' ];
        $options['site_multilang']  =   [ 'type' => 'checkbox',  'title' => t( 'theme_options_multilang', 'Multi Language' ),        'label' => t( 'theme_options_multilang_label', 'Display language switcher with flags' ) ];
        $options['extra_css']       =   [ 'type' => 'textarea',  'title' => t( 'theme_options_extra_css', 'Extra CSS' ) ];
        $options['extra_js']        =   [ 'type' => 'textarea',  'title' => t( 'theme_options_extra_js', 'Extra JS' ) ];

        $blocks                     =   [];
        $blocks['block']            =   [
                                        'title' => t( 'theme_options_block', 'Block' ), 'group' =>
                                            [ 'title' => t( 'theme_options_block_title', 'Block Information' ), 'fields' =>
                                                [
                                                    'type'          => [ 'type' => 'select',        'title' => t( 'theme_options_type', 'Type' ), 'options' => [ '' => 'Select a type', 'slider' => 'Slider', 'campaigns' => 'Campaigns', 'coupons' => 'Coupons', 'products' => 'Products', 'stores' => 'Stores', 'categories' => 'Categories', 'subscribe-form' => 'Subscribe form' ] ],
                                                    'links'         => [ 'type' => 'textarea',      'title' => t( 'theme_options_links', 'Links' ), 'info' => t( 'theme_options_links_info', 'Example format: LinkName|http://example.com, LinkName|http://example.com' ), 'required' => [ '{this}[type]' => 'call-to-action' ] ],
                                                    'title'         => [ 'type' => 'text',          'title' => t( 'theme_options_title', 'Title' ), 'info' => t( 'theme_options_title_info', 'Not used for: Slider.' ) ],
                                                    'limit_order'   => [ 'type' => 'text',          'title' => t( 'theme_options_limit_order_type', 'Limit, Order by & Type' ), 'info' => t( 'theme_options_limit_order_type_info', 'Limit, order by and type separated by semicolon. Note*: Used for coupons, stores, products and categories. Example: 20 ; date desc ; popular' ) ],
                                                    'background'    => [ 'type' => 'select',        'title' => t( 'theme_options_background', 'Background' ), 'options' => [ '' => t( 'theme_options_select_color', 'Background Color' ), 'bgWhite' => t( 'theme_options_select_white', 'White' ), 'bgGray' => t( 'theme_options_select_gray', 'Gray' ) ] ],
                                                    'hide'          => [ 'type' => 'checkbox',      'title' => t( 'theme_options_hide', 'Hide' ), 'label' => 'Hide this block temporary (until uncheck this box)' ]
                                                ]
                                            ]
                                        ];
        $options['index_blocks']    =   [ 'section_id' => 'home', 'section' => t( 'theme_options_home_label', 'Home Page' ), 'multi' => true, 'sortable' => true, 'id' => 'items_on_index', 'title' => t( 'theme_options_index_items', 'Items On Index Page' ), 'add_button_title' => 'Add Block', 'rows_title' => 'Block', 'fields' => $blocks ];

        $slider                     =   [];
        $slider['slide']            =   [
                                        'title' => t( 'theme_options_slide', 'Slide' ), 'group' =>
                                            [ 'title' => t( 'theme_options_slide_title', 'Slide Information' ), 'fields' =>
                                                [
                                                    'image'         => [ 'type' => 'image',        'title' => t( 'theme_options_image', "Image" ), 'cat_id' => 'to', 'multi' => false ],
                                                    'link'          => [ 'type' => 'text',         'title' => t( 'theme_options_link', 'Target URL' ) ],
                                                    'expiration'    => [ 'type' => 'timepicker',   'title' => t( 'theme_options_expiration', 'Expiration Date' ), 'label' => 'the price has been checked', 'required' => [ '{this}[remove]' => 1 ] ],
                                                    'remove'        => [ 'type' => 'checkbox',     'title' => t( 'theme_options_hide_expired', 'Hide When Expired' ), 'label' => t( 'theme_options_hide_expired_label', 'Automaticaly hide it when expired' ) ]
                                                ]
                                            ]
                                        ];
        $options['slider']          =   [ 'section_id' => 'slider', 'section' => t( 'theme_options_slider_label', 'Slider' ), 'multi' => true, 'sortable' => true, 'id' => 'slides', 'title' => t( 'theme_options_slides_label', 'Slides' ), 'add_button_title' => t( 'theme_options_add_slide', 'Add Slide' ), 'rows_title' => t( 'theme_options_slide_label', 'Slide' ), 'fields' => $slider ];

        $campaigns                  =   [];
        $campaigns['campaign']      =   [
                                        'title' => t( 'theme_options_campaign', 'Campaign' ), 'group' =>
                                            [ 'title' => t( 'theme_options_campaign_title', 'Campaign Information' ), 'fields' =>
                                                [
                                                    'title'         => [ 'type' => 'text',         'title' => t( 'theme_options_title', 'Title' ) ],
                                                    'image'         => [ 'type' => 'image',        'title' => t( 'theme_options_image', "Image" ), 'cat_id' => 'to', 'multi' => false ],
                                                    'link'          => [ 'type' => 'text',         'title' => t( 'theme_options_link', 'Target URL' ) ],
                                                    'expiration'    => [ 'type' => 'timepicker',   'title' => t( 'theme_options_expiration', 'Expiration Date' ), 'label' => 'the price has been checked', 'required' => [ '{this}[remove]' => 1 ] ],
                                                    'remove'        => [ 'type' => 'checkbox',     'title' => t( 'theme_options_hide_expired', 'Hide When Expired' ), 'label' => t( 'theme_options_hide_expired_label', 'Automaticaly hide it when expired' ) ]
                                                ]
                                            ]
                                        ];
        $options['campaigns']       =   [ 'section_id' => 'campaigns', 'section' => t( 'theme_options_campaigns_label', 'Campaigns' ), 'multi' => true, 'sortable' => true, 'id' => 'campaigns', 'title' => t( 'theme_options_campaigns_label', 'Campaigns' ), 'add_button_title' => t( 'theme_options_add_campaign', 'Add Campaign' ), 'rows_title' => t( 'theme_options_campaign_label', 'Campaign' ), 'fields' => $campaigns ];

        return $options;
    }
}

/* CUSTOM CATEGORY FOR THEME OPTIONS IN GALLERY */

add( 'filter', 'gallery-categories', function( $cats ) {
    $cats['to'] = t( 'themes_options', 'Theme Options' );
    return $cats;
});