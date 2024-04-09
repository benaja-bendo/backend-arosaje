<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('plants', \App\Http\Controllers\PlantController::class);
    Route::post('plants/{plant}/demands', [\App\Http\Controllers\DemandController::class, 'createDemand']);
    Route::get('plants/me/{id}', [\App\Http\Controllers\PlantController::class, 'getMyPlants']);
    Route::post('plants/{plant}/demands/{demand}/status', [\App\Http\Controllers\DemandController::class, 'updateDemandStatus']);
    Route::delete('plants/{plant}/demands/{demand}', [\App\Http\Controllers\DemandController::class, 'destroy']);
//Route::get('plants/{plant}/interactions', [\App\Http\Controllers\InteractionController::class, 'createInteraction']);
//Route::apiResource('advices', \App\Http\Controllers\AdviceController::class);
    Route::apiResource('users', \App\Http\Controllers\UserController::class);
    Route::post('users/{user}/profile-photo', [\App\Http\Controllers\UserController::class, 'changeProfilePhoto']);
});


Route::post('/newsletter', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'comment' => 'nullable|string',
    ]);

    try {
        $file = fopen('newsletter.txt', 'a');
        fwrite($file, $request->email . "\n");
        fclose($file);
    } catch (Exception $e) {
        return response()->json([
            'message' => 'An error occurred while saving your email.',
        ], 500);
    }

    return response()->json([
        'message' => 'You have been subscribed to our newsletter.',
    ]);
});

Route::get('/newsletter/avis', function () {
    try {
        $file = fopen('newsletter.txt', 'r');
        $emails = [];
        while (!feof($file)) {
            $email = fgets($file);
            if ($email !== false) {
                $emails[] = trim($email);
            }
        }
        fclose($file);
    } catch (Exception $e) {
        return response()->json([
            'message' => 'An error occurred while retrieving the emails.',
        ], 500);
    }

    return response()->json([
        'emails' => $emails,
        'message' => 'Emails retrieved successfully.',
    ]);
});

require __DIR__ . '/auth.php';
