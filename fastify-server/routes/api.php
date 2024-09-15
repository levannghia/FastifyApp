<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Route::apiResource('categories', CategoryController::class);
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('refresh', [AuthController::class, 'refresh'])->middleware(['check_tokens', 'auth:sanctum']);
    });

    Route::middleware(['auth:sanctum', 'check_tokens'])->group(function () {
        Route::get('user', function (Request $request) {
            return new UserResource($request->user());
        });

        Route::prefix('category')->group(function () {
            Route::get('/{category:id}', [CategoryController::class,'show']);
            Route::get('/{category:id}/products', [CategoryController::class,'getProductsByCategoryId']);

        });

        Route::prefix('order')->group(function () {
            Route::post('/store', [OrderController::class,'store']);
            Route::post('/confirm-order/{order:id}', [OrderController::class,'confirmOrder']);
        });
    });
});