@extends('layouts.app')

@section('title', $project->title . ' - Portfolio')

@section('content')
<div class="py-20">
    <div class="container mx-auto px-6 max-w-4xl">
        <a href="{{ route('projects.index') }}"
            class="py-4 group inline-flex items-center gap-2 text-slate-500 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
            </svg>
            <span class="text-sm">Semua Proyek</span>
        </a>

        @if ($project->image_path)
            <div class="rounded-3xl overflow-hidden mb-10 shadow-2xl">
                <img src="{{ Storage::url($project->image_path) }}"
                     alt="{{ $project->title }}"
                     class="w-full max-h-96 object-cover">
            </div>
        @else
            <div class="h-48 rounded-3xl mb-10 bg-gradient-to-br from-emerald-400 to-sky-500 shadow-2xl"></div>
        @endif

        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700">
            <div class="flex items-start justify-between mb-6 flex-wrap gap-4">
                <h1 class="font-lexend text-4xl font-bold">{{ $project->title }}</h1>
                <span class="text-sm font-semibold text-emerald-500 bg-emerald-100 dark:bg-emerald-900/40 px-3 py-1 rounded-full">
                    {{ $project->date->format('M Y') }}
                </span>
            </div>

            <p class="text-gray-600 dark:text-gray-300 mb-8 text-lg leading-relaxed">
                {{ $project->description }}
            </p>

            <div class="mb-8">
                <h3 class="font-semibold text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Tech Stack</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($project->tech_stack as $tech)
                        <span class="px-4 py-2 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 rounded-full font-medium">
                            {{ $tech }}
                        </span>
                    @endforeach
                </div>
            </div>

            @if ($project->live_link || $project->github_link)
                <div class="flex flex-wrap gap-4">

                    {{-- FIX: Sebelumnya salah mengarah ke $project->github_link --}}
                    @if ($project->live_link)
                        <a href="{{ $project->live_link }}" target="_blank" rel="noopener"
                           class="px-8 py-3 inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-2xl font-semibold transition-all hover:-translate-y-0.5">
                            <span>Lihat Live</span>
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.248 19C3.22 15.77 5.275 8.232 12.466 8.232V6.079a1.025 1.025 0 0 1 1.644-.862l5.479 4.307a1.108 1.108 0 0 1 0 1.723l-5.48 4.307a1.026 1.026 0 0 1-1.643-.861v-2.154C5.275 13.616 4.248 19 4.248 19Z"/>
                            </svg>
                        </a>
                    @endif

                    @if ($project->github_link)
                        <a href="{{ $project->github_link }}" target="_blank" rel="noopener"
                           class="px-8 py-3 inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-900 text-white rounded-2xl font-semibold transition-all hover:-translate-y-0.5">
                            <span>GitHub</span>
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.248 19C3.22 15.77 5.275 8.232 12.466 8.232V6.079a1.025 1.025 0 0 1 1.644-.862l5.479 4.307a1.108 1.108 0 0 1 0 1.723l-5.48 4.307a1.026 1.026 0 0 1-1.643-.861v-2.154C5.275 13.616 4.248 19 4.248 19Z"/>
                            </svg>
                        </a>
                    @endif

                </div>
            @endif
        </div>
    </div>
</div>
@endsection