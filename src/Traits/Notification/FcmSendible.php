<?php

namespace Danieletulone\LaravelToolkit\Traits\Notification;

use Danieletulone\LaravelToolkit\Notifications\Channels\FcmChannel;
use Danieletulone\LaravelToolkit\Traits\Notification\HasTranslations;

trait FcmSendible
{
    use DotNameDeductible, HasTranslations;

    /**
     * Get the notification's delivery channels.
     */
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

    /**
     * Get the FCM representation of the notification.
     */
    public function toFcm($notifiable)
    {
        $data = $this->fcmData();

        $message = [
            "message" => [
                "topic" => $this->fcmTopic($notifiable),
                "notification" => $this->fcmNotification($notifiable),
                "apns" => [
                    "payload" => [
                        "aps" => [
                            "badge" => 1,
                        ],
                    ],
                ],
            ],
        ];

        if ($data != null && (is_array($data) && count($data) > 0)) {
            $message['message']['data'] = $data;
        }

        return $message;
    }

    public function fcmNotification($notifiable)
    {
        return [
            "body" => $this->fcmBody($notifiable),
            "title" => $this->fcmTitle($notifiable),
        ];
    }

    /**
     * Get the APNs representation of the notification.
     */
    public function fcmApnsConfig()
    {
        return [
            "payload" => [
                "aps" => [
                    "badge" => 1,
                ],
            ],
        ];
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
