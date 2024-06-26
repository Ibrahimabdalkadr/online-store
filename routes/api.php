<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\CategoryController;

Route::group(['prefix' => 'v1'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });


});

Route::group(['middleware' => ['admin']], function () {
    Route::resource('user', UserController::class);
    Route::resource('product', ProductController::class);
    Route::resource('category', CategoryController::class);
});
