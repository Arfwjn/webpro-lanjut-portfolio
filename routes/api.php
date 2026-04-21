<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ProfileController;

// --- PUBLIC ROUTES (Bisa diakses siapa saja) ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);

Route::get('/profiles', [ProfileController::class, 'index']);
Route::get('/profiles/{id}', [ProfileController::class, 'show']);


// --- PROTECTED ROUTES (Hanya Admin yang memiliki Bearer Token) ---
Route::middleware('auth:sanctum')->group(function () {
    // Rute manipulasi Proyek
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
    
    // Rute manipulasi Profil
    Route::post('/profiles', [ProfileController::class, 'store']);
    Route::put('/profiles/{id}', [ProfileController::class, 'update']); // Catatan Postman: Jika update via form-data upload gambar, gunakan POST dengan tambahan field _method=PUT
    Route::delete('/profiles/{id}', [ProfileController::class, 'destroy']);
});