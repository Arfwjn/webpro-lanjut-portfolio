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

            {{-- Profiles Card --}}
            <a href="{{ route('admin.profiles.index') }}">
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
            </a>

            {{-- Projects Card --}}
            <a href="{{ route('admin.projects.index') }}">
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
            </a>        

            {{-- Messages Card --}}
            <a href="{{ route('admin.messages.index') }}"
               class="relative bg-white dark:bg-slate-800 p-7 rounded-3xl shadow-lg border border-gray-100 dark:border-slate-700
                       hover:shadow-xl hover:border-indigo-300 dark:hover:border-indigo-700
                       hover:-translate-y-0.5 transition-all duration-300">
                @if ($unreadCount > 0)
                    <span class="absolute top-4 right-4 bg-rose-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                        {{ $unreadCount }} baru
                    </span>
                @endif
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-indigo-100 dark:bg-indigo-900/40 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-gray-900 dark:text-white">{{ $messagesCount }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Pesan Masuk</p>
                    </div>
                </div>
            </a>

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
        </div>

        {{-- PROFILE SWITCHER --}}
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-gray-100 dark:border-slate-700 overflow-hidden mb-10">

            {{-- Header --}}
            <div class="px-8 py-6 border-b border-gray-100 dark:border-slate-700 flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/40 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="py-2">
                        <h2 class="font-lexend text-xl font-bold text-gray-900 dark:text-white">
                            Profil Portfolio Aktif
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Pilih profil yang ditampilkan di halaman utama portfolio
                        </p>
                    </div>
                </div>                
            </div>

            {{-- Profile List --}}
            @if ($profiles->count() > 0)
                <div class="divide-y divide-gray-100 dark:divide-slate-700">
                    @foreach ($profiles as $profile)
                        <div class="flex items-center gap-5 px-8 py-5
                                    {{ $profile->is_active ? 'bg-emerald-50/60 dark:bg-emerald-900/10' : 'hover:bg-gray-50 dark:hover:bg-slate-700/40' }}
                                    transition-colors">

                            {{-- Avatar --}}
                            <div class="flex-shrink-0 relative">
                                @if ($profile->avatar_url)
                                    <img src="{{ $profile->avatar_url }}"
                                         alt="{{ $profile->name }}"
                                         class="w-12 h-12 rounded-full object-cover ring-2 {{ $profile->is_active ? 'ring-emerald-500' : 'ring-gray-200 dark:ring-slate-600' }}">
                                @else
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center font-black text-lg text-white
                                                {{ $profile->is_active ? 'bg-gradient-to-br from-emerald-400 to-emerald-600 ring-2 ring-emerald-500' : 'bg-gradient-to-br from-gray-400 to-gray-500' }}">
                                        {{ $profile->initials }}
                                    </div>
                                @endif
                                {{-- Active indicator dot --}}
                                @if ($profile->is_active)
                                    <span class="absolute -bottom-0.5 -right-0.5 w-4 h-4 bg-emerald-500 border-2 border-white dark:border-slate-800 rounded-full flex items-center justify-center">
                                        <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </span>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $profile->name }}</span>
                                    @if ($profile->is_active)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 rounded-full text-xs font-bold">
                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                            Aktif
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-1">{{ $profile->bio }}</p>
                            </div>

                            {{-- Actions --}}
                            <div class="flex-shrink-0 flex items-center gap-2">
                                @if (!$profile->is_active)
                                    <form method="POST" action="{{ route('admin.profiles.set-active', $profile) }}">
                                        @csrf
                                        <button type="submit"
                                                class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-sm font-semibold transition-all hover:scale-105 whitespace-nowrap">
                                            Tampilkan
                                        </button>
                                    </form>
                                @else
                                    <span class="px-4 py-2 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 rounded-xl text-sm font-semibold whitespace-nowrap cursor-default">
                                        ✓ Ditampilkan
                                    </span>
                                @endif
                                <a href="{{ route('admin.profiles.edit', $profile) }}"
                                   class="px-3 py-2 bg-gray-100 dark:bg-slate-700 hover:bg-gray-200 dark:hover:bg-slate-600 text-gray-600 dark:text-gray-300 rounded-xl text-sm font-medium transition-all">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-16 text-center">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 mb-4">Belum ada profil</p>
                    <a href="{{ route('admin.profiles.create') }}"
                       class="inline-block px-6 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl transition-all text-sm">
                        Buat Profil Pertama
                    </a>
                </div>
            @endif
        </div>

        {{-- Quick Actions --}}
        <div class="grid lg:grid-cols-2 gap-8 mb-12">
            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-slate-800 dark:to-slate-700
                        p-8 rounded-3xl shadow-xl border border-emerald-100/50 dark:border-slate-600">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-lexend text-2xl font-bold text-emerald-800 dark:text-emerald-200">Profiles</h2>
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
                              font-semibold py-3.5 px-6 rounded-2xl text-gray-700 dark:text-gray-300
                              transition-all hover:shadow-md">
                        Lihat Semua Profiles →
                    </a>
                </div>
            </div>

            <div class="bg-gradient-to-br from-sky-50 to-blue-100 dark:from-slate-800 dark:to-slate-700
                        p-8 rounded-3xl shadow-xl border border-sky-100/50 dark:border-slate-600">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-lexend text-2xl font-bold text-sky-800 dark:text-sky-200">Projects</h2>
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
                              font-semibold py-3.5 px-6 rounded-2xl text-gray-700 dark:text-gray-300
                              transition-all hover:shadow-md">
                        Lihat Semua Projects →
                    </a>
                </div>
            </div>
        </div>

        {{-- PESAN MASUK --}}
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-gray-100 dark:border-slate-700 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 dark:border-slate-700 flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/40 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="py-2">
                        <h2 class="font-lexend text-xl font-bold text-gray-900 dark:text-white">Pesan Masuk</h2>
                        @if ($unreadCount > 0)
                            <p class="text-sm text-indigo-600 dark:text-indigo-400 font-medium">{{ $unreadCount }} pesan belum dibaca</p>
                        @else
                            <p class="text-sm text-gray-500 dark:text-gray-400">Semua pesan sudah dibaca</p>
                        @endif
                    </div>
                </div>
                <a href="{{ route('admin.messages.index') }}"
                   class="px-5 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-xl transition-all text-sm">
                    Lihat Semua →
                </a>
            </div>

            @if ($latestMessages->count() > 0)
                <div class="divide-y divide-gray-100 dark:divide-slate-700">
                    @foreach ($latestMessages as $msg)
                        <a href="{{ route('admin.messages.show', $msg) }}"
                           class="flex items-start gap-4 px-8 py-5 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors group">

                            <div class="z-10 shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 via-sky-500 to-purple-500
                                        transition-all hover:scale-105 whitespace-nowrap flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($msg->name, 0, 1)) }}
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-semibold text-gray-900 dark:text-white text-sm">{{ $msg->name }}</span>
                                    @if (!$msg->is_read)
                                        <span class="w-2 h-2 bg-indigo-500 rounded-full flex-shrink-0"></span>
                                    @endif
                                    <span class="text-xs text-gray-400 ml-auto whitespace-nowrap">
                                        {{ $msg->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">{{ $msg->email }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-1">{{ $msg->message }}</p>
                            </div>

                            <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-500 flex-shrink-0 mt-1 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="py-16 text-center">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400">Belum ada pesan masuk</p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection