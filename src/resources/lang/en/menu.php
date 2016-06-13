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
        'success' => 'Menu successfully updated!',
        'publish' => 'Menu successfully %s!',
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
    ],

    'tab' => [
        'details'    => 'Menu Details',
        'link'       => 'Link Type',
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
