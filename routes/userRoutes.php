<?php

use Illuminate\Support\Facades\Route;
use Siroko\Infrastructure\User\Auth\AuthUserController;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "userRoutes" middleware group.
|
*/

// Auth User
Route::post('/user/auth', AuthUserController::class)->name('user.auth');
