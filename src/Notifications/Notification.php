<?php

namespace Danieletulone\LaravelToolkit\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification as BaseNotification;
use Illuminate\Support\Str;

class Notification extends BaseNotification
{
    use Queueable;

    /**
     * Get dynamically "via" from trait used.
     * Trait must have the prefix Sendible.
     */
    public function via($notifiable)
    {
        $via = [];

        foreach ($this->sendibleTraits() as $trait) {
            $viaNameFromTrait = $this->getViaNameFromTrait($trait);

            if ($this->shouldBeSentVia($viaNameFromTrait, $notifiable)) {
                $via[] = $viaNameFromTrait;
            }
        }

        return $via;
    }

    /**
     * Get Sendible trait used by class.
     */
    public function sendibleTraits()
    {
        return array_filter(
            class_uses_recursive(static::class),
            function ($trait) {
                return Str::endsWith($trait, 'Sendible');
            }
        );
    }

    /**
     * Check if the notification should be sent via "$via".
     * The logic MUST BE implemented into ${via}Sendible Trait.
     */
    private function shouldBeSentVia($via, $notifiable): bool
    {
        return $this->{'shouldBeSentVia' . $via}($notifiable);
    }

    /**
     * Get the "via" name from the trait basename.
     */
    private function getViaNameFromTrait($trait)
    {
        return Str::camel(
            Str::replace(
                'Sendible',
                '',
                class_basename($trait)
            )
        );
    }
}
