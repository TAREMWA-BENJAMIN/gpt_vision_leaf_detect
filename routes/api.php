<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SubregionController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DistrictController;
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

// Test route to verify API is working
Route::get('/test', function() {
    return response()->json(['message' => 'API is working']);
});

// Plant Disease Detection Routes - Public for testing
Route::post('/v1/pgt-ai/results', [PgtAiController::class, 'store']);
Route::get('/v1/pgt-ai/results', [PgtAiController::class, 'index']);
Route::get('/v1/pgt-ai/results/shared', [PgtAiController::class, 'shared']);
Route::get('/v1/pgt-ai/results/{result}', [PgtAiController::class, 'show']);
Route::put('/v1/pgt-ai/results/{result}', [PgtAiController::class, 'update']);
Route::delete('/v1/pgt-ai/results/{result}', [PgtAiController::class, 'destroy']);

// Other routes can go here
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Version 1 API Routes
Route::prefix('v1')->group(function () {
    // Public routes
    Route::post('/register', [UserController::class, 'store']);
    Route::post('/login', [UserController::class, 'login']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        // User routes
        Route::apiResource('users', UserController::class);
        Route::get('users/{user}/profile', [UserController::class, 'profile']);
        Route::put('users/{user}/profile', [UserController::class, 'updateProfile']);
        Route::put('users/{user}/password', [UserController::class, 'updatePassword']);

        // Geographical Data Routes
        Route::prefix('geographical')->group(function () {
            // Get all regions
            Route::get('regions', [RegionController::class, 'index']);
            
            // Get subregions for a specific region
            Route::get('regions/{region}/subregions', [RegionController::class, 'subregions']);
            
            // Get countries for a specific region
            Route::get('regions/{region}/countries', [RegionController::class, 'countries']);
            
            // Get countries for a specific subregion
            Route::get('subregions/{subregion}/countries', [SubregionController::class, 'countries']);
            
            // Get districts for a specific country
            Route::get('countries/{country}/districts', [CountryController::class, 'districts']);
            
            // Get all countries (with optional region/subregion filter)
            Route::get('countries', [CountryController::class, 'index']);
            
            // Get all districts (with optional country filter)
            Route::get('districts', [DistrictController::class, 'index']);
        });
    });
}); 