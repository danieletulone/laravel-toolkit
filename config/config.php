<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'prefix' => env('LARAVEL_TOOLKIT_PREFIX', config('app.env', 'local')),
    'notification' => [
        'notifiable_model' => env('LARAVEL_TOOLKIT_NOTIFICATION_USER_MODEL', 'App\Models\User'),
        'use_prefix' => env('LARAVEL_TOOLKIT_NOTIFICATION_USE_PREFIX', true),
    ],
];
