<?php

use Illuminate\Support\Facades\Route;
use User\Presentation\User\Controllers\GetUserProfileController;
use User\Presentation\User\Controllers\LoginUserController;
use User\Presentation\User\Controllers\RegisterUserController;

Route::prefix('api')->group(function () {
    Route::post('/register', RegisterUserController::class);
    Route::post('/login', LoginUserController::class);
    Route::get('/user', GetUserProfileController::class)
        ->middleware('auth:sanctum');
});

