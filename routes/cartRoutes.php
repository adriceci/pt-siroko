<?php

use Illuminate\Support\Facades\Route;
use Siroko\Infrastructure\Cart\Checkout\CartCheckoutController;
use Siroko\Infrastructure\Cart\Create\CartCreateController;
use Siroko\Infrastructure\Cart\Searcher\CartItemsSearcherController;
use Siroko\Infrastructure\Cart\Searcher\CartSearcherController;
use Siroko\Infrastructure\Cart\Update\CartUpdateController;
use Siroko\Infrastructure\Cart\View\CartController;

/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Cart routes for your application. These
| routes are loaded by the RouteServiceProvider and assigned to the "api" middleware group.
|
*/

Route::get('/cart', CartController::class)->name('cart');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/cart', CartCreateController::class)->name('cart.create');
    Route::get('/cart/{cart_id}', CartSearcherController::class)->name('cart.items');
    Route::put('/cart', CartUpdateController::class)->name('cart.update');
    Route::get('/cart/{cart_id}/items', CartItemsSearcherController::class)->name('cart.items');
    Route::post('/cart/{cart_id}/checkout', CartCheckoutController::class)->name('cart.checkout');
});
