@extends('layouts.app')

@section('title', $project->title . ' - Portfolio')

@section('content')
<div class="py-20">
    <div class="container mx-auto px-6 max-w-4xl">
        <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-emerald-500 hover:text-emerald-600 font-medium mb-10">
            ← Semua Projects
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
            <div class="flex items-start justify-between mb-6">
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

            <div class="flex flex-wrap gap-4">
                @if ($project->live_link)
                    <a href="{{ $project->live_link }}" target="_blank"
                       class="px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-2xl font-semibold transition-all shadow-lg hover:shadow-emerald-500/30">
                        Lihat Live ↗
                    </a>
                @endif
                @if ($project->github_link)
                    <a href="{{ $project->github_link }}" target="_blank"
                       class="px-8 py-3 bg-gray-800 hover:bg-gray-900 text-white rounded-2xl font-semibold transition-all">
                        GitHub ↗
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection