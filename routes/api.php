<?php

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KpopController;
use App\Http\Middleware\KpopTokenIsValid;
use App\Http\Controllers\Api\LogoutController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    Route::apiResource('/kpop', KpopController::class)->middleware('jwt');
    Route::post('register', [RegisterController::class, 'store']);
    // Route::post('register', [RegisterController::class, 'store']);
    Route::post('login', App\Http\Controllers\Api\LoginController::class);
    Route::post('/logout', LogoutController::class);
