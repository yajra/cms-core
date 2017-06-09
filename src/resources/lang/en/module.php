<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Module Component Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on module component related messages
    | that we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    'index' => [
        'title'       => 'Module Manager',
        'description' => 'Manage modules publication.',
        'icon'        => 'fa fa-files-o',
        'lists'       => 'Module Lists',
    ],

    'edit' => [
        'title'       => 'Update Module',
        'description' => 'Update module publication details.',
        'icon'        => 'fa fa-edit',
    ],

    'toggle' => [
        'enable'  => 'Module :module successfully enabled!',
        'disable' => 'Module :module successfully disabled!',
    ],

    'destroy' => 'Module :module successfully deleted!',

    'create' => [
        'title'       => 'New Module',
        'description' => 'New module publication details.',
        'icon'        => 'fa fa-plus',
    ],

    'store' => [
        'success' => 'Module :module successfully created!',
    ],

    'table' => [
        'columns' => [
            'name'        => 'Name',
            'alias'       => 'Alias',
            'active'      => 'Active',
            'order'       => 'Sort/Order',
            'action'      => 'Status',
            'description' => 'Description',
        ],
        'buttons' => [
            'create' => 'New Module',
        ],
    ],

];
