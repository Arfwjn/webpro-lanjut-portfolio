@extends('layouts.app')

@section('title', 'Admin Dashboard - Portfolio')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-6 max-w-7xl">

        {{-- Header --}}
        <div class="mb-10">
            <h1 class="font-lexend text-4xl font-bold text-gray-900 dark:text-white mb-2">
                Dashboard Admin
            </h1>
            <p class="text-gray-500 dark:text-gray-400">
                Selamat datang, {{ auth()->user()->name }}. Kelola konten portfolio Anda di sini.
            </p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

            <div class="bg-white dark:bg-slate-800 p-7 rounded-3xl shadow-lg border border-gray-100 dark:border-slate-700
                        hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-emerald-100 dark:bg-emerald-900/40 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-gray-900 dark:text-white">{{ $profilesCount }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Profiles</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 p-7 rounded-3xl shadow-lg border border-gray-100 dark:border-slate-700
                        hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-sky-100 dark:bg-sky-900/40 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-sky-600 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-gray-900 dark:text-white">{{ $projectsCount }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Projects</p>
                    </div>
                </div>
            </div>

            <a href="{{ route('home') }}" target="_blank"
               class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-7 rounded-3xl shadow-lg
                      hover:shadow-emerald-500/30 hover:-translate-y-0.5 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-bold text-base">Portfolio</p>
                        <p class="text-white/70 text-sm">Lihat publik ↗</p>
                    </div>
                </div>
            </a>

            <div class="bg-white dark:bg-slate-800 p-7 rounded-3xl shadow-lg border border-gray-100 dark:border-slate-700">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/40 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-gray-900 dark:text-white">
                            {{ $profilesCount + $projectsCount }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Total Konten</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="grid lg:grid-cols-2 gap-8 mb-12">

            {{-- Profiles Management --}}
            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-slate-800 dark:to-slate-700
                        p-8 rounded-3xl shadow-xl border border-emerald-100/50 dark:border-slate-600">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-lexend text-2xl font-bold text-emerald-800 dark:text-emerald-200">
                        Profiles
                    </h2>
                    <span class="text-3xl font-black text-emerald-500">{{ $profilesCount }}</span>
                </div>
                <div class="space-y-3">
                    <a href="{{ route('admin.profiles.create') }}"
                       class="flex items-center justify-center gap-2 w-full
                              bg-emerald-500 hover:bg-emerald-600 text-white
                              font-semibold py-3.5 px-6 rounded-2xl
                              transition-all hover:shadow-lg hover:shadow-emerald-500/25 hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Profil Baru
                    </a>
                    <a href="{{ route('admin.profiles.index') }}"
                       class="flex items-center justify-center gap-2 w-full
                              bg-white dark:bg-slate-900 hover:bg-gray-50 dark:hover:bg-slate-800
                              border border-emerald-200 dark:border-emerald-700
                              font-semibold py-3.5 px-6 rounded-2xl
                              text-gray-700 dark:text-gray-300
                              transition-all hover:shadow-md">
                        Lihat Semua Profiles →
                    </a>
                </div>
            </div>

            {{-- Projects Management --}}
            <div class="bg-gradient-to-br from-sky-50 to-blue-100 dark:from-slate-800 dark:to-slate-700
                        p-8 rounded-3xl shadow-xl border border-sky-100/50 dark:border-slate-600">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-lexend text-2xl font-bold text-sky-800 dark:text-sky-200">
                        Projects
                    </h2>
                    <span class="text-3xl font-black text-sky-500">{{ $projectsCount }}</span>
                </div>
                <div class="space-y-3">
                    <a href="{{ route('admin.projects.create') }}"
                       class="flex items-center justify-center gap-2 w-full
                              bg-sky-500 hover:bg-sky-600 text-white
                              font-semibold py-3.5 px-6 rounded-2xl
                              transition-all hover:shadow-lg hover:shadow-sky-500/25 hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Proyek Baru
                    </a>
                    <a href="{{ route('admin.projects.index') }}"
                       class="flex items-center justify-center gap-2 w-full
                              bg-white dark:bg-slate-900 hover:bg-gray-50 dark:hover:bg-slate-800
                              border border-sky-200 dark:border-sky-700
                              font-semibold py-3.5 px-6 rounded-2xl
                              text-gray-700 dark:text-gray-300
                              transition-all hover:shadow-md">
                        Lihat Semua Projects →
                    </a>
                </div>
            </div>

        </div>

        {{-- Tips --}}
        <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-2xl p-6">
            <div class="flex gap-4">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-amber-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-amber-800 dark:text-amber-200 mb-1">Tips Setup Awal</p>
                    <ul class="text-sm text-amber-700 dark:text-amber-300 space-y-1">
                        <li>1. Buat profil Anda di menu <strong>Profiles</strong> terlebih dahulu</li>
                        <li>2. Tambahkan proyek-proyek di menu <strong>Projects</strong></li>
                        <li>3. Jalankan <code class="bg-amber-100 dark:bg-amber-900 px-1 rounded">php artisan storage:link</code> jika belum ada</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection