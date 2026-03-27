@extends('layouts.app')

@section('title', 'Projects - Portfolio')

@section('content')
<div class="py-20 bg-gray-50 dark:bg-slate-900">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="text-center mb-16">
            <h1 class="font-lexend text-5xl font-bold bg-gradient-to-r from-emerald-500 to-emerald-600 bg-clip-text text-transparent mb-4 leading-relaxed pb-2">
                Semua Projects
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300">Kumpulan proyek yang telah saya kerjakan</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($projects as $project)
                <div class="group bg-white dark:bg-slate-800 rounded-3xl overflow-hidden
                             shadow-lg hover:shadow-2xl hover:-translate-y-2
                             transition-all duration-500 hover:shadow-sky-500/20 cursor-pointer
                             border border-gray-100 dark:border-slate-700 custom-cursor-project"
                     onclick="window.location='{{ route('projects.show', $project) }}'">
                    <div class="h-48 bg-gradient-to-br from-emerald-400 to-sky-500 overflow-hidden">
                        @if ($project->image_path)
                            <img src="{{ Storage::url($project->image_path) }}"
                                 alt="{{ $project->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-7">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="font-lexend text-xl font-bold group-hover:text-emerald-500 transition-colors line-clamp-1">
                                {{ $project->title }}
                            </h3>
                            <span class="text-xs font-semibold text-emerald-500 ml-2 whitespace-nowrap">
                                {{ $project->date->format('Y') }}
                            </span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 mb-5 line-clamp-3 text-sm leading-relaxed">
                            {{ $project->description }}
                        </p>
                        <div class="flex flex-wrap gap-2 mb-5">
                            @foreach (array_slice($project->tech_stack, 0, 4) as $tech)
                                <span class="px-2 py-1 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 rounded-lg text-xs font-medium">
                                    {{ $tech }}
                                </span>
                            @endforeach
                            @if (count($project->tech_stack) > 4)
                                <span class="px-2 py-1 text-gray-400 text-xs">+{{ count($project->tech_stack) - 4 }}</span>
                            @endif
                        </div>
                        <div class="flex gap-4 pt-3 border-t border-gray-100 dark:border-slate-700">
                            @if ($project->live_link)
                                <a href="{{ $project->live_link }}" target="_blank"
                                   onclick="event.stopPropagation()"
                                   class="text-sm text-emerald-500 hover:text-emerald-600 font-semibold">
                                    Live ↗
                                </a>
                            @endif
                            @if ($project->github_link)
                                <a href="{{ $project->github_link }}" target="_blank"
                                   onclick="event.stopPropagation()"
                                   class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 font-semibold">
                                    GitHub ↗
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 text-gray-500 dark:text-gray-400">
                    Belum ada proyek.
                    @auth
                        <a href="{{ route('admin.projects.create') }}" class="text-emerald-500 hover:underline ml-1">Tambah sekarang?</a>
                    @endauth
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-12">
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection