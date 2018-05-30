<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Article Component Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on article component related messages
    | that we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    'index' => [
        'title'       => 'Articles and Pages',
        'description' => 'Manage articles/pages publication.',
        'icon'        => 'fa fa-files-o',
        'lists'       => 'Articles Lists',
    ],

    'edit' => [
        'title'       => 'Update Article',
        'description' => 'Update article publication details.',
        'icon'        => 'fa fa-edit',
    ],

    'update' => [
        'success'   => 'Article successfully updated!',
        'published' => 'Article successfully :task!',
        'featured'  => 'Article successfully :task!',
    ],

    'destroy' => [
        'success' => 'Article successfully deleted!',
    ],

    'create' => [
        'title'       => 'New Article',
        'description' => 'New article publication details.',
        'icon'        => 'fa fa-plus',
    ],

    'store' => [
        'success' => 'Article successfully created!',
    ],

    'form' => [
        'tooltip' => [
            'title'              => 'Article title to be displayed on user.',
            'theme'              => 'Theme to be used by the article.',
            'alias'              => 'The ALIAS will be used in SEF URL. Leave this blank and the system will automatically generate a unique slug for you based on the title.',
            'authorization'      => 'Article authorization will only apply if at least one permission was selected.',
            'category'           => 'The category that this article is assigned to.',
            'order'              => 'Display order of articles.',
            'authenticated'      => 'Requires authentication to access the article.',
            'published'          => 'Set publication status.',
            'featured'           => 'Set article as a featured content.',
            'author_alias'       => 'Author name to be displayed instead of the name of the user who created the article.',
            'meta_description'   => 'An optional paragraph to be used as the description of the page in the HTML output.',
            'meta_keywords'      => 'An optional comma separated list of keywords and/or phrases to be used in the HTML output.',
            'key_reference'      => 'Used to store information referring to an external source.',
            'intro_image_alt'    => 'Alternative text used for visitors without access to images.',
            'image_alt'          => 'Alternative text used for visitors without access to images.',
            'content_rights'     => 'Describes what rights others have to use this content.',
            'external_reference' => 'An optional reference used to link to external data sources.',
            'blade_template'     => 'If set, the content of the article will be based on the blade template content.',
            'parameters'         => [
                'show_title'       => 'Show/Hide article title.',
                'show_author'      => 'Show/Hide article author.',
                'show_create_date' => 'Show/Hide the date the article was created.',
                'show_modify_date' => 'Show/Hide the date the article was updated.',
                'show_hits'        => 'Show/Hide the # of hits the article have.',
            ],
            'tags'               => 'Article tags.',
            'is_page'            => 'A page article will have a route without category.',
        ],

        'field' => [
            'title'                                    => 'Title',
            'theme'                                    => 'Theme',
            'title_placeholder'                        => 'Enter title here',
            'alias'                                    => 'Alias',
            'alias_placeholder'                        => 'Enter alias here',
            'authorization'                            => 'Article Authorization Condition',
            'authorization_placeholder'                => 'Enter alias here',
            'category'                                 => 'Category',
            'category_placeholder'                     => 'Enter category here',
            'order'                                    => 'Order',
            'order_placeholder'                        => 'Enter order here',
            'authenticated'                            => 'Authenticated',
            'authenticated_placeholder'                => '',
            'published'                                => 'Published',
            'published_placeholder'                    => '',
            'featured'                                 => 'Featured',
            'featured_placeholder'                     => '',
            'author_alias'                             => 'Created by Author Alias',
            'author_alias_placeholder'                 => 'Enter author alias here',
            'meta_description'                         => 'Meta Description',
            'meta_description_placeholder'             => 'Enter meta description here',
            'meta_keywords'                            => 'Meta Keywords',
            'meta_keywords_placeholder'                => 'Enter meta description here',
            'key_reference'                            => 'Key Reference',
            'key_reference_placeholder'                => 'Enter key reference here',
            'intro_image_alt'                          => 'Introduction Image Alt Text',
            'intro_image_alt_placeholder'              => 'Enter alt text here',
            'image_alt'                                => 'Article Image Alt Text',
            'image_alt_placeholder'                    => 'Enter alt text here',
            'content_rights'                           => 'Content Rights',
            'content_rights_placeholder'               => 'Enter content rights here',
            'external_reference'                       => 'External Reference',
            'external_reference_placeholder'           => 'Enter external reference here',
            'blade_template'                           => 'Use Custom Blade Template',
            'blade_template_placeholder'               => 'path.to.blade.template',
            'parameters'                               => [
                'show_title'       => 'Show Title',
                'show_author'      => 'Show Author',
                'show_create_date' => 'Show Create Date',
                'show_modify_date' => 'Show Modify Date',
                'show_hits'        => 'Show Hits',
            ],
            'tags'                                     => 'Tags',
            'is_page'                                  => 'Is a Page',
        ],
    ],

    'tab' => [
        'content'      => 'Content',
        'publishing'   => 'Publishing',
        'images_links' => 'Images',
        'permission'   => 'Permissions',
        'options'      => 'Options',
    ],

    'authorization' => [
        'can'        => 'Must have all selected permissions',
        'canAtLeast' => 'Must have at least one of selected permissions',
    ],

    'datatable' => [
        'columns' => [
            'id'            => 'Id',
            'title'         => 'Title',
            'published'     => 'Published',
            'authenticated' => 'Authentication Required',
            'order'         => 'Sort/Order',
            'hits'          => 'Hits',
            'category'      => 'Category',
            'created_at'    => 'Created At',
            'updated_at'    => 'Updated At',
            'is_page'       => 'Page',
            'action'        => 'Action',
            'author'        => 'Author',
            'status'        => 'Status',
        ],
        'buttons' => [
            'create' => 'New Article',
        ],
    ],

];
