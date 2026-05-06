<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;

// ─────────────────────────────────────────────
// PUBLIC ROUTES
// ─────────────────────────────────────────────

// Homepage — Single Action Controller
Route::get('/', HomeController::class)->name('home');

// Contact Form (submit dari halaman publik)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Public Portfolio (read-only)
Route::resource('profiles', ProfileController::class)->only(['index', 'show']);
Route::resource('projects', ProjectController::class)->only(['index', 'show']);


// ─────────────────────────────────────────────
// AUTH ROUTES (Guest Only)
// ─────────────────────────────────────────────

Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'login']);
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// ─────────────────────────────────────────────
// ADMIN ROUTES (Auth Protected)
// ─────────────────────────────────────────────

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {

    // Dashboard — Single Action Controller
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Profiles CRUD (tanpa show — detail ada di halaman publik)
    Route::resource('profiles', AdminProfileController::class)->except(['show']);
    Route::post('/profiles/{profile}/set-active', [AdminProfileController::class, 'setActive'])
         ->name('profiles.set-active');

    // Projects CRUD (tanpa show)
    Route::resource('projects', AdminProjectController::class)->except(['show']);

    // Messages (read-only + hapus, tidak ada create/edit)
    Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);
    Route::post('/messages/{message}/read', [MessageController::class, 'markRead'])->name('messages.read');
    Route::post('/messages/read-all',       [MessageController::class, 'markAllRead'])->name('messages.read-all');
});