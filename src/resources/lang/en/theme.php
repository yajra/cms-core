<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Theme Component Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on theme component related messages
    | that we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    'title'       => 'Themes Manager',
    'description' => 'Manage themes publication.',
    'icon'        => 'fa fa-windows',
    'lists'       => 'Available Themes',

    'table' => [
        'name'        => 'Name',
        'theme'       => 'Theme',
        'description' => 'Description',
        'version'     => 'Version',
        'positions'   => 'Positions',
        'default'     => 'Default',
        'action'      => 'Action',
    ],

    'confirm' => [
        'title'  => 'Are you sure?',
        'text'   => 'Uninstalling will permanently delete this theme!',
        'cancel' => 'Cancel',
        'yes'    => 'Yes, uninstall the theme',
    ],

    'success'   => 'Theme :theme was set as default!',
    'default'   => 'Set as Default',
    'uninstall' => 'Uninstall',
    'deleted'   => 'Theme :theme uninstalled!',
    'error'     => 'Error uninstalling :theme!',
];
