@extends('layouts.app')

@section('title', 'Profiles - Portfolio')

@section('content')
<div class="py-20">
    <div class="container mx-auto px-6 max-w-6xl">
        <h1 class="font-lexend text-5xl font-bold text-center mb-16 bg-gradient-to-r from-emerald-500 to-emerald-600 bg-clip-text text-transparent">
            Profiles
        </h1>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($profiles as $profile)
                <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-8 border border-gray-100 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <h2 class="font-lexend text-2xl font-bold mb-3">{{ $profile->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 line-clamp-3 leading-relaxed">{{ $profile->bio }}</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($profile->social_links ?? [] as $platform => $link)
                            <a href="{{ $link }}" target="_blank" class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 rounded-full text-sm font-medium hover:bg-emerald-200 transition-colors">
                                {{ ucfirst($platform) }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 text-gray-500">Belum ada profil.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection