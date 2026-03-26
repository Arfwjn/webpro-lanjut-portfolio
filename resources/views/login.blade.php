@extends('layouts.app')

@section('title', 'Login - Portfolio')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-slate-900 py-20 px-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <h1 class="font-lexend text-4xl font-bold bg-gradient-to-r from-emerald-500 to-emerald-600 bg-clip-text text-transparent mb-2">
                Admin Login
            </h1>
            <p class="text-gray-500 dark:text-gray-400">Masuk untuk mengelola portfolio</p>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl p-10 border border-gray-100 dark:border-gray-700">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-2xl">
                    <p class="text-red-600 dark:text-red-400 text-sm">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full px-5 py-4 rounded-2xl bg-gray-50 dark:bg-slate-700 border-2 border-gray-200 dark:border-gray-600 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-200 text-base outline-none @error('email') border-red-500 @enderror"
                        placeholder="admin@example.com"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full px-5 py-4 rounded-2xl bg-gray-50 dark:bg-slate-700 border-2 border-gray-200 dark:border-gray-600 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-200 text-base outline-none"
                        placeholder="••••••••"
                    >
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded accent-emerald-500">
                    <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-400">Ingat saya</label>
                </div>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold py-4 px-8 rounded-2xl text-lg shadow-xl hover:shadow-emerald-500/30 transition-all duration-300 transform hover:-translate-y-0.5"
                >
                    Masuk
                </button>
            </form>
        </div>

        <p class="text-center mt-6 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="text-emerald-500 hover:text-emerald-600 font-medium">
                ← Kembali ke Portfolio
            </a>
        </p>
    </div>
</div>
@endsection