<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Role Component Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on role component related messages
    | that we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    'attached' => 'Attached Roles',

    'index' => [
        'title'       => 'Roles',
        'description' => 'Manage roles and assign permissions.',
        'icon'        => 'fa fa-shield',
        'list'        => 'Role Lists',
    ],

    'edit' => [
        'title'       => 'Update Role',
        'description' => 'Update users role and attach permissions.',
        'icon'        => 'fa fa-edit',
    ],

    'create' => [
        'title'       => 'New Role',
        'description' => 'New users role and attach permissions.',
        'icon'        => 'fa fa-plus',
    ],

    'form' => [
        'title' => 'Role Information',
        'help'  => '(please fill up all required fields.)',
        'field' => [
            'name'             => 'Name',
            'name_placeholder' => 'Enter permission name',
            'slug'             => 'Slug',
            'slug_placeholder' => 'Enter permission slug',
        ],
    ],

    'datatable' => [
        'columns' => [
            'id'          => 'ID',
            'name'        => 'Name',
            'slug'        => 'Slug',
            'system'      => 'System',
            'users'       => 'Users',
            'permissions' => 'Permissions',
            'created_at'  => 'Created At',
            'updated_at'  => 'Updated At',
            'action'      => 'Actions',
        ],
        'buttons' => [
            'create' => 'New Role',
        ],
    ],
];
