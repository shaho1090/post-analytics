<?php

use App\Providers\AppServiceProvider;
use Notification\NotificationServiceProvider;
use Post\PostServiceProvider;
use Shared\SharedServiceProvider;
use User\UserServiceProvider;

return [
    AppServiceProvider::class,
    UserServiceProvider::class,
    SharedServiceProvider::class,
    PostServiceProvider::class,
    NotificationServiceProvider::class,
];
