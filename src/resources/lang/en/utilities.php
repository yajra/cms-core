<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Utilities Component Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on article component related messages
    | that we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    'index' => [
        'title'       => 'Utilities',
        'description' => 'Site administration utilities.',
        'icon'        => 'fa fa-wrench',
        'lists'       => 'Available Tools',
    ],

    'field' => [
        'run_backup'   => 'Run Back-Up',
        'clean_backup' => 'Clean Back-Up',
        'clear_cache'  => 'Clear Cache',
        'clear_views'  => 'Clear Views',
        'clear_config' => 'Clear Config',
        'cache_config' => 'Cache Config',
        'clear_route'  => 'Clear Route',
        'cache_route'  => 'Cache Route',
        'log_viewer'   => 'Log Viewer',
        'phpinfo'      => 'PHP Info',
        'executed_by'  => 'Executed by: :name',
    ],

    'log' => [
        'title'          => 'Log Viewer',
        'page_title'     => 'Log View Utility',
        'description'    => 'Application logs viewer.',
        'icon'           => 'fa fa-calendar',
        'app_log'        => 'Application Logs',
        'download'       => 'Download file',
        'delete'         => 'Delete file',
        'file_over_50'   => ' Cache Config',
        'level'          => 'Level',
        'date'           => 'Date',
        'content'        => 'Content',
        'close'          => 'Close',
        'delete_confirm' => 'Are you sure?',
    ],

    'backup' => [
        'not_allowed'      => 'Backup task [{:task}] requested is not allowed! ',
        'cleanup_complete' => 'Backup cleanup completed!',
        'complete'         => 'Backup job initiated!',
    ],

    'cache' => [
        'success' => 'Application cache cleared!',
    ],

    'config' => [
        'not_allowed' => 'Configuration task [{:task}] requested is not allowed! ',
        'cached'      => 'Configuration cached successfully!',
        'cleared'     => 'Configuration cache cleared!',
    ],

    'route' => [
        'not_allowed' => 'Route task [{:task}] requested is not allowed! ',
        'cached'      => 'Route cached successfully!',
        'cleared'     => 'Route cache cleared!',
    ],

    'views' => [
        'success' => 'Compiled views cleared!',
    ],

    'menu' => [
        'rebuild' => 'Rebuild Menu',
        'success' => 'Menu tree successfully rebuild!',
    ],

    'category' => [
        'rebuild' => 'Rebuild Category',
        'success' => 'Category tree successfully rebuild!',
    ],

];
