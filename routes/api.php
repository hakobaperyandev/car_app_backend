<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\EngineController;
use App\Http\Controllers\TransmissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('cars',               [CarModelController::class, 'index']);
    Route::get('cars/{car}',         [CarModelController::class, 'show']);
    Route::post('/logout',           [AuthController::class, 'logout']);
    Route::get('brands',             [BrandController::class, 'index']); 
    Route::get('engines',            [EngineController::class, 'index']);
    Route::get('transmissions',      [TransmissionController::class, 'index']);
    Route::get('interior-colors',    [CarModelController::class, 'interiorColors']);
    Route::get('exterior-colors',    [CarModelController::class, 'exteriorColors']); 
});
 

Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
    Route::post('cars',              [CarModelController::class, 'store']);
    Route::put('cars/{car}',         [CarModelController::class, 'update']);
    Route::delete('cars/{car}',      [CarModelController::class, 'destroy']);
});


