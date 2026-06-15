<?php

use User\Presentation\User\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::post('/register',RegisterUserController::class);
});

