<?php

namespace Notification;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->loadViewsFrom(
            __DIR__ . '/Resources/views',
            'notification'
        );
    }

}
