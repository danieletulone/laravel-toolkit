<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'prefix' => env('LARAVEL_TOOLKIT_PREFIX', config('app.env', 'local')),
    'notification' => [
        'notifiable_model' => env('LARAVEL_TOOLKIT_NOTIFICATION_USER_MODEL', 'App\Models\User'),
        'use_prefix' => env('LARAVEL_TOOLKIT_NOTIFICATION_USE_PREFIX', true),
        'notifiable_lang_field' => env('LARAVEL_TOOLKIT_NOTIFICATION_USER_LANG_FIELD', 'lang'),
        'mail' => [
            'default_view' => env('LARAVEL_TOOLKIT_NOTIFICATION_MAIL_DEFAULT_VIEW', 'laravel-toolkit::mail'),
        ],
        'firebase' => [
            'credentials' => env('LARAVEL_TOOLKIT_FIREBASE_CREDENTIALS', storage_path('firebase_credentials.json')),
        ],
    ],
];
