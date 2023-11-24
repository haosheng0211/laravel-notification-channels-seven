<?php

namespace NotificationChannels\Seven;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\ServiceProvider;

class SevenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->app->bind(SevenChannel::class, function ($app) {
            $config = config('services.seven', []);

            return new SevenChannel(new SevenClient($config));
        });

        $this->app->resolving(ChannelManager::class, function (ChannelManager $channelManager) {
            $channelManager->extend('seven', function ($app) {
                return $app->make(SevenChannel::class);
            });
        });
    }

    public function provides(): array
    {
        return ['seven'];
    }
}
