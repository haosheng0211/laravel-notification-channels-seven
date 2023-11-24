<?php

namespace NotificationChannels\Seven;

use Illuminate\Notifications\Notification;
use NotificationChannels\Seven\Exceptions\CouldNotSendNotification;

class SevenChannel
{
    protected $client;

    public function __construct(SevenClient $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $to = $notifiable->routeNotificationFor('seven');

        if (! $to) {
            throw CouldNotSendNotification::missingTo();
        }

        if (! method_exists($notification, 'toSeven')) {
            throw new \InvalidArgumentException('Notification does not have a toSeven method');
        }

        $message = $notification->toSeven($notifiable);

        if (is_string($message)) {
            $message = new SevenMessage($message);
        }

        try {
            $response = $this->client->send($to, $message->content);
        } catch (\Throwable $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception->getMessage());
        }
    }
}
