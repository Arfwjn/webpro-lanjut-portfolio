@extends('layouts.app')

@section('title', 'Manage Projects - Admin')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-6 max-w-7xl">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="font-lexend text-4xl font-bold mb-1">Projects</h1>
                <p class="text-gray-500 dark:text-gray-400">Kelola semua proyek portfolio</p>
            </div>
            {{-- Tombol tambah proyek --}}
            <a href="{{ route('admin.projects.create') }}"
               class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-8 rounded-2xl transition-all shadow-lg hover:shadow-emerald-500/25">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Proyek
            </a>
        </div>

        @if ($projects->count())
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-slate-900/50">
                            <tr>
                                <th class="px-8 py-5 text-left text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Judul</th>
                                <th class="px-8 py-5 text-left text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Tech Stack</th>
                                <th class="px-8 py-5 text-left text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                <th class="px-8 py-5 text-right text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach ($projects as $project)
                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            @if ($project->image_path)
                                                <img src="{{ Storage::url($project->image_path) }}"
                                                     alt="{{ $project->title }}"
                                                     class="w-12 h-12 rounded-xl object-cover flex-shrink-0">
                                            @else
                                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-sky-400 flex-shrink-0"></div>
                                            @endif
                                            <div>
                                                <p class="font-semibold text-gray-900 dark:text-white">{{ $project->title }}</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-1 max-w-xs">{{ $project->description }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach (array_slice($project->tech_stack, 0, 3) as $tech)
                                                <span class="px-2 py-1 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 rounded-lg text-xs font-medium">
                                                    {{ $tech }}
                                                </span>
                                            @endforeach
                                            @if (count($project->tech_stack) > 3)
                                                <span class="px-2 py-1 text-gray-400 text-xs">+{{ count($project->tech_stack) - 3 }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-gray-600 dark:text-gray-400 text-sm">
                                        {{ $project->date->format('d M Y') }}
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center justify-end gap-2">
                                            @if ($project->live_link)
                                                <a href="{{ $project->live_link }}" target="_blank"
                                                   class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg text-sm transition-colors">
                                                    Live ↗
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.projects.edit', $project) }}"
                                               class="px-4 py-1.5 bg-sky-500 hover:bg-sky-600 text-white rounded-lg text-sm font-medium transition-all">
                                                Edit
                                            </a>
                                            <form method="POST"
                                                  action="{{ route('admin.projects.destroy', $project) }}"
                                                  onsubmit="return confirm('Yakin hapus proyek ini?')">
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
            </div>

            <div class="mt-8">{{ $projects->links() }}</div>
        @else
            <div class="text-center py-24 bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700">
                <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-2">Belum ada proyek</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-8">Mulai tambahkan proyek pertama Anda</p>
                <a href="{{ route('admin.projects.create') }}"
                   class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-10 rounded-2xl transition-all shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Proyek Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection