@extends('layouts.app')

@section('title', ($profile ? $profile->name . ' - ' : '') . 'Portfolio')

@section('content')

{{-- HERO / PROFILE SECTION --}}
<section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden
                           bg-gradient-to-br from-slate-50 via-white to-emerald-50
                           dark:from-slate-950 dark:via-slate-900 dark:to-slate-900 pt-10">

    {{-- Background decorations --}}
    <div class="absolute w-96 h-96 right-10 mb-12 bg-gradient-to-br from-emerald-500 via-sky-500 to-purple-500 
                                rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative container mx-auto px-6 z-10">
        @if ($profile)
            {{-- MODE PROFILE --}}
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">

                    {{-- Avatar --}}
                    <div class="flex-shrink-0">
                        <div class="relative">
                            {{-- Glow effect --}}
                            <div class="absolute inset-0 w-36 h-36 bg-gradient-to-br from-emerald-500 via-sky-500 to-purple-500 
                                rounded-full blur-3xl pointer-events-none"></div>

                            @if ($profile->avatar_url)
                                <img src="{{ $profile->avatar_url }}"
                                     alt="{{ $profile->name }}"
                                     class="relative w-48 h-48 lg:w-64 lg:h-64 rounded-full object-cover
                                            ring-4 ring-white dark:ring-slate-800
                                            shadow-2xl">
                            @else
                                <div class="relative w-48 h-48 lg:w-64 lg:h-64 rounded-full
                                            bg-gradient-to-br from-emerald-400 to-sky-500
                                            flex items-center justify-center
                                            ring-4 ring-white dark:ring-slate-800
                                            shadow-2xl">
                                    <span class="text-white font-lexend font-black text-5xl lg:text-7xl">
                                        {{ $profile->initials }}
                                    </span>
                                </div>
                            @endif

                            {{-- Status badge --}}
                            <div class="absolute bottom-3 right-3 bg-white dark:bg-slate-800 rounded-full px-3 py-1.5 shadow-lg flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">Available</span>
                            </div>
                        </div>
                    </div>

                    {{-- Profile Info --}}
                    <div class="flex-1 text-center lg:text-left">
                        <span class="inline-block px-4 py-2 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 rounded-full text-sm font-semibold mb-6">
                            Hello, I'm
                        </span>

                        <h1 class="font-lexend text-5xl sm:text-6xl lg:text-7xl font-black leading-tight mb-4
                                    text-gray-900 dark:text-white">
                            {{ $profile->name }}
                        </h1>

                        <p class="font-inter text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto lg:mx-0 mb-8 leading-relaxed">
                            {{ $profile->bio }}
                        </p>

                        {{-- Social Links --}}
                        @if (!empty($profile->social_links))
                            <div class="flex flex-wrap gap-3 justify-center lg:justify-start mb-10">
                                @php
                                    $socialIcons = [
                                        'github'    => ['icon' => 'M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z', 'label' => 'GitHub'],
                                        'linkedin'  => ['icon' => 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z', 'label' => 'LinkedIn'],
                                        'twitter'   => ['icon' => 'M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z', 'label' => 'Twitter'],
                                        'instagram' => ['icon' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z', 'label' => 'Instagram'],
                                        'website'   => ['icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z', 'label' => 'Website'],
                                    ];
                                @endphp
                                @foreach ($profile->social_links as $platform => $link)
                                    @if ($link && isset($socialIcons[$platform]))
                                        <a href="{{ $link }}" target="_blank" rel="noopener"
                                           class="group flex items-center gap-2 px-4 py-2.5
                                                  bg-white dark:bg-slate-800
                                                  border border-gray-200 dark:border-slate-700
                                                  rounded-xl shadow-sm
                                                  hover:border-emerald-500 hover:shadow-emerald-500/20
                                                  hover:-translate-y-0.5 transition-all duration-300">
                                            <svg class="w-4 h-4 text-gray-600 dark:text-gray-400 group-hover:text-emerald-500 transition-colors"
                                                 viewBox="0 0 24 24" fill="currentColor">
                                                <path d="{{ $socialIcons[$platform]['icon'] }}"/>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">
                                                {{ $socialIcons[$platform]['label'] }}
                                            </span>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="#projects"
                               class="inline-block px-10 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600
                                      hover:from-emerald-600 hover:to-emerald-700
                                      text-white font-semibold text-lg rounded-2xl
                                      shadow-xl shadow-emerald-500/25 hover:shadow-emerald-500/40
                                      transition-all duration-300 hover:-translate-y-1">
                                Lihat Projects
                            </a>
                            <a href="#contact"
                               class="inline-block px-10 py-4 border-2 border-emerald-500 text-emerald-600 dark:text-emerald-400
                                      font-semibold text-lg rounded-2xl hover:bg-emerald-500 hover:text-white
                                      transition-all duration-300 hover:-translate-y-1">
                                Hubungi Saya
                            </a>                             
                        </div>
                    </div>
                </div>
            </div>

        @else
            {{--  MODE DEFAULT (Belum ada profil) --}}
            <div class="text-center max-w-4xl mx-auto">
                <span class="inline-block px-4 py-2 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 rounded-full text-sm font-semibold mb-8">
                    Available for work
                </span>

                <h1 class="font-lexend text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black leading-tight mb-8
                            bg-gradient-to-r from-emerald-500 via-sky-500 to-emerald-600
                            bg-clip-text text-transparent">
                    Junior MLOps<br>& Data Engineer
                </h1>

                <p class="font-inter text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-12 leading-relaxed">
                    Mengintegrasikan Artificial Intelligence (AI) ke dalam solusi perangkat lunak fungsional.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#projects"
                       class="inline-block px-10 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600
                              hover:from-emerald-600 hover:to-emerald-700
                              text-white font-semibold text-lg rounded-2xl
                              shadow-xl shadow-emerald-500/25 hover:shadow-emerald-500/40
                              transition-all duration-300 hover:-translate-y-1">
                        Lihat Projects
                    </a>
                    <a href="#contact"
                       class="inline-block px-10 py-4 border-2 border-emerald-500 text-emerald-600 dark:text-emerald-400
                              font-semibold text-lg rounded-2xl hover:bg-emerald-500 hover:text-white
                              transition-all duration-300 hover:-translate-y-1">
                        Hubungi Saya
                    </a>
                </div>

                @auth
                    <p class="mt-8 text-gray-400 text-sm">
                        💡 <a href="{{ route('admin.profiles.create') }}" class="text-emerald-500 hover:underline">Buat profil</a> untuk menampilkan data Anda di sini.
                    </p>
                @endauth
            </div>
        @endif
    </div>
</section>


{{-- IDENTITY / ABOUT --}}
@php
    $aboutData   = $profile ? $profile->resolvedAboutData()   : \App\Models\Profile::defaultAboutData();
    $roadmapData = $profile ? $profile->resolvedRoadmapItems() : collect(\App\Models\Profile::defaultRoadmapItems())
        ->map(fn($item, $i) => array_merge($item, [
            'num'   => str_pad($i + 1, 2, '0', STR_PAD_LEFT),
            'color' => ['emerald','sky','purple','gradient'][$i],
            'is_active' => $i === 3,
        ]))->all();
@endphp

<section id="identity" class="py-24 bg-white dark:bg-slate-900 overflow-hidden">
    <div class="container mx-auto px-6">        
        {{-- Section Title --}}
        <div class="text-center mb-8">
            <h2 class="font-lexend text-4xl lg:text-5xl font-bold mb-2
                    bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300
                    bg-clip-text text-transparent leading-relaxed pb-4">
                About Me
            </h2>
            <div class="w-20 h-1.5 bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300 mx-auto rounded-full"></div>
        </div>

        {{-- Detailed Bio --}}
        @if ($profile && $profile->detailed_bio)
            <div class="max-w-4xl mx-auto mb-20 relative">
                <span class="absolute -top-10 -left-8 text-8xl text-gray-100 dark:text-slate-800 font-serif -z-10 select-none">"</span>
                <div class="relative">
                    <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 leading-relaxed font-medium italic text-center md:text-left">
                        {{ $profile->detailed_bio }}
                    </p>
                    <div class="mt-8 flex justify-center md:justify-start">
                        <div class="w-1/2 md:w-1/3 h-px bg-gradient-to-r from-emerald-500 to-transparent"></div>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">

            {{-- Experience --}}
            <div class="group bg-gradient-to-br from-emerald-50 to-emerald-100
                        dark:from-slate-800 dark:to-slate-700
                        p-8 rounded-3xl hover:scale-[1.02] transition-all duration-500
                        shadow-lg hover:shadow-emerald-500/20 border border-emerald-100/50 dark:border-slate-600">
                <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="font-lexend text-xl font-bold mb-4 text-emerald-700 dark:text-emerald-300">Experience</h3>
                <ul class="space-y-3 text-gray-700 dark:text-gray-300">
                    @foreach ($aboutData['experience'] as $exp)
                        <li class="flex items-start gap-3">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span class="text-sm leading-relaxed">
                                {{ $exp['title'] }}{{ !empty($exp['period']) ? ' (' . $exp['period'] . ')' : '' }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Education & Skills --}}
            <div class="md:col-span-2 group bg-gradient-to-br from-sky-50 to-blue-100
                        dark:from-slate-800 dark:to-slate-700
                        p-8 rounded-3xl hover:scale-[1.02] transition-all duration-500
                        shadow-lg hover:shadow-emerald-500/20 border border-emerald-100/50 dark:border-slate-600">
                <div class="w-12 h-12 bg-sky-500 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    </svg>
                </div>
                <h3 class="font-lexend text-xl font-bold mb-4 text-sky-700 dark:text-sky-300">Education & Skills</h3>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <p class="font-semibold text-gray-800 dark:text-gray-200 mb-1">
                            {{ $aboutData['education']['degree'] }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $aboutData['education']['institution'] }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Tech Stack utama:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($aboutData['skills'] as $skill)
                                <span class="skill-hover px-3 py-1 bg-white/70 dark:bg-slate-600 rounded-lg text-xs font-medium
                                             cursor-pointer transition-all duration-200 hover:bg-emerald-500 hover:text-white">
                                    {{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Interests --}}
            <div class="group bg-gradient-to-br from-purple-50 to-pink-100
                        dark:from-slate-800 dark:to-slate-700
                        p-8 rounded-3xl hover:scale-[1.02] transition-all duration-500
                        shadow-lg hover:shadow-emerald-500/20 border border-emerald-100/50 dark:border-slate-600">
                <div class="w-12 h-12 bg-purple-500 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="font-lexend text-xl font-bold mb-4 text-purple-700 dark:text-purple-300">Interests</h3>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($aboutData['interests'] as $interest)
                        <span class="px-3 py-2 bg-white/60 dark:bg-slate-600/60 backdrop-blur-sm rounded-xl text-xs text-center font-medium text-gray-700 dark:text-gray-300">
                            {{ $interest }}
                        </span>
                    @endforeach
                </div>
            </div>

            {{-- Stats --}}
            <div class="md:col-span-2 relative overflow-hidden bg-gradient-to-r from-emerald-500 to-sky-500
                        p-10 rounded-3xl hover:scale-[1.02] transition-all duration-500 shadow-lg hover:shadow-sky-500/20 
                        border border-emerald-100/50 dark:border-slate-600">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 h-full items-center relative z-10">
                    @foreach ($aboutData['stats'] as $stat)
                        <div class="text-center text-white p-4 rounded-2xl transition-transform duration-300 hover:scale-105">
                            <p class="font-lexend text-5xl font-black leading-none mb-1 tracking-tighter drop-shadow-md">
                                {{ $stat['number'] }}
                            </p>
                            <p class="text-sm font-semibold opacity-90 tracking-wide">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>


{{-- PROJECTS SECTION --}}
<section id="projects" class="py-24 bg-gray-50 dark:bg-slate-950">
    <div class="container mx-auto px-6">

        <div class="text-center mb-16">
            <h2 class="font-lexend text-4xl lg:text-5xl font-bold mb-2
                        bg-gradient-to-r from-emerald-500 to-emerald-600 bg-clip-text text-transparent leading-relaxed pb-4">
                Projects
            </h2>
            <div class="w-20 h-1.5 bg-emerald-500 mx-auto rounded-full mb-8"></div>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Proyek terbaik yang pernah saya kerjakan.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @forelse ($projects as $project)
                <div class="group bg-white dark:bg-slate-800 rounded-3xl overflow-hidden
                             shadow-lg hover:shadow-2xl hover:-translate-y-2
                             transition-all duration-500 hover:shadow-sky-500/20 cursor-pointer
                             border border-gray-100 dark:border-slate-700 custom-cursor-project"
                     onclick="window.location='{{ route('projects.show', $project) }}'">

                    <div class="h-48 bg-gradient-to-br from-emerald-400 to-sky-500 relative overflow-hidden">
                        @if ($project->image_path)
                            <img src="{{ Storage::url($project->image_path) }}"
                                 alt="{{ $project->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3 bg-black/30 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $project->date->format('Y') }}
                        </div>
                    </div>

                    <div class="p-7">
                        <h3 class="font-lexend text-xl font-bold mb-3 group-hover:text-emerald-500 transition-colors line-clamp-1">
                            {{ $project->title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-5 line-clamp-3 text-sm leading-relaxed">
                            {{ $project->description }}
                        </p>
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            @foreach (array_slice($project->tech_stack, 0, 4) as $tech)
                                <span class="px-2.5 py-1 bg-emerald-100 dark:bg-emerald-900/40
                                             text-emerald-700 dark:text-emerald-300 rounded-full text-xs font-medium">
                                    {{ $tech }}
                                </span>
                            @endforeach
                            @if (count($project->tech_stack) > 4)
                                <span class="px-2.5 py-1 text-gray-400 text-xs font-medium">
                                    +{{ count($project->tech_stack) - 4 }} lagi
                                </span>
                            @endif
                        </div>
                        <div class="flex gap-4 pt-3 border-t border-gray-100 dark:border-slate-700">
                            @if ($project->live_link)
                                <a href="{{ $project->live_link }}" target="_blank" onclick="event.stopPropagation()"
                                   class="group inline-flex items-center gap-1.5 text-sm text-emerald-500 hover:text-emerald-600 font-semibold transition-transform hover:translate-x-0.5 hover:-translate-y-0.5"><span>Live</span>
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.248 19C3.22 15.77 5.275 8.232 12.466 8.232V6.079a1.025 1.025 0 0 1 1.644-.862l5.479 4.307a1.108 1.108 0 0 1 0 1.723l-5.48 4.307a1.026 1.026 0 0 1-1.643-.861v-2.154C5.275 13.616 4.248 19 4.248 19Z"/>
                                    </svg>
                                </a>
                            @endif
                            @if ($project->github_link)
                                <a href="{{ $project->github_link }}" target="_blank" onclick="event.stopPropagation()"
                                   class="group inline-flex items-center gap-1.5 text-sm text-emerald-500 hover:text-emerald-600 font-semibold transition-transform hover:translate-x-0.5 hover:-translate-y-0.5">
                                    <span>GitHub</span>
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.248 19C3.22 15.77 5.275 8.232 12.466 8.232V6.079a1.025 1.025 0 0 1 1.644-.862l5.479 4.307a1.108 1.108 0 0 1 0 1.723l-5.48 4.307a1.026 1.026 0 0 1-1.643-.861v-2.154C5.275 13.616 4.248 19 4.248 19Z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-24">
                    <p class="text-xl text-gray-500 dark:text-gray-400">
                        Belum ada proyek.
                        @auth
                            <a href="{{ route('admin.projects.create') }}" class="text-emerald-500 hover:underline ml-1 font-semibold">Tambah sekarang?</a>
                        @endauth
                    </p>
                </div>
            @endforelse
        </div>

        @if ($projects->count() > 0)
            <div class="text-center mt-14">
                <a href="{{ route('projects.index') }}"
                class="group inline-flex items-center justify-center gap-3 px-10 py-4 bg-white dark:bg-slate-800 border-2 border-emerald-500
                        text-emerald-600 dark:text-emerald-400 font-semibold rounded-2xl
                        hover:bg-emerald-500 hover:text-white transition-all duration-300 shadow-lg shadow-emerald-500/10">
                    <span>Lihat Semua Proyek</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>


{{-- LEARNING JOURNEY --}}
<section id="ml-roadmap" class="py-24 bg-white dark:bg-slate-900">
    <div class="container mx-auto px-6">

        <div class="text-center mb-16">
            <h2 class="font-lexend text-4xl lg:text-5xl font-bold mb-2
                        bg-gradient-to-r from-purple-500 to-emerald-500 bg-clip-text text-transparent leading-relaxed pb-4">
                Learning Journey
            </h2>
            <div class="w-20 h-1.5 bg-gradient-to-r from-purple-500 to-emerald-500 mx-auto rounded-full mb-8"></div>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-xl mx-auto">
                Perjalanan belajar saya dari dasar hingga production-ready.
            </p>
        </div>

        <div class="max-w-3xl mx-auto relative">
            {{-- Vertical line --}}
            <div class="absolute left-6 md:left-1/2 md:-ml-px top-0 bottom-0 w-0.5
                        bg-gradient-to-b from-emerald-400 via-sky-400 to-purple-500"></div>

            <div class="space-y-12">
                @foreach ($roadmapData as $i => $m)
                    <div class="relative flex {{ $i % 2 === 0 ? '' : 'flex-row-reverse' }} items-start gap-8 md:gap-12">
                        {{-- Node --}}
                        <div class="flex-shrink-0 relative z-10">
                            @if ($m['color'] === 'gradient')
                                <div class="relative flex items-center justify-center">
                                    <span class="absolute inline-flex h-14 w-14 rounded-2xl bg-emerald-400 opacity-40 animate-ping"></span>
                                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white shadow-2xl 
                                                bg-gradient-to-br from-emerald-500 via-sky-500 to-purple-500 relative z-10 animate-pulse">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 relative z-10 animate-pulse">
                                            <defs>
                                                <linearGradient id="sparkleGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" stop-color="#a7f3d0" /> <stop offset="100%" stop-color="#f3e8ff" /> </linearGradient>
                                            </defs>
                                            <path fill="url(#sparkleGradient)" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.456-2.454L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.454zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                                        </svg>
                                    </div>
                                </div>
                            @else
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white font-black text-base
                                            shadow-xl bg-{{ $m['color'] }}-500">
                                    {{ $m['num'] }}
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="flex-1 bg-gray-50 dark:bg-slate-800 rounded-2xl p-6 shadow-lg
                                    border border-gray-100 dark:border-slate-700">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="font-lexend text-xl font-bold
                                           @if($m['color']==='gradient') bg-gradient-to-r from-emerald-500 to-purple-500 bg-clip-text text-transparent
                                           @else text-{{ $m['color'] }}-600 dark:text-{{ $m['color'] }}-400 @endif">
                                    {{ $m['title'] }}
                                </h3>
                                <span class="text-xs font-bold text-gray-400 bg-gray-200 dark:bg-slate-700 px-2 py-1 rounded-full ml-3 whitespace-nowrap">
                                    {{ $m['year'] }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                {{ $m['desc'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- CONTACT SECTION --}}
<section id="contact" class="py-24 bg-gray-50 dark:bg-slate-950">
    <div class="container mx-auto px-6 max-w-2xl">
        <div class="text-center mb-16">
            <h2 class="font-lexend text-4xl lg:text-5xl font-bold mb-2
                        bg-gradient-to-r from-emerald-500 to-emerald-600 bg-clip-text text-transparent leading-relaxed pb-4">
                Let's Talk
            </h2>
            <div class="w-20 h-1.5 bg-emerald-500 mx-auto rounded-full mb-8"></div>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Punya proyek menarik? Mari berkolaborasi dan wujudkan idemu!
            </p>
        </div>

        <div class="bg-white dark:bg-slate-800 p-10 md:p-12 rounded-3xl shadow-2xl border border-gray-100 dark:border-slate-700">
            @if (session('success'))
                <div class="mb-8 p-5 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 rounded-2xl">
                    <p class="text-emerald-700 dark:text-emerald-300 font-medium">✅ {{ session('success') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Nama Lengkap *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-5 py-4 rounded-2xl bg-gray-50 dark:bg-slate-700
                                  border-2 border-gray-200 dark:border-slate-600
                                  focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20
                                  outline-none transition-all duration-300 text-base
                                  @error('name') border-rose-500 @enderror"
                           placeholder="Nama Anda">
                    @error('name') <p class="text-rose-500 text-sm mt-1.5">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-5 py-4 rounded-2xl bg-gray-50 dark:bg-slate-700
                                  border-2 border-gray-200 dark:border-slate-600
                                  focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20
                                  outline-none transition-all duration-300 text-base
                                  @error('email') border-rose-500 @enderror"
                           placeholder="email@contoh.com">
                    @error('email') <p class="text-rose-500 text-sm mt-1.5">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Pesan *</label>
                    <textarea name="message" rows="6" required
                              class="w-full px-5 py-4 rounded-2xl bg-gray-50 dark:bg-slate-700
                                     border-2 border-gray-200 dark:border-slate-600
                                     focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20
                                     outline-none transition-all duration-300 text-base resize-vertical
                                     @error('message') border-rose-500 @enderror"
                              placeholder="Ceritakan tentang proyek atau ide Anda...">{{ old('message') }}</textarea>
                    @error('message') <p class="text-rose-500 text-sm mt-1.5">{{ $message }}</p> @enderror
                </div>
                <button type="submit"
                        class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600
                               hover:from-emerald-600 hover:to-emerald-700
                               text-white font-bold py-5 px-8 rounded-2xl text-lg
                               shadow-xl shadow-emerald-500/25 hover:shadow-emerald-500/40
                               transition-all duration-300 hover:-translate-y-1">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</section>

@endsection