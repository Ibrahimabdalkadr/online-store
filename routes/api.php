<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\TicketController;
use \App\Http\Controllers\MessageController;
Route::group(['prefix' => 'v1'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });

    Route::group(['middleware' => ['auth:api']], function () {
    Route::resource('ticket', TicketController::class)->only('index','show','store', 'update', 'destroy');
    Route::resource('message', MessageController::class);
    });



    Route::group(['middleware' => ['auth:api',\App\Http\Middleware\admin::class]], function () {
        Route::resource('user', UserController::class)->only('index','show','store', 'update', 'destroy');
        Route::resource('product', ProductController::class);
        Route::resource('category', CategoryController::class);
    });
});

