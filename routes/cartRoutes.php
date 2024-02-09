<?php

use Illuminate\Support\Facades\Route;
use Siroko\Infrastructure\Cart\Create\CartCreateController;

/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Cart routes for your application. These
| routes are loaded by the RouteServiceProvider and assigned to the "api" middleware group.
|
*/

// Create a new Cart
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/cart', CartCreateController::class)->name('cart.create');
});
