<?php

use App\Providers\AppServiceProvider;
use Post\PostServiceProvider;
use Shared\SharedServiceProvider;
use User\UserServiceProvider;

return [
    AppServiceProvider::class,
    UserServiceProvider::class,
    SharedServiceProvider::class,
    PostServiceProvider::class,
];
