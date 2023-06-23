<?php

namespace Danieletulone\LaravelToolkit\Traits\Notification;

use Danieletulone\LaravelToolkit\Notifications\Channels\FcmChannel;
use DanieleTulone\LaravelToolkit\Traits\Notification\HasTranslations;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\Notification;

trait FcmSendible
{
    use DotNameDeductible, HasTranslations;

    public static function fcmChannel()
    {
        return FcmChannel::class;
    }

    /**
     * Indicates if the notification should be sent via mail.
     */
    public function shouldBeSentViaFcm($notifiable): bool
    {
        return true;
    }

    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setData($this->fcmData())
            ->setTopic($this->fcmTopic($notifiable))
            ->setNotification($this->fcmNotification($notifiable))
            ->setAndroid($this->fcmAndroidConfig())
            ->setApns($this->fcmApnsConfig());
    }

    public function fcmNotification($notifiable)
    {
        return Notification::create()
            ->setTitle($this->fcmTitle($notifiable))
            ->setBody($this->fcmBody($notifiable));
    }

    public function fcmAndroidConfig()
    {
        return AndroidConfig::create()
            ->setNotification(AndroidNotification::create());
    }

    public function fcmApnsConfig()
    {
        return ApnsConfig::create();
    }

    /**
     * The topic of the notification.
     * By default, the topic is the user id.
     * If the notifiable is not an AppUser, the topic is the notifiable itself.
     */
    public function fcmTopic($notifiable): string
    {
        $userModel = config(
            'laravel-toolkit.notification.notifiable_model',
            'App\Models\User'
        );

        $usePrefix = config(
            'laravel-toolkit.notification.use_prefix',
            true
        );

        if ($notifiable instanceof $userModel) {
            if ($usePrefix) {
                return prefix($notifiable->id);
            }

            return $notifiable->id;
        }

        if ($usePrefix) {
            return prefix($notifiable);
        }

        return $notifiable;
    }

    /**
     * The title of the notification.
     * This title will be sent to the client app.
     */
    public function fcmTitle($notifiable): string
    {
        return __(
            $this->getTranslationKeyFor('title', 'fcm'),
            $this->getTranslationReplace($notifiable),
            $this->getTranslationLocale($notifiable)
        );
    }

    /**
     * The body of the notification.
     * This body will be sent to the client app.
     */
    public function fcmBody($notifiable): string
    {
        return __(
            $this->getTranslationKeyFor('body', 'fcm'),
            $this->getTranslationReplace($notifiable),
            $this->getTranslationLocale($notifiable)
        );
    }

    /**
     * The data of the fcm notification.
     * This data will be sent to the client app.
     */
    public function fcmData(): array
    {
        return [];
    }
}
