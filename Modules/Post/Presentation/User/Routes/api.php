<?php

use Illuminate\Support\Facades\Route;
use Post\Presentation\User\Controllers\CreatePostController;
use Post\Presentation\User\Controllers\FindPostByIdController;
use Post\Presentation\User\Controllers\GetAllPostsController;

Route::prefix('api/posts')
    ->group(function () {
        Route::get('', GetAllPostsController::class);
        Route::post('', CreatePostController::class)->middleware('auth:sanctum');
        Route::get('{id}', FindPostByIdController::class)->middleware('auth:sanctum');
    });
