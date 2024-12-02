<?php

use Illuminate\Support\Facades\Route;
use Graweb1\Connecto\Http\Controllers\ConnectoController;

Route::prefix('connecto')->group(function () {
    Route::get('/', [ConnectoController::class, 'index']);
    Route::get('/table_columns', [ConnectoController::class, 'tableColumns']);
    Route::post('/transfer_data', [ConnectoController::class, 'transferData']);
});
