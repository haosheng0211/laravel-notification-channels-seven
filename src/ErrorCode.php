<?php

namespace NotificationChannels\Seven;

class ErrorCode
{
    public const SMS_ACCEPTED = 100;

    public const SMS_TRANSMISSION_FAILED = 101;

    public const SENDER_INVALID = 201;

    public const RECIPIENT_INVALID = 202;

    public const VARIABLE_TO_NOT_SET = 301;

    public const VARIABLE_TEXT_NOT_SET = 305;

    public const VARIABLE_TEXT_TOO_LONG = 401;

    public const RELOAD_LOCK = 402;

    public const MAX_LIMIT_PER_DAY_REACHED = 403;

    public const INSUFFICIENT_CREDIT = 500;

    public const CARRIER_DELIVERY_FAILED = 600;

    public const AUTHENTICATION_FAILED = 900;

    public const SIGNING_HASH_VERIFICATION_FAILED = 901;

    public const API_KEY_ACCESS_DENIED = 902;

    public const WRONG_SERVER_IP = 903;

    public static function getErrorMessage($errorCode): string
    {
        switch ($errorCode) {
            case self::SMS_ACCEPTED:
                return 'The SMS was accepted by the gateway.';
            case self::SMS_TRANSMISSION_FAILED:
                return 'The transmission to at least one recipient failed.';
            case self::SENDER_INVALID:
                return 'The sender is invalid. A maximum of 11 alphanumeric or 16 numeric characters is allowed.';
            case self::RECIPIENT_INVALID:
                return 'The recipient number is invalid.';
            case self::VARIABLE_TO_NOT_SET:
                return 'The variable to is not set.';
            case self::VARIABLE_TEXT_NOT_SET:
                return 'The variable text is not set.';
            case self::VARIABLE_TEXT_TOO_LONG:
                return 'The variable text is too long.';
            case self::RELOAD_LOCK:
                return 'The Reload Lock prevents sending this SMS as it has already been sent within the last 180 seconds.';
            case self::MAX_LIMIT_PER_DAY_REACHED:
                return 'The maximum limit for this number per day has been reached.';
            case self::INSUFFICIENT_CREDIT:
                return 'The account has too little credit available.';
            case self::CARRIER_DELIVERY_FAILED:
                return 'The carrier delivery failed.';
            case self::AUTHENTICATION_FAILED:
                return 'The authentication failed. Please check your API key.';
            case self::SIGNING_HASH_VERIFICATION_FAILED:
                return 'The verification of the signing hash failed.';
            case self::API_KEY_ACCESS_DENIED:
                return 'The API key has no access rights to this endpoint.';
            case self::WRONG_SERVER_IP:
                return 'The server IP is wrong.';
            default:
                return 'Unknown error.';
        }
    }
}
