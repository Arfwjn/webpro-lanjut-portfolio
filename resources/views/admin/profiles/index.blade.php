@extends('layouts.app')

@section('title', 'Manage Profiles')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold font-lexend">Profiles</h1>
            <a href="{{ route('admin.profiles.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-8 rounded-2xl transition-all shadow-lg hover:shadow-emerald/25">
                + Tambah Profil
            </a>
        </div>

        @if($profiles->count())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-midnight-900 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-800">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-800">
                            <th class="px-8 py-6 text-left text-lg font-bold text-gray-900 dark:text-white">Nama</th>
                            <th class="px-8 py-6 text-left text-lg font-bold text-gray-900 dark:text-white">Bio Singkat</th>
                            <th class="px-8 py-6 text-left text-lg font-bold text-gray-900 dark:text-white">Social Links</th>
                            <th class="px-8 py-6 text-right text-lg font-bold text-gray-900 dark:text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($profiles as $profile)
                        <tr class="hover:bg-gray-50 dark:hover:bg-midnight-800 transition-colors border-b border-gray-200 dark:border-gray-800 last:border-b-0">
                            <td class="px-8 py-6 font-semibold text-xl">{{ $profile->name }}</td>
                            <td class="px-8 py-6 text-lg line-clamp-2 max-w-md">{{ $profile->bio }}</td>
                            <td class="px-8 py-6">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($profile->social_links ?? [] as $platform => $link)
                                        <a href="{{ $link }}" target="_blank" class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 rounded-lg text-sm font-medium hover:bg-emerald-200 dark:hover:bg-emerald-800 transition-colors">
                                            {{ ucfirst($platform) }}
                                        </a>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.profiles.edit', $profile) }}" class="px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-xl font-medium transition-all text-sm">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.profiles.destroy', $profile) }}" class="inline" onsubmit="return confirm('Yakin hapus profil ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl font-medium transition-all text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-20">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Belum ada profil</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-8">Mulai dengan menambahkan profil pertama Anda.</p>
                <a href="{{ route('admin.profiles.create') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-8 rounded-2xl transition-all shadow-lg">
                    Tambah Profil Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
