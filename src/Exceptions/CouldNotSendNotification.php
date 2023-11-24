<?php

namespace NotificationChannels\Seven\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function missingTo(): CouldNotSendNotification
    {
        return new static('Notification was not sent. Missing `to` number.');
    }

    public static function serviceRespondedWithAnError(string $exception): CouldNotSendNotification
    {
        return new static('Seven.io responded with an error: '.$exception);
    }
}
