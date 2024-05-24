<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'documentation')->name('documentation');

Route::get('/documentation/json', function () {
    $openapi = \OpenApi\Generator::scan(['../app']);
    return response()
        ->json($openapi)
        ->header('Content-Type', 'application/json');
//        ->header('Content-Type', 'application/yaml');
})->name('documentation.json');

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
