<?php

namespace Danieletulone\LaravelToolkit\Traits\Notification;

use Danieletulone\LaravelToolkit\Traits\Notification\DotNameDeductible;

trait HasTranslations
{
    use DotNameDeductible;

    /**
     * Get the translation key for the given "for" of notification.
     * The section can be either title or body.
     * Generate: `notification.{dot_name}.{for}`
     */
    protected function getTranslationKeyFor(string $for, string $type)
    {
        return implode('.', ['notification', $type, $this->getDotName(), $for]);
    }

    /**
     * Get the translation locale for the user to send the current notification.
     */
    protected function getTranslationLocale($notifiable)
    {
        $userModel = config(
            'laravel-toolkit.notification.notifiable_model',
            'App\Models\User'
        );

        if ($notifiable instanceof $userModel) {
            $userLangField = config(
                'laravel-toolkit.notification.notifiable_lang_field',
                'lang'
            );

            return $notifiable->{$userLangField};
        }

        return config('app.locale');
    }

    /**
     * Get the translation replacers for current notification.
     */
    protected function getTranslationReplace($notifiable): array
    {
        return [];
    }
}
