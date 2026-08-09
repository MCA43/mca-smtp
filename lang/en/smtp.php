<?php

return [
    'app' => [
        'title' => 'Email / SMTP',
        'brand' => 'SMTP',
        'nav_aria' => 'SMTP navigation',
    ],
    'nav' => [
        'back_mca' => 'MCA Hub',
        'settings' => 'Settings',
    ],
    'pages' => [
        'index_title' => 'SMTP settings',
        'help' => 'Configure the mailer used by Laravel. Settings are applied at runtime when enabled.',
        'test_title' => 'Send test email',
        'test_help' => 'Uses the saved SMTP settings above.',
    ],
    'fields' => [
        'mailer_enabled' => 'Enable panel SMTP',
        'mailer' => 'Mailer',
        'host' => 'Host',
        'port' => 'Port',
        'encryption' => 'Encryption',
        'username' => 'Username',
        'password' => 'Password',
        'password_keep' => 'Leave blank to keep the current password.',
        'from_name' => 'From name',
        'from_address' => 'From address',
        'default_recipient' => 'Default recipient',
        'test_email' => 'Recipient',
    ],
    'mailers' => [
        'smtp' => 'SMTP',
        'log' => 'Log (dev)',
    ],
    'encryption' => [
        'none' => 'None',
        'tls' => 'TLS',
        'ssl' => 'SSL',
    ],
    'actions' => [
        'save' => 'Save settings',
        'send_test' => 'Send test',
    ],
    'flash' => [
        'updated' => 'SMTP settings saved.',
        'test_sent' => 'Test email sent to :email.',
    ],
    'errors' => [
        'root_only' => 'Only root users can manage SMTP.',
        'not_configured' => 'SMTP is not enabled or host is empty.',
        'invalid_email' => 'Enter a valid email address.',
        'send_failed' => 'Failed to send: :message',
    ],
    'mail' => [
        'test_subject' => 'MCA SMTP test message',
        'test_body' => 'If you received this message, SMTP is working.',
    ],
    'modal' => [
        'ok' => 'OK',
        'confirm' => 'Confirm',
        'cancel' => 'Cancel',
        'close' => 'Close',
        'alert_title' => 'Notice',
        'confirm_title' => 'Confirm',
    ],
    'console' => [
        'install' => [
            'start' => 'Installing MCA SMTP…',
            'config_ready' => 'Config published / ready',
            'assets_published' => 'Assets published',
            'migration_done' => 'Migrations run',
            'done' => 'MCA SMTP installed.',
            'web_ui' => 'Admin UI: /:prefix',
        ],
    ],
];
