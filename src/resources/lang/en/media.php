<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Media Component Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on article component related messages
    | that we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    'index' => [
        'title'       => 'Media Manager',
        'description' => 'Manage sites assets.',
        'icon'        => 'fa fa-file-image-o',
        'lists'       => 'Directories',
    ],

    'destroy' => [
        'delete'                => 'Delete Selected Files',
        'success'               => 'File/Folder deleted successfully',
        'warning'               => 'Are you sure you want to delete the selected file(/s) and folder(/s)?',
        'warning_single'        => 'Are you sure you want to delete',
        'warning_text'          => 'You will not be able to recover this file!',
        'warning_button'        => 'Yes, delete it!',
        'warning_cancel_button' => 'Cancel',
    ],

    'create' => [
        'new_directory'             => 'Create New Folder',
        'new_directory_placeholder' => 'Enter folder name here',
        'file'                      => 'Upload',
        'file_placeholder'          => 'Drop files here to upload',
    ],

    'store' => [
        'success'              => 'folder :name successfully created!',
        'error_invalid_name'   => 'Invalid folder name! Folder name must be alphanumeric only and no space',
        'error_already_exists' => ':name already exists!',
    ],

    'field' => [
        'file_name'     => 'File Name',
        'file_size'     => 'File Size',
        'insert'        => 'Insert',
        'select'        => 'Select',
        'preview'       => 'Preview',
        'dropzone_text' => 'Drop files here to upload'
    ],

    'datatable' => [],
];
