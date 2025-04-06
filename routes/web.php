<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('api')
    ->prefix('api/v1')
    ->group(function () {
        Route::apiResource('employees', \App\Http\Controllers\Api\EmployeeController::class);
    });
