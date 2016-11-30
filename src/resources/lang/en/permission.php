<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Permission Component Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on permission component related messages
    | that we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    'attached' => 'Attached Permissions',

    'index' => [
        'title'       => 'Permission Manager',
        'description' => 'Setup and Manage User Role Permissions.',
        'icon'        => 'fa fa-tag',
        'list'        => 'Permission Lists',
    ],

    'edit' => [
        'title'       => 'Update Permission',
        'description' => 'Update users permission and attach role.',
        'icon'        => 'fa fa-edit',
    ],

    'create' => [
        'title'       => 'New Permission',
        'description' => 'New users permission and attach role.',
        'icon'        => 'fa fa-plus',
    ],

    'resource' => [
        'title'       => 'New Permission Resource',
        'description' => 'New users permission and attach role.',
        'icon'        => 'fa fa-plus',
    ],

    'form' => [
        'resource'     => 'Resource Information',
        'attach-roles' => 'Attach Roles',
        'title'        => 'Permission Information',
        'help'         => '(please fill up all required fields.)',
        'field'        => [
            'name'                 => 'Name',
            'name_placeholder'     => 'Enter permission name',
            'slug'                 => 'Slug',
            'slug_placeholder'     => 'Enter permission slug',
            'resource'             => 'Resource Name',
            'resource_placeholder' => 'Enter permission resource name',
        ],
    ],

    'datatable' => [
        'buttons' => [
            'create' => 'New Permission',
        ],
    ],
];
