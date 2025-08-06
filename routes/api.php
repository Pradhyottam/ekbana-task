<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([ApiKeyMiddleware::class])->group(function () {
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('company', CompanyController::class);
});
