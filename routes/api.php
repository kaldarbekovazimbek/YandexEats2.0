<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantWorkerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{userId}', [UserController::class, 'show'])->name('users.store');
Route::match(['put', 'patch'], '/users/{userId}', [UserController::class, 'update'])->name('users.store');
Route::delete('/users/{userId}', [UserController::class, 'destroy'])->name('users.store');

Route::get('/users/{userId}/cart', [CartController::class, 'show']);
Route::post('/users/{userId}/cart', [CartController::class, 'addToCart']);

Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurant.store');
Route::get('/restaurants/{restaurantId}', [RestaurantController::class, 'show'])->name('restaurants.store');
Route::match(['put', 'patch'], '/restaurants/{restaurantId}', [RestaurantController::class, 'update'])->name('restaurants.store');
Route::delete('/restaurants/{restaurantId}', [RestaurantController::class, 'destroy'])->name('restaurants.store');

Route::get('/workers', [RestaurantWorkerController::class, 'index']);
Route::post('/workers', [RestaurantWorkerController::class, 'store']);
Route::get('/workers/{workerId}', [RestaurantWorkerController::class, 'show']);
Route::put('/workers/{workerId}', [RestaurantWorkerController::class, 'update']);
Route::delete('/workers/{workerId}', [RestaurantWorkerController::class, 'destroy']);
Route::get('/workers/{restaurantId}/workers', [RestaurantWorkerController::class, 'getByRestaurant']);
Route::get('/workers/{restaurantId}/orders', [RestaurantWorkerController::class, 'getOrdersList']);

Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders/{userId}', [OrderController::class, 'store']);
Route::get('/orders/{userId}', [OrderController::class, 'getUserOrders']);
Route::put('/orders/{orderId}', [OrderController::class, 'update']);
Route::get('/orders/{restaurantId}', [OrderController::class, 'getByRestaurant']);
