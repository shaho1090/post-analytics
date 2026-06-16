<?php

use Illuminate\Support\Facades\Route;
use Post\Presentation\User\Controllers\CreatePostController;
use Post\Presentation\User\Controllers\FindPostByIdController;

Route::prefix('api/posts')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('', CreatePostController::class);
        Route::get('{id}', FindPostByIdController::class);
    });
