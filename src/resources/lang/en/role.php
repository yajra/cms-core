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

    'dataTable' => [
        'columns'    => [
            [
                'data'  => 'id',
                'name'  => 'id',
                'title' => 'Id',
            ],
            [
                'data'  => 'name',
                'name'  => 'name',
                'title' => 'Name',
            ],
            [
                'data'  => 'slug',
                'name'  => 'slug',
                'title' => 'Slug',
            ],
            [
                'data'  => 'system',
                'name'  => 'system',
                'title' => 'System',
                'class' => 'text-center',
                'width' => '30px',
            ],
            [
                'data'       => 'users',
                'name'       => 'users_count',
                'title'      => 'Users',
                'searchable' => false,
                'class'      => 'text-center',
            ],
            [
                'data'       => 'permissions',
                'name'       => 'permissions_count',
                'title'      => 'Permissions',
                'searchable' => false,
                'class'      => 'text-center',
            ],
            [
                'data'  => 'created_at',
                'name'  => 'created_at',
                'title' => 'Created At',
                'width' => '100px',
            ],
            [
                'data'  => 'updated_at',
                'name'  => 'updated_at',
                'title' => 'Updated At',
                'width' => '100px',
            ],
            [
                'data'       => 'action',
                'name'       => 'action',
                'title'      => 'Actions',
                'width'      => '60px',
                'orderable'  => false,
                'searchable' => false,
            ],
        ],
        'parameters' => [
            'stateSave' => true,
            'order'     => [[0, 'desc']],
            'buttons'   => [
                [
                    'extend' => 'create',
                    'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp; New Role',
                ],
                'export',
                'print',
                'reset',
                'reload',
            ],
        ],
        'filename'   => 'roles',
    ],
];
