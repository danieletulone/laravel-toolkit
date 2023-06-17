<?php

namespace Danieletulone\LaravelToolkit\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QueueStuckMail extends Mailable
{
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('emails.queue-stuck')
            ->subject($this->getSubject());
    }

    /**
     * Get subject of email.
     */
    private function getSubject(): string
    {
        return config('app.name') . ' - Queue Stuck';
    }
}
