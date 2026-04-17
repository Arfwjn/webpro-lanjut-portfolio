<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;

// Public Routes (Tidak butuh token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Route (Untuk mengecek data user yang sedang login)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Lindungi route CRUD Project dengan token auth
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectController::class);
});