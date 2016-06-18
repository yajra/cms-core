<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menu Component Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on menu component related messages
    | that we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    'index' => [
        'title'       => 'Menu Items Manager',
        'description' => 'Navigation',
        'icon'        => 'fa fa-link',
        'back'        => 'Back to navigation lists',
    ],

    'edit' => [
        'title'       => 'Update Menu',
        'description' => 'This is where you should update your menu.',
        'icon'        => 'fa fa-edit',
    ],

    'update' => [
        'success'    => 'Menu successfully updated!',
        'publish'    => 'Menu successfully %s!',
        'move_error' => 'A menu cannot be moved to it\'s own sub-menu or to itself (inside moved tree)!',
    ],

    'destroy' => [
        'success' => 'Menu successfully deleted!',
    ],

    'create' => [
        'title'       => 'New Menu Item',
        'description' => 'Navigation',
        'icon'        => 'fa fa-plus',
    ],

    'store' => [
        'success' => 'Menu successfully created!',
    ],

    'tooltip' => [
        'title'            => 'Menu title.',
        'authorization'    => 'Menu authorization will only apply if at least one permission was selected.',
        'meta_description' => 'An optional paragraph to be used as description of the page.',
        'meta_keywords'    => 'An optional comma separated list of keywords.',
        'page_title'       => 'Optional text for the Browse Page Title.',
        'page_heading'     => 'Optional alternative text for Page Heading.',
        'page_class'       => 'Optional CSS class to add on page.',
        'link_title'       => 'Optional custom description for the title attribute of the menu hyperlink.',
        'link_style'       => 'Optional custom style to apply to the menu hyperlink.',
    ],

    'field' => [
        'title'                        => 'Menu Title',
        'title_placeholder'            => 'Enter menu title',
        'authorization'                => 'Menu Authorization Condition',
        'authorization_placeholder'    => 'Enter menu title',
        'meta_description'             => 'Meta Description',
        'meta_description_placeholder' => '',
        'meta_keywords'                => 'Meta Keywords',
        'meta_keywords_placeholder'    => '',
        'page_title'                   => 'Page Title',
        'page_title_placeholder'       => '',
        'page_heading'                 => 'Page Heading',
        'page_heading_placeholder'     => '',
        'page_class'                   => 'Page Class',
        'page_class_placeholder'       => '',
        'link_title'                   => 'Link Title Attribute',
        'link_title_placeholder'       => '',
        'link_style'                   => 'Link CSS Style',
        'link_style_placeholder'       => '',
    ],

    'tab' => [
        'details'    => 'Menu Details',
        'display'    => 'Page Display',
        'metadata'   => 'Metadata',
        'permission' => 'Menu Permissions',
        'widget'     => 'Widget Assignment',
    ],

    'authorization' => [
        'can'        => 'Must have all selected permissions',
        'canAtLeast' => 'Must have at least one of selected permissions',
    ],

];
