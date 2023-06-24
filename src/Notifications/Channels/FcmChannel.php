<?php

namespace Danieletulone\LaravelToolkit\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Google\Client;
use GuzzleHttp\Client as GuzzleHttpClient;

class FcmChannel
{
    public function createClient(): GuzzleHttpClient
    {
        $client = new Client();

        // provide the JSON authentication file from storage.
        $client->setAuthConfig(config('laravel-toolkit.notification.firebase.credentials'));

        // Add the scope as a string (multiple scopes can be provided as an array)
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        // Returns an instance of GuzzleHttp\Client that authenticates with the Google API.
        return $client->authorize();
    }

    /**
     * Send a notification to a topic.
     *
     * @param string $topic
     * @param string $title
     * @param string $body
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send($notifiable, Notification $notification)
    {
        $payload = $notification->toFcm($notifiable);

        $client = $this->createClient();

        $project = $this->getProjectFromCredetials();

        $response = $client->post(
            "https://fcm.googleapis.com/v1/projects/{$project}/messages:send",
            ['json' => $payload]
        );

        return $response;
    }

    public function getProjectFromCredetials(): string
    {
        $credentials = json_decode(file_get_contents(
            config('laravel-toolkit.notification.firebase.credentials')
        ), true);

        return $credentials['project_id'];
    }
}
