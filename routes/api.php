<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PgtAiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Test routes for debugging
Route::get('/', function() {
    return response()->json([
        'status' => 'success',
        'message' => 'Plant Disease Detector API'
    ]);
});

Route::get('/test', function() {
    return response()->json([
        'status' => 'success',
        'message' => 'API is working'
    ]);
});

// Debug route
Route::get('/debug', function(Request $request) {
    return response()->json([
        'status' => 'success',
        'request' => [
            'ip' => $request->ip(),
            'url' => $request->url(),
            'method' => $request->method(),
            'headers' => $request->headers->all()
        ]
    ]);
});

// Plant Disease Detection Routes - All Public
Route::prefix('v1')->group(function () {
    // Results endpoints
    Route::get('/results', [PgtAiController::class, 'index']);
    Route::post('/results', [PgtAiController::class, 'store']);
    Route::get('/results/shared', [PgtAiController::class, 'shared']);
    Route::get('/results/{result}', [PgtAiController::class, 'show']);
    Route::put('/results/{result}', [PgtAiController::class, 'update']);
    Route::delete('/results/{result}', [PgtAiController::class, 'destroy']);
}); 