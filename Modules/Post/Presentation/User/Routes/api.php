<?php

use Illuminate\Support\Facades\Route;
use Post\Presentation\User\Controllers\CreatePostController;

Route::prefix('api/posts')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('', CreatePostController::class);
    });
