<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User Component Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on user component related messages
    | that we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    'attached' => 'Attached Users',

    'index' => [
        'title'       => 'Users',
        'description' => 'add / edit / delete / activate / deactivate / block / unblock user.',
        'icon'        => 'fa fa-users',
        'search'      => 'Search Tools',
        'activation'  => 'Filter by Activation',
        'role'        => 'Filter by Role',
    ],

    'edit' => [
        'title'       => 'Update User',
        'description' => 'Update user information.',
        'icon'        => 'fa fa-edit',
    ],

    'create' => [
        'title'       => 'New User',
        'description' => 'New users user and attach permissions.',
        'icon'        => 'fa fa-plus',
    ],

    'form' => [
        'title'             => 'User Information',
        'help'              => '(please fill up all required fields.)',
        'note'              => 'Note:',
        'attach-roles'      => 'Attach Roles',
        'attach-roles-note' => 'User will inherit all the permissions of the roles they are assigned to.',
        'field'             => [
            'first_name'            => 'First Name',
            'last_name'             => 'Last Name',
            'email'                 => 'Email',
            'password'              => 'Password',
            'password_confirmation' => 'Confirm Password',
            'is_activated'          => 'Is Activated',
            'is_blocked'            => 'Is Blocked',
            'is_admin'              => 'Is Administrator',
        ],
        'placeholder'       => [
            'first_name'            => '',
            'last_name'             => '',
            'email'                 => 'you@example.com',
            'password'              => '',
            'password_confirmation' => '',
            'is_activated'          => '',
            'is_blocked'            => '',
            'is_admin'              => '',
        ],
        'tooltip'           => [
            'first_name'            => '',
            'last_name'             => '',
            'email'                 => '',
            'password'              => '',
            'password_confirmation' => '',
            'is_activated'          => '',
            'is_blocked'            => '',
            'is_admin'              => '',
        ],
    ],

    'tab' => [
        'info' => 'User Information',
        'role' => 'Attached Roles',
    ],

    'edit-user' => 'Edit User',

    'change-password' => 'Change Password',

    'activate' => 'Activate User',

    'deactivate' => 'Deactivate User',

    'unblock' => 'Un-block User',

    'block' => 'Block User',

    'delete' => 'Delete User',

    'view' => 'View Profile',

    'impersonate' => 'Impersonate User',

    'dataTable' => [
        'columns'    => [
            [
                'data'  => 'id',
                'name'  => 'id',
                'title' => 'Id',
                'width' => '20px',
            ],
            [
                'data'  => 'first_name',
                'name'  => 'first_name',
                'title' => 'First Name',
            ],
            [
                'data'  => 'last_name',
                'name'  => 'last_name',
                'title' => 'Last Name',
            ],
            [
                'data'  => 'email',
                'name'  => 'email',
                'title' => 'Email',
            ],
            [
                'data'      => 'roles',
                'name'      => 'roles.name',
                'title'     => 'Roles',
                'orderable' => false,
            ],
            [
                'data'  => 'is_admin',
                'name'  => 'is_admin',
                'width' => '20px',
                'title' => '<i class="fa fa-shield" data-toggle="tooltip" data-title="Is Administrator"></i>',
            ],
            [
                'data'  => 'is_activated',
                'name'  => 'is_activated',
                'width' => '20px',
                'title' => '<i class="fa fa-check" data-toggle="tooltip" data-title="Is Activated"></i>',
            ],
            [
                'data'  => 'is_blocked',
                'name'  => 'is_blocked',
                'width' => '20px',
                'title' => '<i class="fa fa-ban" data-toggle="tooltip" data-title="Is Blocked"></i>',
            ],
            [
                'data'  => 'created_at',
                'name'  => 'created_at',
                'title' => 'Created At',
                'width' => '100px',
            ],
            [
                'data'       => 'action',
                'name'       => 'action',
                'title'      => 'Actions',
                'width'      => '60px',
                'orderable'  => false,
                'searchable' => false,
                'exportable' => false,
                'printable'  => false,
            ],
        ],
        'parameters' => [
            'stateSave' => true,
            'order'     => [[0, 'desc']],
            'buttons'   => [
                [
                    'extend' => 'create',
                    'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp; New User',
                ],
                'export',
                'print',
                'reset',
                'reload',
            ],
        ],
        'filename'   => 'users',
    ],
];
