<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PlatController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    /**
     *CRUD Categories.
     */
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    /**
     * CRUD des Plats
     */
    Route::get('/plats', [PlatController::class, 'index']);
    Route::post('/plats', [PlatController::class, 'store']);
    Route::put('/plats/{id}', [PlatController::class, 'update']);
    Route::get('/plats/{id}', [PlatController::class, 'show']);
    Route::delete('/plats/{id}', [PlatController::class, 'destroy']);
});