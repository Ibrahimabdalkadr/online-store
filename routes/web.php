<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api']], function () {
Route::get('/', function () {
    return 'Api v1';
});

});

