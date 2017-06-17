<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Config Component Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on user component related messages
    | that we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    'app' => [
        'name'          => 'Application Name',
        'name-info'     => 'This is your registered application name.',
        'env'           => 'Environment',
        'env-info'      => 'This value determines the "environment" your application is currently running in. This may determine how you prefer to configure various services your application utilizes. Set this in your ".env" file.',
        'url'           => 'Application URL',
        'url-info'      => 'This URL is used by the console to properly generate URLs when using the Artisan command line tool. You should set this to the root of your application so that it is used when running Artisan tasks.',
        'timezone'      => 'Timezone',
        'timezone-info' => 'Here you may specify the default timezone for your application, which will be used by the PHP date and date-time functions. We have gone ahead and set this to a sensible default for you out of the box.',
        'language'      => 'Language',
        'language-info' => 'The application locale determines the default locale that will be used by the translation service provider. You are free to set this value to any of the locales which will be supported by the application.',
        'log'           => 'Logging Configuration',
        'log-info'      => 'Here you may configure the log settings for your application. Out of the box, Laravel uses the Monolog PHP logging library. This gives you a variety of powerful log handlers / formatters to utilize.',
        'debug'         => 'Application Debug Mode',
        'debug-info'    => 'When your application is in debug mode, detailed error messages with stack traces will be shown on every error that occurs within your application. If disabled, a simple generic error page is shown.',
        'debugbar'      => 'Display Debug Bar',
        'debugbar-info' => 'When your application is in debug mode and debugbar is set to true, DEBUGBAR component will be shown on every pages of the site.',
    ],

    'site' => [
        'name' => 'Site Name',
        'name-info' => 'Site registered name.',
        'version' => 'Version',
        'version-info' => 'Site version number.',
        'keywords' => 'Keywords',
        'keywords-info' => 'Default site meta keywords.',
        'author' => 'Author',
        'author-info' => 'Default site meta author name.',
        'description' => 'Site Description',
        'description-info' => 'Default site meta description.',
        'color' => 'Administrator Template (AdminLTE Color Scheme)',
        'color-info' => 'Administrator area AdminLTE color scheme.',
    ],

    'setup' => [
        [
            'title' => 'Site Settings',
            'key'   => 'site',
            'icon'  => 'fa-cog',
        ],
        [
            'title' => 'Application Environment',
            'key'   => 'app',
            'icon'  => 'fa-laptop',
        ],
        [
            'title' => 'Database Connection',
            'key'   => 'database',
            'icon'  => 'fa-database',
        ],
        [
            'title' => 'Mail Driver',
            'key'   => 'mail',
            'icon'  => 'fa-envelope',
        ],
        [
            'title' => 'Cache Store',
            'key'   => 'cache',
            'icon'  => 'fa-cloud-download',
        ],
        [
            'title' => 'Session Driver',
            'key'   => 'session',
            'icon'  => 'fa-comment-o',
        ],
        [
            'title' => 'File System',
            'key'   => 'filesystems',
            'icon'  => 'fa-briefcase',
        ],
    ],

    'success' => '"Configuration (:config) successfully saved! You may need to refresh the page to reflect some changes."',
];
