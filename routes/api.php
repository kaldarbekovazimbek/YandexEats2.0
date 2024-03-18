<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{userId}', [UserController::class, 'show'])->name('users.store');
Route::match(['put', 'patch'],'/users/{userId}', [UserController::class, 'update'])->name('users.store');
Route::delete('/users/{userId}', [UserController::class, 'destroy'])->name('users.store');

