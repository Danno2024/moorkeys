<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ValidationController;

Route::prefix('v1')->middleware('api.auth')->group(function () {
    Route::post('validate', [ValidationController::class, 'validate'])->name('api.v1.validate');
    Route::post('activate', [ValidationController::class, 'activate'])->name('api.v1.activate');
    Route::post('deactivate', [ValidationController::class, 'deactivate'])->name('api.v1.deactivate');
    Route::get('key/{key}', [ValidationController::class, 'info'])->name('api.v1.key.info');
});
