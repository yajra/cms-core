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
            'title'                        => 'Title',
            'parent'                       => 'Parent',
            'alias'                        => 'Alias',
            'published'                    => 'Published',
            'auth'                         => 'Authenticated',
            'author_alias'                 => 'Created by Author Alias',
            'author_alias_placeholder'     => 'Enter author alias here',
            'meta_description'             => 'Meta Description',
            'meta_description_placeholder' => 'Enter meta description here',
            'meta_keywords'                => 'Meta Keywords',
            'meta_keywords_placeholder'    => 'Enter meta description here',
        ],
    ],
    'edit'   => [
        'title'      => 'Edit Panel',
        'page-title' => 'Update Category',
        'page-desc'  => 'Update category publication details.',
        'require'    => 'Fill-up all the required fields.',
    ],
    'create' => [
        'title'      => 'Create Panel',
        'page-title' => 'Create Category',
        'page-desc'  => 'Create category publication details.',
    ],

    'tooltip' => [
        'published'        => 'Set publication status.',
        'auth'             => 'Requires authentication to access the category.',
        'author_alias'     => 'Author name to be displayed instead of the name of the user who created the category.',
        'meta_description' => 'An optional paragraph to be used as the description of the page in the HTML output.',
        'meta_keywords'    => 'An optional comma separated list of keywords and/or phrases to be used in the HTML output.',
    ],

    'tab'         => [
        'content'    => 'Category',
        'publishing' => 'Publishing',
    ],
    'no-articles' => 'Whoops, there are no articles here yet :/',
];
