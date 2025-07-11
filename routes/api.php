<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PgtAiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommunityController;
use App\Http\Controllers\Api\RegionController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/regions', [RegionController::class, 'index']);
Route::get('/regions/{region}/districts', [RegionController::class, 'getDistricts']);
Route::apiResource('/community', CommunityController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/experts', [AuthController::class, 'experts']);
    Route::apiResource('/community', CommunityController::class)->except(['index', 'show']);
    Route::post('community/{chat}/reply', [CommunityController::class, 'reply']);
    // Protect scan/store endpoints
    Route::post('/v1/results', [PgtAiController::class, 'store']);
    Route::put('/v1/results/{result}', [PgtAiController::class, 'update']);
    Route::delete('/v1/results/{result}', [PgtAiController::class, 'destroy']);
    Route::post('pgt-ai/results', [PgtAiController::class, 'store']);
    Route::get('/v1/my-scans', [PgtAiController::class, 'myScans']);
});

// Public endpoints
Route::get('/v1/results', [PgtAiController::class, 'index']);
Route::get('/v1/results/shared', [PgtAiController::class, 'shared']);
Route::get('/v1/results/{result}', [PgtAiController::class, 'show']);

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

Route::prefix('pgt-ai')->group(function () {
    Route::post('results', [PgtAiController::class, 'store']);
}); 