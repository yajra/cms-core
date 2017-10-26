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
        'title'       => 'Permissions',
        'description' => 'Setup application permissions.',
        'icon'        => 'fa fa-tag',
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

    'dataTable' => [
        'columns'    => [
            [
                'data'  => 'id',
                'name'  => 'id',
                'title' => 'Id',
            ],
            [
                'data'  => 'resource',
                'name'  => 'resource',
                'title' => 'Resource',
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
                'data'       => 'roles',
                'name'       => 'roles_count',
                'title'      => 'Roles',
                'class'      => 'text-center',
                'width'      => '30px',
                'searchable' => false,
                'printable'  => false,
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
            'order'     => [[0, 'desc']],
            'buttons'   => [
                'resource',
                [
                    'extend' => 'create',
                    'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp; New Permission',
                ],
                'export',
                'print',
                'reset',
                'reload',
            ],
            'stateSave' => true,
        ],
        'filename'   => 'permissions',
    ],
];
