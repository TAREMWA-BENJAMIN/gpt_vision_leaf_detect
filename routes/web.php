<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PgtAiController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\ExpertController;

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'store']);
Route::get('districts/by-region', [App\Http\Controllers\UserController::class, 'getDistrictsByRegion'])->name('districts.by-region');

// Protected routes
Route::middleware(['auth', 'verified'])->group(function () {
    // User list route (now protected)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart-data');

    // Routes for AI Scan Results Report
    Route::get('/reports/pgt-ai-results', [DashboardController::class, 'showPgtAiResults'])->name('reports.pgt-ai-results');
    Route::get('/reports/pgt-ai-results/pdf', [DashboardController::class, 'exportPgtAiResultsPdf'])->name('reports.pgt-ai-results.pdf');
    Route::get('/reports/pgt-ai-results/excel', [DashboardController::class, 'exportPgtAiResultsExcel'])->name('reports.pgt-ai-results.excel');
    Route::get('/reports/generate', [PgtAiController::class, 'generateReport'])->name('reports.generate');

    // User management
    Route::resource('users', UserController::class);
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/districts/{countryId}', [UserProfileController::class, 'getDistricts'])->name('profile.districts');
    Route::put('password', [UserController::class, 'updatePassword'])->name('password.update');

    // Geographical data for user edit form
    Route::get('users/get-subregions', [UserController::class, 'getSubregions'])->name('users.get-subregions');
    Route::get('users/get-countries', [UserController::class, 'getCountries'])->name('users.get-countries');
    Route::get('users/get-districts', [UserController::class, 'getDistricts'])->name('users.get-districts');

    // Region management
    Route::resource('regions', RegionController::class);
    Route::get('regions/{region}/subregions', [RegionController::class, 'subregions'])->name('regions.subregions');
    Route::get('regions/{region}/countries', [RegionController::class, 'countries'])->name('regions.countries');

    // District management
    // Route::resource('districts', DistrictController::class);
    Route::get('districts/{district}/users', [DistrictController::class, 'users'])->name('districts.users');

    // Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

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

    // Routes for Disease Management
    Route::resource('/diseases', DiseaseController::class);

    // Routes for Community Forum
    Route::resource('/community', CommunityController::class);
    Route::post('/community/{message}/reply', [CommunityController::class, 'reply'])->name('community.reply');

    // Settings routes
    Route::get('/settings', [App\Http\Controllers\UserProfileController::class, 'show'])->name('settings.show');
    Route::get('/settings/edit', [App\Http\Controllers\UserProfileController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [App\Http\Controllers\UserProfileController::class, 'update'])->name('settings.update');
});

// Disease Management (Temporarily moved outside auth middleware for testing)
Route::get('/diseases', [App\Http\Controllers\DiseaseController::class, 'index'])->name('diseases.index');

// Agricultural Experts
Route::get('/experts', [App\Http\Controllers\ExpertController::class, 'index'])->name('experts.index');

Route::get('/search/users', [App\Http\Controllers\UserController::class, 'search'])->name('users.search');

