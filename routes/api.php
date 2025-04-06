<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\EmployeeController;

// API Routes
Route::group(['prefix' => 'api', 'middleware' => 'api'], function () {
    // Countries API
    Route::get('/countries', [CountryController::class, 'index']);
    Route::get('/countries/{id}', [CountryController::class, 'show']);
    Route::post('/countries', [CountryController::class, 'store']);
    Route::put('/countries/{id}', [CountryController::class, 'update']);
    Route::delete('/countries/{id}', [CountryController::class, 'destroy']);
    
    // Employees API
    Route::apiResource('employees', EmployeeController::class);
});
