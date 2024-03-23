<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantWorkerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::post('/register', [AuthUserController::class, 'register']);
Route::post('/register/verify', [AuthUserController::class, 'confirmationEmail']);
Route::post('/login', [AuthUserController::class, 'login']);
Route::post('/logout', [AuthUserController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('check.token')->middleware('auth:sanctum')->group(function () {

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{userId}', [UserController::class, 'show']);
    Route::match(['put', 'patch'], '/users/{userId}', [UserController::class, 'update']);
    Route::delete('/users/{userId}', [UserController::class, 'destroy']);

    Route::get('/users/{userId}/cart', [CartController::class, 'show']);
    Route::post('/users/{userId}/cart', [CartController::class, 'addToCart']);

    Route::get('/restaurants', [RestaurantController::class, 'index']);
    Route::post('/restaurants', [RestaurantController::class, 'store']);
    Route::get('/restaurants/{restaurantId}', [RestaurantController::class, 'show']);
    Route::match(['put', 'patch'], '/restaurants/{restaurantId}', [RestaurantController::class, 'update']);
    Route::delete('/restaurants/{restaurantId}', [RestaurantController::class, 'destroy']);

    Route::get('/menu', [DishController::class, 'index']);
    Route::post('/menu', [DishController::class, 'store']);
    Route::match(['put', 'patch'], '/menu/{menuId}', [DishController::class, 'update']);
    Route::delete('/menu/{menuId}', [DishController::class, 'destroy']);

    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders/{userId}', [OrderController::class, 'store']);
    Route::get('/orders/{userId}', [OrderController::class, 'getUserOrders']);
    Route::put('/orders/{orderId}', [OrderController::class, 'update']);
    Route::get('/orders/{restaurantId}', [OrderController::class, 'getByRestaurant']);
});

Route::get('/workers', [RestaurantWorkerController::class, 'index']);
Route::post('/workers', [RestaurantWorkerController::class, 'store']);
Route::get('/workers/{workerId}', [RestaurantWorkerController::class, 'show']);
Route::put('/workers/{workerId}', [RestaurantWorkerController::class, 'update']);
Route::delete('/workers/{workerId}', [RestaurantWorkerController::class, 'destroy']);
Route::get('/workers/{restaurantId}/workers', [RestaurantWorkerController::class, 'getByRestaurant']);
Route::get('/workers/{restaurantId}/orders', [RestaurantWorkerController::class, 'getOrdersList']);

