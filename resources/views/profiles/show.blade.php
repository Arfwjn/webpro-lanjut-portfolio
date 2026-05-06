@extends('layouts.app')

@section('title', $profile->name . ' - Portfolio')

@section('content')
<div class="py-20">
    <div class="container mx-auto px-6 max-w-4xl">
        <a href="{{ route('profiles.index') }}"
        class="group inline-flex items-center gap-2 text-indigo-500 hover:text-indigo-600 font-medium transition-colors">
            
            {{-- Ikon Panah Kembali --}}
            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" 
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
            </svg>

            <span>Semua Profile</span>
        </a>

        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl p-10 border border-gray-100 dark:border-gray-700">
            <h1 class="font-lexend text-4xl font-bold mb-4">{{ $profile->name }}</h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">{{ $profile->bio }}</p>

            @if ($profile->detailed_bio)
                <div class="prose dark:prose-invert max-w-none mb-8 text-gray-700 dark:text-gray-200 leading-relaxed">
                    {!! nl2br(e($profile->detailed_bio)) !!}
                </div>
            @endif

            @if (!empty($profile->social_links))
                <div class="flex flex-wrap gap-3">
                    @foreach ($profile->social_links as $platform => $link)
                        @if ($link)
                            <a href="{{ $link }}" target="_blank"
                               class="px-5 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full font-medium transition-all">
                                {{ ucfirst($platform) }} ↗
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection