<?php

use App\Providers\AppServiceProvider;
use Shared\SharedServiceProvider;
use User\UserServiceProvider;

return [
    AppServiceProvider::class,
    UserServiceProvider::class,
    SharedServiceProvider::class,
];
