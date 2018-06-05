<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tags Component Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on categories component related messages
    | that we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    'index' => [
        'title'      => 'Tags',
        'page-title' => 'Tags',
        'page-desc'  => 'Manage article tags publication.',
    ],

    'destroy' => [
        'success' => 'Tag successfully deleted.',
        'error'   => 'Unable to delete tag because it is being used by some articles.',
    ],

    'store' => [
        'success' => 'Tag successfully added.',
        'error'   => 'Unable to add category.',
    ],

    'update' => [
        'success' => 'Tag successfully updated.',
        'error'   => 'Unable to update tag.',
    ],

    'publish' => [
        'success' => 'Tag successfully published.',
        'error'   => 'Tag successfully unpublished.',
    ],

    'form' => [
        'fields' => [
            'name' => 'Name',
            'slug' => 'Slug',
        ],
    ],

    'edit' => [
        'title'      => 'Edit Panel',
        'page-title' => 'Update Tag',
        'page-desc'  => 'Update tag publication details.',
        'require'    => 'Fill-up all the required fields.',
    ],

    'create' => [
        'title'      => 'Create Panel',
        'page-title' => 'Create Tag',
        'page-desc'  => 'Create tag publication details.',
    ],

    'tooltip' => [

    ],

    'tab' => [
        'content'    => 'Tag',
        'publishing' => 'Publishing',
    ],

    'no-articles' => 'Whoops, there are no articles here yet :/',

    'datatable' => [
        'columns' => [
            'authenticated' => 'Authentication Required',
            'action'        => 'Action',
            'name'          => 'Name',
            'slug'          => 'Slug',
            'suggest'       => 'Suggest',
            'count'         => 'Count',
            'id'            => 'Id',
            'created_at'    => 'Created At',
            'updated_at'    => 'Updated At',
        ],
        'buttons' => [
            'create' => 'New Tag',
        ],
    ],

    'empty' => 'WHOOPS, THERE ARE NO ARTICLES HERE YET :/',
];
