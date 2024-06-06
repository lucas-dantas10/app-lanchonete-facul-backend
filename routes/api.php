<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Users\UserCreateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/create/user', UserCreateController::class)->name('user.create');

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});


