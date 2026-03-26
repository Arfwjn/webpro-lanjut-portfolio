@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-6 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold font-lexend text-gray-900 dark:text-white mb-2">Admin Dashboard</h1>
            <p class="text-xl text-gray-600 dark:text-gray-300">Kelola profil dan proyek portfolio Anda.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white dark:bg-midnight-900 p-8 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-800">
                <div class="flex items-center">
                    <div class="p-3 bg-emerald-100 dark:bg-emerald-900/50 rounded-2xl mr-4">
                        <svg class="w-8 h-8 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $profilesCount ?? 0 }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Profiles</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-midnight-900 p-8 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-800">
                <div class="flex items-center">
                    <div class="p-3 bg-sky-100 dark:bg-sky-900/50 rounded-2xl mr-4">
                        <svg class="w-8 h-8 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 000 2v8a2 2 0 002 2h10a2 2 0 002-2V6a1 1 0 100-2H3zm7 5a1 1 0 100-2 1 1 0 000 2zm-3 0a1 1 0 11-2 0 1 1 0 012 0zm6 0a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $projectsCount ?? 0 }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Projects</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid lg:grid-cols-2 gap-8 mb-12">
            <!-- Profiles Management -->
            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-midnight-800 dark:to-midnight-700 p-8 lg:p-12 rounded-3xl shadow-xl">
                <h2 class="text-2xl font-bold mb-6 text-emerald-800 dark:text-emerald-200 font-lexend">Profiles</h2>
                <div class="space-y-4">
                    <a href="{{ route('admin.profiles.create') }}" class="block w-full bg-emerald-500 hover:bg-emerald-600 text-white font-semibold py-4 px-8 rounded-2xl text-center transition-all hover:shadow-emerald/25 transform hover:-translate-y-1">
                        + Tambah Profil Baru
                    </a>
                    <a href="{{ route('admin.profiles.index') }}" class="block w-full bg-white dark:bg-midnight-900 hover:bg-gray-50 dark:hover:bg-midnight-800 border border-emerald-200 dark:border-emerald-800 font-semibold py-4 px-8 rounded-2xl text-center transition-all hover:shadow-md">
                        Lihat Semua Profiles
                    </a>
                </div>
            </div>

            <!-- Projects Management -->
            <div class="bg-gradient-to-br from-sky-50 to-blue-100 dark:from-midnight-800 dark:to-midnight-700 p-8 lg:p-12 rounded-3xl shadow-xl">
                <h2 class="text-2xl font-bold mb-6 text-sky-800 dark:text-sky-200 font-lexend">Projects</h2>
                <div class="space-y-4">
                    <a href="{{ route('admin.projects.create') }}" class="block w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-4 px-8 rounded-2xl text-center transition-all hover:shadow-sky/25 transform hover:-translate-y-1">
                        + Tambah Proyek Baru
                    </a>
                    <a href="{{ route('admin.projects.index') }}" class="block w-full bg-white dark:bg-midnight-900 hover:bg-gray-50 dark:hover:bg-midnight-800 border border-sky-200 dark:border-sky-800 font-semibold py-4 px-8 rounded-2xl text-center transition-all hover:shadow-md">
                        Lihat Semua Projects
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white dark:bg-midnight-900 rounded-3xl shadow-xl overflow-hidden">
            <div class="p-8 border-b border-gray-200 dark:border-gray-800">
                <h3 class="text-2xl font-bold font-lexend mb-2">Aktivitas Terbaru</h3>
                <p class="text-gray-600 dark:text-gray-400">Riwayat perubahan pada portfolio.</p>
            </div>
            <div class="divide-y divide-gray-200 dark:divide-gray-800">
                <!-- Sample entries -->
                <div class="p-8 hover:bg-gray-50 dark:hover:bg-midnight-800 transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-semibold text-emerald-600">Proyek Baru Ditambahkan</span>
                        <span class="text-sm text-gray-500">2 jam yang lalu</span>
                    </div>
                    <p class="text-gray-600">Project "AI Portfolio Analyzer" berhasil dibuat.</p>
                </div>
                <div class="p-8 hover:bg-gray-50 dark:hover:bg-midnight-800 transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-semibold text-sky-600">Profil Diperbarui</span>
                        <span class="text-sm text-gray-500">1 hari yang lalu</span>
                    </div>
                    <p class="text-gray-600">Bio dan social links profil utama diperbarui.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
