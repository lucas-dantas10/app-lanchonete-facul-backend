<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Carts\CartItemsCreateController;
use App\Http\Controllers\Carts\CartItemsDeleteController;
use App\Http\Controllers\Carts\CartItemsListController;
use App\Http\Controllers\Orders\OrdersClientListController;
use App\Http\Controllers\Orders\OrdersCreateController;
use App\Http\Controllers\Orders\OrdersListController;
use App\Http\Controllers\Orders\OrdersStatusController;
use App\Http\Controllers\Products\ProductListController;
use App\Http\Controllers\Users\UserCreateController;
use App\Http\Controllers\Users\UserImageController;
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
        Route::get('/products', ProductListController::class)->name('products.get');

        Route::get('/cart/items', CartItemsListController::class)->name('carts.get');
        Route::post('/cart/create', CartItemsCreateController::class)->name('carts.create');
        Route::delete('/cart/delete/{id}', CartItemsDeleteController::class)->name('carts.delete');

        Route::post('/orders/create', OrdersCreateController::class)->name('orders.post');
        Route::put('/orders/status/{id}', OrdersStatusController::class)->name('orders.put');
        Route::get('/orders/client', OrdersClientListController::class)->name('orders.client.get');

        Route::post('/user/upload-image', UserImageController::class)->name('users.image.post');

        Route::post('/logout', LogoutController::class)->name('logout.post');
    });
});
