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
        'name'             => 'Site Name',
        'name-info'        => 'Site registered name.',
        'version'          => 'Version',
        'version-info'     => 'Site version number.',
        'keywords'         => 'Keywords',
        'keywords-info'    => 'Default site meta keywords.',
        'author'           => 'Author',
        'author-info'      => 'Default site meta author name.',
        'description'      => 'Site Description',
        'description-info' => 'Default site meta description.',
        'color'            => 'Administrator Template (AdminLTE Color Scheme)',
        'color-info'       => 'Administrator area AdminLTE color scheme.',
    ],

    'cache' => [
        'stores'      => 'Default Cache Store',
        'stores-info' => 'This option controls the default cache connection that gets used while using this caching library. This connection is used when another is not explicitly specified when executing a given caching function.',
        'database'    => [
            'table'           => 'Database Table Name',
            'table-info'      => 'Database table name you wish to store cache.',
            'connection'      => 'Database Connection',
            'connection-info' => 'Specify cache database connection.',
        ],
        'file'        => [
            'path'      => 'Path',
            'path-info' => 'Local path you wish to store cache.',
        ],
        'memcached'   => [
            'host'        => 'Host',
            'host-info'   => 'Memcache host name.',
            'port'        => 'Port',
            'port-info'   => 'Memcached port.',
            'weight'      => 'Weight',
            'weight-info' => 'Memcached weight.',
        ],
        'redis'       => [
            'connection'      => 'Connection',
            'connection-info' => 'Specify redis connection.',
        ],
    ],

    'database' => [
        'default'       => 'Default Database',
        'default-info'  => 'Here you may specify which of the database connections below you wish to use as your default connection for all database work. Of course you may use many connections at once using the Database library.',
        'host'          => 'Host',
        'host-info'     => 'Database Hostname.',
        'username'      => 'Username',
        'username-info' => 'Database Username.',
        'password'      => 'Password',
        'password-info' => 'Database Password.',
        'database'      => 'Database Name',
        'database-info' => 'Database Name',
        'schema'        => 'Schema',
        'schema-info'   => 'Database Schema',
    ],

    'filesystems' => [
        'default'      => 'Default File System',
        'default-info' => 'Here you may specify the default filesystem disk that should be used by the framework. A "local" driver, as well as a variety of cloud based drivers are available for your choosing. Just store away!',
        'local'        => [
            'root'      => 'Filesystem Disks',
            'root-info' => 'Here you may configure as many filesystem "disks" as you wish, and you may even configure multiple disks of the same driver. Defaults have been setup for each driver as an example of the required options.',
        ],
        'public'       => [
            'root'            => 'Filesystem Disks',
            'root-info'       => 'Here you may configure as many filesystem "disks" as you wish, and you may even configure multiple disks of the same driver. Defaults have been setup for each driver as an example of the required options.',
            'visibility'      => 'Visibility',
            'visibility-info' => 'File system visibility.',
        ],
        's3'           => [
            'key'         => 'Key',
            'key-info'    => 'S3 App Key.',
            'secret'      => 'Secret',
            'secret-info' => 'S3 Secret Key.',
            'region'      => 'Region',
            'region-info' => 'S3 Region.',
            'bucket'      => 'Bucket',
            'bucket-info' => 'S3 Bucket Key.',
        ],
    ],

    'mail' => [
        'driver'          => 'Email Driver',
        'driver-info'     => 'Laravel supports both SMTP and PHPs "mail" function as drivers for the sending of e-mail. You may specify which one youre using throughout your application here. By default, Laravel is setup for SMTP mail.',
        'host'            => 'Host',
        'host-info'       => 'Here you may provide the host address of the SMTP server used by your applications. A default option is provided that is compatible with the Mailgun mail service which will provide reliable deliveries.',
        'port'            => 'Port',
        'port-info'       => 'This is the SMTP port used by your application to deliver e-mails to users of the application. Like the host we have set this value to stay compatible with the Mailgun e-mail application by default.',
        'encryption'      => 'Encryption',
        'encryption-info' => 'Here you may specify the encryption protocol that should be used when the application send e-mail messages. A sensible default using the transport layer security protocol should provide great security.',
        'username'        => 'Username',
        'username-info'   => 'If your SMTP server requires a username for authentication, you should set it here. This will get used to authenticate with your server on connection. You may also set the "password" value below this one.',
        'password'        => 'Password',
        'password-info'   => 'Here you may set the password required by your SMTP server to send out messages from your application. This will be given to the server on connection so that the application will be able to send messages.',
    ],

    'session' => [
        'driver' => 'Default Driver',
        'driver-info' => 'This option controls the default session "driver" that will be used on requests. By default, we will use the lightweight native driver but you may specify any of the other wonderful drivers provided here.',
        'lifetime' => 'Lifetime',
        'lifetime-info' => 'Here you may specify the number of minutes that you wish the session to be allowed to remain idle before it expires. If you want them to immediately expire on the browser closing, set that option.',
        'files' => 'Files',
        'files-info' => 'When using the native session driver, we need a location where session files may be stored. A default has been set for you but a different location may be specified. This is only needed for file sessions.',
        'table' => 'Database Table',
        'table-info' => 'When using the "database" session driver, you may specify the table we should use to manage the sessions. Of course, a sensible default is provided for you; however, you are free to change this as needed.',
        'expire_on_close' => 'Expire On Close',
        'expire_on_close-info' => 'If you want them to immediately expire on the browser closing, set that TRUE.',
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
