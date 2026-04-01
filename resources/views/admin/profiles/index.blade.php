@extends('layouts.app')

@section('title', 'Manage Profiles - Admin')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-6 max-w-7xl">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="font-lexend text-4xl font-bold mb-1">Profiles</h1>
                <p class="text-gray-500 dark:text-gray-400">Kelola semua data profil</p>
            </div>
            {{-- Tombol tambah profil --}}
            <a href="{{ route('admin.profiles.create') }}"
               class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-8 rounded-2xl transition-all shadow-lg hover:shadow-emerald-500/25">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Profil
            </a>
        </div>

        @if ($profiles->count())
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-700">
                <table class="min-w-full">
                    <thead class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-slate-900/50">
                        <tr>
                            <th class="px-8 py-5 text-left text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                            <th class="px-8 py-5 text-left text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Bio</th>
                            <th class="px-8 py-5 text-left text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Social Links</th>
                            <th class="px-8 py-5 text-right text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($profiles as $profile)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-8 py-5 font-semibold text-gray-900 dark:text-white">
                                    {{ $profile->name }}
                                </td>
                                <td class="px-8 py-5 text-gray-600 dark:text-gray-300 max-w-xs">
                                    <p class="line-clamp-2 text-sm">{{ $profile->bio }}</p>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($profile->social_links as $platform => $link)
                                            @if ($link)
                                                <a href="{{ $link }}" target="_blank"
                                                   class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 rounded-full text-xs font-medium hover:bg-emerald-200 transition-colors">
                                                    {{ ucfirst($platform) }}
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.profiles.edit', $profile) }}"
                                           class="px-4 py-1.5 bg-sky-500 hover:bg-sky-600 text-white rounded-lg text-sm font-medium transition-all">
                                            Edit
                                        </a>
                                        <form method="POST"
                                              action="{{ route('admin.profiles.destroy', $profile) }}"
                                              onsubmit="return confirm('Yakin hapus profil ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-4 py-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-lg text-sm font-medium transition-all">
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
            <div class="text-center py-24 bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700">
                <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-2">Belum ada profil</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-8">Mulai tambahkan profil pertama Anda</p>
                <a href="{{ route('admin.profiles.create') }}"
                   class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-10 rounded-2xl transition-all shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Profil Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection