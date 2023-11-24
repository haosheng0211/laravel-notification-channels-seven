<?php

namespace NotificationChannels\Seven;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use NotificationChannels\Seven\Exceptions\CouldNotSendNotification;

class SevenClient
{
    private $host;

    private $api_key;

    private $signing_key;

    public function __construct(array $config)
    {
        $this->host = data_get($config, 'host', 'https://gateway.sms77.io/api');
        $this->api_key = data_get($config, 'api_key');
        $this->signing_key = data_get($config, 'signing_key');
    }

    public function send(string $to, string $text): Response
    {
        $method = 'POST';
        $url = $this->host.'/sms';
        $body = ['to' => $to, 'text' => $text];
        $signingSecret = $this->signing_key;
        $signatureData = $this->createSignature($method, $url, $body, $signingSecret);

        $response = Http::withHeaders([
            'X-Signature' => $signatureData['signature'],
            'X-Timestamp' => $signatureData['timestamp'],
            'X-Nonce' => $signatureData['nonce'],
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'basic '.$this->api_key,
        ])->post($url, $body);

        if ($response->failed()) {
            throw CouldNotSendNotification::serviceRespondedWithAnError('HTTP request failed.');
        }

        $errorCode = (int) $response->json('success');

        if ($errorCode !== ErrorCode::SMS_ACCEPTED) {
            throw CouldNotSendNotification::serviceRespondedWithAnError(ErrorCode::getErrorMessage($errorCode));
        }

        return $response;
    }

    private function createSignature($method, $url, $body, $signingSecret): array
    {
        $nonce = bin2hex(random_bytes(16));
        $timestamp = time();
        $bodyMD5 = md5(json_encode($body));

        $stringToSign = implode("\n", [
            $timestamp,
            $nonce,
            strtoupper($method),
            $url,
            $bodyMD5,
        ]);

        return [
            'signature' => hash_hmac('sha256', $stringToSign, $signingSecret),
            'timestamp' => $timestamp,
            'nonce' => $nonce,
        ];
    }
}
