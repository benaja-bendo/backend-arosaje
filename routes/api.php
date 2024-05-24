<?php

use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
//    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::apiResource('plants', \App\Http\Controllers\PlantController::class);
        Route::post('plants/{plant}/demands', [\App\Http\Controllers\DemandController::class, 'createDemand']);
        Route::get('plants/me/{id}', [\App\Http\Controllers\PlantController::class, 'getMyPlants']);
        Route::post('plants/{plant}/demands/{demand}/status', [\App\Http\Controllers\DemandController::class, 'updateDemandStatus']);
        Route::delete('plants/{plant}/demands/{demand}', [\App\Http\Controllers\DemandController::class, 'destroy']);
        //Route::get('plants/{plant}/interactions', [\App\Http\Controllers\InteractionController::class, 'createInteraction']);
        //Route::apiResource('advices', \App\Http\Controllers\AdviceController::class);
        Route::apiResource('users', \App\Http\Controllers\UserController::class);
        Route::post('users/{user}/profile-photo', [\App\Http\Controllers\UserController::class, 'changeProfilePhoto']);

        Route::get('messages/rooms', [MessageController::class, 'rooms']);
        Route::get('messages/all', [MessageController::class, 'index']);
        Route::post('messages', [MessageController::class, 'store']);
        Route::delete('messages/delete/{user_id}/{message_id}', [MessageController::class, 'destroy']);

//    });

    require __DIR__ . '/auth.php';
});



