<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Categories Component Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on categories component related messages
    | that we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    'index'  => [
        'title'      => 'Categories Manager',
        'page-title' => 'Categories Manager',
        'page-desc'  => 'Manage article categories publication.',
        'box-title'  => 'Category Lists',
    ],
    'alert'  => [
        'success' => 'Category successfully :stat!',
    ],
    'form'   => [
        'fields' => [
            'title'       => 'Title',
            'parent_name' => 'Parent name',
            'alias'       => 'Alias',
            'published'   => 'Published',
            'auth'        => 'Authenticated',
        ],
    ],
    'edit'   => [
        'title'      => 'Edit Panel',
        'page-title' => 'Update Category',
        'page-desc'  => 'Update category publication details.',
        'require'    => 'Fill-up all the required fields.',
        'button'     => [
            'cancel' => 'Cancel',
            'update' => 'Update',
        ],
    ],
    'create' => [
        'title'      => 'Create Panel',
        'page-title' => 'Create Category',
        'page-desc'  => 'Create category publication details.',
        'require'    => 'Fill-up all the required fields.',
        'button'     => [
            'cancel' => 'Cancel',
            'save'   => 'Save and Create',
        ],
    ],
];