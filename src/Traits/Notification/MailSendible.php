<?php

namespace Danieletulone\LaravelToolkit\Traits\Notification;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\View;
use Danieletulone\LaravelToolkit\Traits\Notification\DotNameDedectible;

trait MailSendible
{
    use DotNameDeductible;

    public static function mailChannel()
    {
        return 'mail';
    }

    /**
     * Indicates if the notification should be sent via mail.
     */
    public function shouldBeSentViaMail($notifiable): bool
    {
        return true;
    }

    public function getMailView()
    {
        return 'mail.' . $this->getDotName();
    }

    public function getMailSubject($notifiable)
    {
        return __(
            $this->getTranslationKeyFor('subject', 'mail'),
            $this->getTranslationReplace($notifiable),
            $this->getTranslationLocale($notifiable)
        );
    }

    public function getMailBody($notifiable)
    {
        return __(
            $this->getTranslationKeyFor('body', 'mail'),
            $this->getTranslationReplace($notifiable),
            $this->getTranslationLocale($notifiable)
        );
    }

    public function toMail($notifiable)
    {
        $view = View::exists($this->getMailView())
            ? $this->getMailView()
            : 'mail.simple';

        return (new MailMessage)
            ->subject($this->getMailSubject($notifiable))
            ->markdown(
                $view,
                [
                    ...$this->getTranslationReplace($notifiable),
                    'notifiable' => $notifiable,
                    'locale' => $this->getTranslationLocale($notifiable),
                    'body' => $this->getMailBody($notifiable),
                ]
            );
    }
}
