<?php

namespace Danieletulone\LaravelToolkit\Traits\Notification;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait DotNameDeductible
{
    /**
     * The namespace of notification classes.
     */
    public static function namespace(): string
    {
        return 'App\\Notifications\\';
    }

    /**
     * Get the notification class name as dot name.
     * Ex:
     *  - App\Notifications\MyExampleNotification -> my-example
     *  - App\Notifications\System\MyExampleNotification -> system.my-example
     */
    public static function getDotName(): string
    {
        $notificationClassname = str_replace(self::namespace(), '', static::class);
        $notificationClassname = str_replace('Notification', '', $notificationClassname);

        return implode(
            '.',
            Arr::map(explode('\\', $notificationClassname), function ($item) {
                return Str::snake($item);
            })
        );
    }
}
