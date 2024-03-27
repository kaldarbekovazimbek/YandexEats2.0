<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\User\AuthUserController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Worker\AuthWorkerController;
use App\Http\Controllers\Worker\WorkerController;
use Illuminate\Support\Facades\Route;

Route::prefix('user/')->group(function () {
    Route::post('/register', [AuthUserController::class, 'register']);
    Route::post('/verify', [AuthUserController::class, 'confirmationEmail']);
    Route::post('/login', [AuthUserController::class, 'login']);
    Route::post('/logout', [AuthUserController::class, 'logout'])->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/profile', [UserController::class, 'profile']);

        Route::get('/restaurants', [RestaurantController::class, 'index']);
        Route::get('/restaurants/{restaurantId}', [DishController::class, 'index']);
        Route::get('/restaurants/{restaurantId}', [DishController::class, 'getDishByCategory']);

        Route::post('/cart', [CartController::class, 'addToCart']);
        Route::get('/cart', [CartController::class, 'show']);

        Route::post('/orders', [OrderController::class, 'store']);
        Route::get('/profile/orders', [OrderController::class, 'getUserOrders']);
        Route::get('/profile/orders/{orderId}', [OrderController::class, 'show']);
    });
});

Route::prefix('worker')->group(function () {
    Route::post('/register', [AuthWorkerController::class, 'register']);
    Route::post('/verify', [AuthWorkerController::class, 'confirmationEmail']);
    Route::post('/login', [AuthWorkerController::class, 'login']);
    Route::post('/logout', [AuthWorkerController::class, 'logout'])->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/profile', [WorkerController::class, 'profile']);
        Route::get('/orders', [OrderController::class, 'getRestaurantOrders']);
        Route::put('/orders/{orderId}', [OrderController::class, 'changeStatus']);
        Route::post('/dish', [DishController::class, 'store']);
        Route::put('/dish', [DishController::class, 'update']);
        Route::put('/dish', [DishController::class, 'delete']);

    });
});
