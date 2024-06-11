<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Orders\OrdersListController;
use App\Http\Controllers\Users\UserCreateController;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\UserIsAdmin;

Route::prefix('/v1')->group(function () {
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/create/user', UserCreateController::class)->name('user.create');

    // USUARIO ADMIN E LOGADO
    Route::middleware([UserIsAdmin::class, 'auth:sanctum'])->group(function () {
       Route::get('/orders', OrdersListController::class)->name('orders.get');
    });

    // USUARIO COMUM E LOGADO
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/teste', function () {
            dd('logado e nao admin');
        })->name('teste.notadmin');
    });
});
