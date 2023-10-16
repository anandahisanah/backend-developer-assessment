<?php

use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;

Route::prefix('package')->group(function () {
    Route::get('/', [PackageController::class, 'get']);
    Route::get('/{uuid}', [PackageController::class, 'first']);
    Route::post('/', [PackageController::class, 'create']);
    Route::put('/{uuid}', [PackageController::class, 'put']);
    Route::patch('/{uuid}', [PackageController::class, 'patch']);
    Route::delete('/{uuid}', [PackageController::class, 'delete']);
});
