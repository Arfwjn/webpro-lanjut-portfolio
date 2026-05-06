<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ProfileController;


// ─────────────────────────────────────────────
// PUBLIC ROUTES (Tidak perlu autentikasi)
// ─────────────────────────────────────────────

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::get('/projects',      [ProjectController::class, 'index']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);

Route::get('/profiles',      [ProfileController::class, 'index']);
Route::get('/profiles/{id}', [ProfileController::class, 'show']);


// ─────────────────────────────────────────────
// PROTECTED ROUTES (Perlu Bearer Token — auth:sanctum)
// ─────────────────────────────────────────────

Route::middleware('auth:sanctum')->group(function () {

    // Projects
    Route::post('/projects',      [ProjectController::class, 'store']);
    Route::put('/projects/{id}',  [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

    // Profiles
    // Catatan: Jika update menggunakan form-data dengan upload gambar via Postman,
    // gunakan method POST dan tambahkan field _method=PUT karena
    // PHP tidak membaca body pada request PUT multipart/form-data.
    Route::post('/profiles',      [ProfileController::class, 'store']);
    Route::post('/profiles/{id}', [ProfileController::class, 'update']);   // form-data (gambar)
    Route::put('/profiles/{id}',  [ProfileController::class, 'update']);   // json (tanpa gambar)
    Route::delete('/profiles/{id}', [ProfileController::class, 'destroy']);
});