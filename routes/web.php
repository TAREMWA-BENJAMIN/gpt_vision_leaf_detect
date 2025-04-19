<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SubregionController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PgtAiController;

// Public routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'store']);

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User management
    Route::resource('users', UserController::class);
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::put('profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('password', [UserController::class, 'updatePassword'])->name('password.update');

    // Region management
    Route::resource('regions', RegionController::class);
    Route::get('regions/{region}/subregions', [RegionController::class, 'subregions'])->name('regions.subregions');
    Route::get('regions/{region}/countries', [RegionController::class, 'countries'])->name('regions.countries');

    // Subregion management
    Route::resource('subregions', SubregionController::class);
    Route::get('subregions/{subregion}/countries', [SubregionController::class, 'countries'])->name('subregions.countries');

    // Country management
    Route::resource('countries', CountryController::class);
    Route::get('countries/{country}/districts', [CountryController::class, 'districts'])->name('countries.districts');
    Route::get('countries/{country}/users', [CountryController::class, 'users'])->name('countries.users');

    // District management
    Route::resource('districts', DistrictController::class);
    Route::get('districts/{district}/users', [DistrictController::class, 'users'])->name('districts.users');

    // Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Plant Disease Detection Routes
    Route::prefix('pgt-ai')->name('pgt-ai.')->group(function () {
        // Dashboard/Overview
        Route::get('/dashboard', [PgtAiController::class, 'dashboard'])->name('dashboard');
        
        // Results Management
        Route::get('/results', [PgtAiController::class, 'index'])->name('results.index');
        Route::get('/results/{result}', [PgtAiController::class, 'show'])->name('results.show');
        Route::put('/results/{result}', [PgtAiController::class, 'update'])->name('results.update');
        Route::delete('/results/{result}', [PgtAiController::class, 'destroy'])->name('results.destroy');
        
        // Shared Results
        Route::get('/shared', [PgtAiController::class, 'shared'])->name('shared');
        
        // User Results
        Route::get('/users/{user}/results', [PgtAiController::class, 'userResults'])->name('users.results');
    });
});

