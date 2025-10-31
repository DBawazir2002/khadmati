<?php

use App\Http\Controllers\OfferController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


Route::post('/login', LoginController::class)->middleware('guest');



Route::middleware('auth:sanctum')
    ->prefix('dashboard')
    ->name('.dashboard')
    ->group(function () {
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('offers', OfferController::class);
        Route::apiResource('services', ServiceController::class);
    });
