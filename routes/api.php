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

Route::get('/test', function () {
    return response()->json('test');
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/offers', [OfferController::class, 'index']);

Route::controller(CategoryController::class)
    ->prefix('categories')
    ->group(function (){
    Route::get('/', 'index');
    Route::get('/{category}', 'show');
});


Route::controller(ServiceController::class)
    ->prefix('services')
    ->group(function (){
        Route::get('/', 'index');
        Route::get('/{service}', 'show');
    });

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
