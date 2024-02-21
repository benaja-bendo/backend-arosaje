<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('plants', \App\Http\Controllers\PlantController::class);
Route::post('plants/{plant}/demands', [\App\Http\Controllers\DemandController::class, 'createDemand']);
Route::post('plants/{plant}/demands/{demand}/status', [\App\Http\Controllers\DemandController::class, 'updateDemandStatus']);
Route::delete('plants/{plant}/demands/{demand}', [\App\Http\Controllers\DemandController::class, 'destroy']);
Route::get('plants/{plant}/interactions', [\App\Http\Controllers\InteractionController::class, 'createInteraction']);

Route::apiResource('users', \App\Http\Controllers\UserController::class);
Route::post('users/{user}/profile-photo', [\App\Http\Controllers\UserController::class, 'changeProfilePhoto']);

require __DIR__.'/auth.php';
