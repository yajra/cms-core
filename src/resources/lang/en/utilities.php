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
        'log_viewer'   => 'Log Viewer',
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
        'complete'         => 'Backup completed!',
    ],

    'cache' => [
        'success' => 'Application cache cleared!',
    ],

    'config' => [
        'not_allowed'   => 'Configuration task [{:task}] requested is not allowed! ',
        'cache'         => 'Configuration cached successfully!',
        'cache_cleared' => 'Configuration cache cleared!',
    ],

    'views' => [
        'success' => 'Compiled views cleared!',
    ],

    

];
