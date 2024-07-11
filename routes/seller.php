<?php

use App\Http\Controllers\Seller\AuthenticatedSessionController;
use App\Http\Controllers\Seller\RegisteredUserController;
use Illuminate\Support\Facades\Route;


// Auth Routes //////////////////////////////
Route::get('seller/dashboard', function () {
    return view('seller.dashboard');
})->middleware(['auth:seller'])->name('seller.dashboard');

Route::get('/seller-register', [RegisteredUserController::class, 'create'])
    ->middleware('guest:seller')
    ->name('seller.register');

Route::post('/seller-register', [RegisteredUserController::class, 'store'])
    ->middleware('guest:seller');

Route::get('/seller-login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest:seller')
    ->name('seller.login');

Route::post('/seller-login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest:seller');

Route::post('/seller-logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('seller.logout')
    ->middleware('auth:seller');
////////////////////////////////////////////////////
