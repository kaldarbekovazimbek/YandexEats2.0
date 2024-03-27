<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\User\AuthUserController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthUserController::class, 'register']);
Route::post('/register/verify', [AuthUserController::class, 'confirmationEmail']);
Route::post('/login', [AuthUserController::class, 'login']);
Route::post('/logout', [AuthUserController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', [UserController::class, 'profile']);

    Route::get('/restaurants', [RestaurantController::class, 'index']);
    Route::get('/restaurants/{restaurantId}', [DishController::class, 'index']);

    Route::get('/cart', [CartController::class, 'show']);
    Route::post('/cart', [CartController::class, 'addToCart']);

    Route::get('/profile/orders', [OrderController::class, 'getUserOrders']);
    Route::get('/profile/orders/{orderId}', [OrderController::class, 'show']);

});

Route::get('/workers', [WorkerController::class, 'index']);
Route::post('/workers', [WorkerController::class, 'store']);
Route::get('/workers/{workerId}', [WorkerController::class, 'show']);
Route::put('/workers/{workerId}', [WorkerController::class, 'update']);
Route::delete('/workers/{workerId}', [WorkerController::class, 'destroy']);
Route::get('/workers/{restaurantId}/workers', [WorkerController::class, 'getByRestaurant']);
Route::get('/workers/{restaurantId}/orders', [WorkerController::class, 'getOrdersList']);

