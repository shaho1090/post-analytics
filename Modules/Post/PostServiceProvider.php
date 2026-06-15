<?php

namespace Post;

use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->loadRoutes();
        $this->loadMigrations();
    }

    private function loadRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Presentation/Admin/Routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/Presentation/User/Routes/api.php');
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/Data/Migrations');
    }

}
