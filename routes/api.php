<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{userId}', [UserController::class, 'show'])->name('users.store');
Route::match(['put', 'patch'],'/users/{userId}', [UserController::class, 'update'])->name('users.store');
Route::delete('/users/{userId}', [UserController::class, 'destroy'])->name('users.store');

Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurant.store');
Route::get('/restaurants/{restaurantId}', [RestaurantController::class, 'show'])->name('restaurants.store');
Route::match(['put', 'patch'],'/restaurants/{restaurantId}', [RestaurantController::class, 'update'])->name('restaurants.store');
Route::delete('/restaurants/{restaurantId', [RestaurantController::class, 'destroy'])->name('restaurants.store');

