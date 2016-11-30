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
        'title'       => 'User Manager',
        'description' => 'Add / Edit / Delete / Activate / Deactivate / Block / Unblock user.',
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
            'username'              => 'Username',
            'password'              => 'Password',
            'password_confirmation' => 'Confirm Password',
            'confirmed'             => 'Is Activated',
            'blocked'               => 'Is Blocked',
            'administrator'         => 'Is Administrator',
        ],
        'placeholder'       => [
            'first_name'            => '',
            'last_name'             => '',
            'email'                 => 'you@example.com',
            'username'              => '',
            'password'              => '',
            'password_confirmation' => '',
            'confirmed'             => '',
            'blocked'               => '',
            'administrator'         => '',
        ],
        'tooltip'           => [
            'first_name'            => '',
            'last_name'             => '',
            'email'                 => '',
            'username'              => '',
            'password'              => '',
            'password_confirmation' => '',
            'confirmed'             => '',
            'blocked'               => '',
            'administrator'         => '',
        ],
    ],

    'tab' => [
        'info'     => 'User Information',
        'role'     => 'Attached Roles',
        'advanced' => 'Advanced Parameters',
    ],

    'edit-user' => 'Edit User',

    'change-password' => 'Change Password',

    'activate' => 'Activate User',

    'deactivate' => 'Deactivate User',

    'unblock' => 'Un-block User',

    'block' => 'Block User',

    'delete' => 'Delete User',

    'view' => 'View Profile',

    'datatable' => [
        'columns' => [
            'administrator' => 'Number of Menu Items',
            'confirmed'     => 'Published',
            'blocked'       => 'Published',
        ],
        'buttons' => [
            'create' => 'New User',
        ],
    ],
];
