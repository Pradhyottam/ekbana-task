<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CompanyController;

Route::apiResource('category', CategoryController::class);
Route::apiResource('company', CompanyController::class);
