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
        'title'       => 'Articles Manager',
        'description' => 'Manage articles publication.',
        'icon'        => 'fa fa-files-o',
        'lists'       => 'Articles Lists',
    ],

    'edit' => [
        'title'       => 'Update Article',
        'description' => 'Update article publication details.',
        'icon'        => 'fa fa-edit',
    ],

    'update' => [
        'success' => 'Article successfully updated!',
        'publish' => 'Article successfully :task!',
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
            'title'                        => 'Article title to be displayed on user.',
            'alias'                        => 'The ALIAS will be used in SEF URL. Leave this blank and the system will automatically generate a unique slug for you based on the title.',
            'authorization'                => 'Article authorization will only apply if at least one permission was selected.',
            'category'                     => 'The category that this article is assigned to.',
            'order'                        => 'Display order of articles.',
            'authenticated'                => 'Requires authentication to access the article.',
            'published'                    => 'Set publication status.',
            'featured'                     => 'Set article as a featured content.',
            'author_alias'                 => 'Author name to be displayed instead of the name of the user who created the article.',
            'meta_description'             => 'An optional paragraph to be used as the description of the page in the HTML output.',
            'meta_keywords'                => 'An optional comma separated list of keywords and/or phrases to be used in the HTML output.',
            'key_reference'                => 'Used to store information referring to an external source.',
            'url_a'                        => 'The actual link to which users will be redirected',
            'url_b'                        => 'The actual link to which users will be redirected',
            'url_target_a'                 => 'Target browser window when the menu item is selected.',
            'url_target_b'                 => 'Target browser window when the menu item is selected.',
            'url_a_text'                   => 'Text to display for the link.',
            'url_b_text'                   => 'Text to display for the link.',
            'img_intro_alt'                => 'Alternative text used for visitors without access to images. Replaced with caption text if it is present.',
            'img_intro_alt_fulltext'       => 'Alternative text used for visitors without access to images. Replaced with caption text if it is present.',
            'content_rights'               => 'Describes what rights others have to use this content.',
            'external_reference'           => 'An optional reference used to link to external data sources.',
            'blade_template'               => 'If set, the content of the article will be based on the blade template content.',
            'image_float'                  => 'Controls placement of the image.',
            'image_float_fulltext'         => 'Controls placement of the image.',
            'image_intro_caption'          => 'Caption attached to image.',
            'image_intro_caption_fulltext' => 'Caption attached to image.',
            'parameters'                   => [
                'show_title'       => 'Show/Hide article title.',
                'show_author'      => 'Show/Hide article author.',
                'show_create_date' => 'Show/Hide the date the article was created.',
                'show_modify_date' => 'Show/Hide the date the article was updated.',
                'show_hits'        => 'Show/Hide the # of hits the article have.',
            ],
            'tags'                         => 'Article tags.',
            'is_page'                      => 'A page article will have a route without category.',
        ],

        'field' => [
            'title'                                    => 'Title',
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
            'url_a'                                    => 'Link A',
            'url_b'                                    => 'Link B',
            'url_target_a'                             => 'URL Target Window',
            'url_target_b'                             => 'URL Target Window',
            'url_a_placeholder'                        => 'Enter link a here',
            'url_b_placeholder'                        => 'Enter link b here',
            'img_intro_alt'                            => 'Alt Text',
            'img_intro_alt_placeholder'                => 'Enter alt text here',
            'img_intro_alt_fulltext'                   => 'Alt Text',
            'img_intro_alt_fulltext_placeholder'       => 'Enter alt text here',
            'url_a_text'                               => 'Link A Text',
            'url_b_text'                               => 'Link B Text',
            'url_a_text_placeholder'                   => 'Enter link a text here',
            'url_b_text_placeholder'                   => 'Enter link b text here',
            'content_rights'                           => 'Content Rights',
            'content_rights_placeholder'               => 'Enter content rights here',
            'external_reference'                       => 'External Reference',
            'external_reference_placeholder'           => 'Enter external reference here',
            'blade_template'                           => 'Use Custom Blade Template',
            'blade_template_placeholder'               => 'path.to.blade.template',
            'image_float'                              => 'Image Float',
            'image_float_fulltext'                     => 'Image Float',
            'image_intro_caption'                      => 'Caption',
            'image_intro_caption_placeholder'          => 'Enter caption here',
            'image_intro_caption_fulltext'             => 'Caption',
            'image_intro_caption_fulltext_placeholder' => 'Enter caption here',
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
        'images_links' => 'Images and links',
        'permission'   => 'Article Permissions',
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
            'is_page'       => 'Is Page',
            'action'        => 'Action',
        ],
        'buttons' => [
            'create' => 'New Article',
        ],
    ],

];
