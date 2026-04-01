<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;

// Home (gunakan profil aktif, fallback ke profil pertama)
Route::get('/', function () {
    $projects = \App\Models\Project::latest()->take(6)->get();
    $profile  = \App\Models\Profile::getActive();
    return view('home', compact('projects', 'profile'));
})->name('home');

// Contact Form
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Public Portfolio Routes
Route::resource('profiles', ProfileController::class)->only(['index', 'show']);
Route::resource('projects', ProjectController::class)->only(['index', 'show']);

// Auth Routes
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

// Admin Protected Routes
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('profiles', \App\Http\Controllers\Admin\ProfileController::class)
         ->except(['show'])
         ->names([
             'index'   => 'profiles.index',
             'create'  => 'profiles.create',
             'store'   => 'profiles.store',
             'edit'    => 'profiles.edit',
             'update'  => 'profiles.update',
             'destroy' => 'profiles.destroy',
         ]);

    // Set profil aktif (ditampilkan di homepage)
    Route::post('/profiles/{profile}/set-active', [\App\Http\Controllers\Admin\ProfileController::class, 'setActive'])
         ->name('profiles.set-active');

    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class)
         ->except(['show'])
         ->names([
             'index'   => 'projects.index',
             'create'  => 'projects.create',
             'store'   => 'projects.store',
             'edit'    => 'projects.edit',
             'update'  => 'projects.update',
             'destroy' => 'projects.destroy',
         ]);

    // Messages (Pesan dari form contact)
    Route::resource('messages', \App\Http\Controllers\Admin\MessageController::class)
         ->only(['index', 'show', 'destroy'])
         ->names([
             'index'   => 'messages.index',
             'show'    => 'messages.show',
             'destroy' => 'messages.destroy',
         ]);

    Route::post('/messages/{message}/read', [\App\Http\Controllers\Admin\MessageController::class, 'markRead'])
         ->name('messages.read');
    Route::post('/messages/read-all', [\App\Http\Controllers\Admin\MessageController::class, 'markAllRead'])
         ->name('messages.read-all');
});