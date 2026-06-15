<?php

namespace User;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->loadRoutes();
    }

    private function loadRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Presentation/Admin/Routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/Presentation/User/Routes/api.php');
    }

}
