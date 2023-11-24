# Seven.io Notification Channel

📲 Seven.io Notifications Channel for Laravel

## Contents

- [Installation](#installation)
    - [Setting up the Seven service](#setting-up-the-Seven-service)
- [Usage](#usage)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)

## Installation

```bash
composer require laravel-notification-channels/seven
```

Add the configuration to your `services.php` config file:

```php
'seven' => [
    'api_key' => env('SEVEN_API_KEY'),
    'signing_key' => env('SEVEN_SIGNING_KEY'),
]
```

### Setting up the Seven service

You'll need a Seven account. Head over to their [website](https://www.seven.io/) and create or log in to your account.

Generate API credentials by navigating to the API section in your account settings.

## Usage

You can use the channel in your `via()` method inside the notification:

```php
use Illuminate\Notifications\Notification;
use NotificationChannels\Seven\SevenMessage;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return ['seven'];
    }

    public function toSeven($notifiable)
    {
        return SevenMessage::create("Task #{$notifiable->id} is complete!");
    }
}
```

In your notifiable model, make sure to include a `routeNotificationForSeven()` method, which returns a phone number in the appropriate format.

```php
public function routeNotificationForSeven()
{
    return $this->phone; // Example: +1234567890 , need to include country code
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

```bash
composer test
```

## Security

If you discover any security-related issues, please contact support@example.com instead of using the issue tracker.