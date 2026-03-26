<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;

// ─── Home ───────────────────────────────────────────────────────────────────
Route::get('/', function () {
    $projects = \App\Models\Project::latest()->take(6)->get();
    return view('home', compact('projects'));
})->name('home');

// ─── Contact ────────────────────────────────────────────────────────────────
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ─── Public Portfolio Routes ─────────────────────────────────────────────────
Route::resource('profiles', ProfileController::class)->only(['index', 'show']);
Route::resource('projects', ProjectController::class)->only(['index', 'show']);

// ─── Auth Routes (manual – tanpa paket starter kit) ──────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    });
});

Route::post('/logout', function (Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

// ─── Admin Protected Routes ───────────────────────────────────────────────────
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');

    Route::resource('profiles', ProfileController::class);
    Route::resource('projects', ProjectController::class);
});