<?php

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::group(['middleware' => 'auth:sanctum'], function () {

        // plant routes
        Route::apiResource('plants', \App\Http\Controllers\PlantController::class);

        // demand routes
        Route::post('plants/{plant}/demands', [\App\Http\Controllers\DemandController::class, 'createDemand']);
        Route::get('plants/me/{id}', [\App\Http\Controllers\PlantController::class, 'getMyPlants']);
        Route::post('plants/{plant}/demands/{demand}/status', [\App\Http\Controllers\DemandController::class, 'updateDemandStatus']);
        Route::delete('plants/{plant}/demands/{demand}', [\App\Http\Controllers\DemandController::class, 'destroy']);
        //Route::get('plants/{plant}/interactions', [\App\Http\Controllers\InteractionController::class, 'createInteraction']);
        //Route::apiResource('advices', \App\Http\Controllers\AdviceController::class);

        // interaction routes
        Route::apiResource('users', \App\Http\Controllers\UserController::class);
        Route::post('users/{user}/profile-photo', [\App\Http\Controllers\UserController::class, 'changeProfilePhoto']);

        // message routes
        Route::get('messages/users/{user_id}/rooms', [MessageController::class, 'rooms']);
        Route::get('messages/plants', [MessageController::class, 'index']);
        Route::post('messages/create', [MessageController::class, 'store']);
        Route::delete('messages/users/{user_id}/messages/{message_id}', [MessageController::class, 'destroy']);

        // conversation routes
        Route::get('conversations', [ConversationController::class, 'index']);
        Route::post('conversations', [ConversationController::class, 'store']);
        Route::get('conversations/{conversation}', [ConversationController::class, 'show']);
        Route::post('conversations/{conversation}/messages', [MessageController::class, 'store']);
        Route::get('conversations/{conversation}/messages', [MessageController::class, 'index']);

    });

    require __DIR__ . '/auth.php';
});



