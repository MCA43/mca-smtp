<?php

return [

    'enabled' => env('MCA_SMTP_ENABLED', true),

    'locale' => env('MCA_SMTP_LOCALE'),

    'table' => env('MCA_SMTP_TABLE', 'mca_smtp_settings'),

    'auto_apply' => env('MCA_SMTP_AUTO_APPLY', true),

    /*
    |--------------------------------------------------------------------------
    | Fallback when DB empty
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'mailer_enabled' => env('MCA_SMTP_MAILER_ENABLED', false),
        'mailer' => env('MCA_SMTP_MAILER', 'smtp'), // smtp|log
        'host' => env('MCA_SMTP_HOST', ''),
        'port' => env('MCA_SMTP_PORT', 587),
        'encryption' => env('MCA_SMTP_ENCRYPTION', 'tls'), // tls|ssl|''
        'username' => env('MCA_SMTP_USERNAME', ''),
        'password' => env('MCA_SMTP_PASSWORD', ''),
        'from_name' => env('MCA_SMTP_FROM_NAME', ''),
        'from_address' => env('MCA_SMTP_FROM_ADDRESS', ''),
        'default_recipient' => env('MCA_SMTP_DEFAULT_RECIPIENT', ''),
    ],

    'routes' => [
        'load_package_routes' => env('MCA_SMTP_LOAD_ROUTES', true),
        'web' => [
            'prefix' => env('MCA_SMTP_ROUTE_PREFIX', 'mca/smtp'),
            'middleware' => array_filter(explode(',', (string) env(
                'MCA_SMTP_MIDDLEWARE',
                'web,auth,mca.smtp.root,mca.smtp.locale'
            ))),
            'name_prefix' => 'mca.smtp.',
        ],
    ],

    'controllers' => [
        'web' => [
            'smtp' => \Mca\Smtp\Http\Controllers\Web\SmtpController::class,
        ],
    ],

    'views' => [
        'namespace' => env('MCA_SMTP_VIEW_NAMESPACE', 'mca-smtp'),
        'layout' => env('MCA_SMTP_VIEW_LAYOUT', 'mca-smtp::layouts.app'),
    ],

    'ui' => [
        'title' => env('MCA_SMTP_UI_TITLE'),
        'class_prefix' => 'mca-smtp',
        'assets' => [
            'css' => 'vendor/mca-smtp/mca-smtp.css',
            'js' => 'vendor/mca-smtp/mca-smtp.js',
            'ui' => 'vendor/mca-permission/mca-ui.css',
            'ui_js' => 'vendor/mca-permission/mca-ui.js',
        ],
    ],

    'access' => [
        'use_permission_root' => env('MCA_SMTP_USE_PERMISSION_ROOT', true),
        'role_column' => env('MCA_SMTP_ROLE_COLUMN', 'role_id'),
        'root_role' => env('MCA_SMTP_ROOT_ROLE', 'root'),
    ],

];
