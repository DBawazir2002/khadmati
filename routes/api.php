<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/offers', [OfferController::class, 'index']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/services', [ServiceController::class, 'index']);

Route::middleware('auth:sanctum')
    ->prefix('dashboard')
    ->name('.dashboard')
    ->group(function () {
        Route::get('/', DashboardController::class);
        Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('offers', OfferController::class);
        Route::apiResource('services', ServiceController::class);
        Route::apiResource('workers', WorkerController::class);
    });
