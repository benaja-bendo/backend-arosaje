<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('plants', \App\Http\Controllers\PlantController::class);
Route::apiResource('users', \App\Http\Controllers\UserController::class);
require __DIR__.'/auth.php';
