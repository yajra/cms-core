<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Widget Component Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on widget component related messages
    | that we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    'index' => [
        'title'       => 'Widget Manager',
        'description' => 'Manage widget publication.',
        'icon'        => 'fa fa-plug',
        'lists'       => 'Widget Lists',
    ],

    'edit' => [
        'title'       => 'Update Widget',
        'description' => 'Update widget publication details.',
        'icon'        => 'fa fa-edit',
    ],

    'update' => [
        'success' => 'Widget successfully updated!',
        'publish' => 'Widget successfully :task!',
    ],

    'destroy' => [
        'success' => 'Widget successfully deleted!',
    ],

    'create' => [
        'title'       => 'New Widget',
        'description' => 'New widget publication details.',
        'icon'        => 'fa fa-plus',
    ],

    'store' => [
        'success' => 'Widget successfully created!',
    ],

    'tooltip' => [
        'title'         => 'Widget title to be displayed on user.',
        'type'          => 'Type of widget.',
        'template'      => 'Widget blade template.',
        'parameter'     => 'If widget is menu, the parameter value should be a navigation type like (mainmenu).',
        'position'      => 'A pre-defined widget group position on your frontend template where the widget will be displayed.',
        'order'         => 'Display order in widget position/group..',
        'authenticated' => 'Requires authentication to access the widget.',
        'published'     => 'Set publication status.',
        'show_title'    => 'Display widget title.',
        'authorization' => 'Widget authorization will only apply if at least one permission was selected.',
        'parameters'    => [
            'class_suffix'  => 'A suffix to be applied to the CSS of the widget. This allows for individual widget styling.',
            'header_class'  => 'The CSS class for widget header/title.',
            'navigation_id' => 'Navigation group to display.',
        ],
    ],

    'field' => [
        'title'                     => 'Title',
        'title_placeholder'         => 'Enter title here',
        'type'                      => 'Type',
        'type_placeholder'          => '',
        'template'                  => 'Template',
        'template_placeholder'      => '',
        'custom_template'           => 'Custom Template Path <small>(Required if Custom)</small>',
        'parameter'                 => 'Parameter',
        'parameter_placeholder'     => '',
        'position'                  => 'Position',
        'position_placeholder'      => '',
        'order'                     => 'Order',
        'order_placeholder'         => 'Enter order here',
        'show_title'                => 'Show Title',
        'show_title_placeholder'    => '',
        'authenticated'             => 'Authenticated',
        'authenticated_placeholder' => '',
        'published'                 => 'Published',
        'published_placeholder'     => '',
        'authorization'             => 'Widget Authorization Condition',
        'authorization_placeholder' => '',
        'parameters'                => [
            'navigation_id'             => 'Navigation Group',
            'navigation_id_placeholder' => '',
            'class_suffix'              => 'Widget Class Suffix',
            'class_suffix_placeholder'  => '',
            'header_class'              => 'Widget Header Class',
            'header_class_placeholder'  => '',
        ],
    ],

    'tab' => [
        'widget'     => 'Widget',
        'assignment' => 'Menu Assignment',
        'permission' => 'Widget Permissions',
        'advanced'   => 'Advanced',
    ],

    'authorization' => [
        'can'        => 'Must have all selected permissions',
        'canAtLeast' => 'Must have at least one of selected permissions',
    ],

    'menu' => [
        'assignment'    => 'Widget Menu Assignment!',
        'assignments'   => [
            'all'      => 'On all pages',
            'none'     => 'No pages',
            'selected' => 'Only on the pages selected',
        ],
        'empty'         => 'You don\'t have any menu!',
        'empty_content' => 'You can create menu items inside the :link module.',
    ],
];
