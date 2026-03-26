@extends('layouts.app')

@section('title', 'Portfolio - Full-Stack Developer')

@section('content')

{{-- ═══════════════════════════════════════════════════════════
     HERO SECTION
════════════════════════════════════════════════════════════════ --}}
<section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden
                           bg-gradient-to-br from-slate-50 via-white to-emerald-50
                           dark:from-slate-950 dark:via-slate-900 dark:to-slate-900 pt-20">

    {{-- Background decorations --}}
    <div class="absolute top-1/4 right-10 w-72 h-72 bg-emerald-400/10 dark:bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 left-10 w-96 h-96 bg-sky-400/10 dark:bg-sky-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative container mx-auto px-6 text-center z-10">
        <div class="max-w-4xl mx-auto">

            <span class="inline-block px-4 py-2 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 rounded-full text-sm font-semibold mb-8">
                👋 Available for work
            </span>

            <h1 class="font-lexend text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black leading-tight mb-8
                        bg-gradient-to-r from-emerald-500 via-sky-500 to-emerald-600
                        bg-clip-text text-transparent">
                Senior Full-Stack<br>
                <span class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl">Engineer</span>
            </h1>

            <p class="font-inter text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-12 leading-relaxed">
                Membangun aplikasi web inovatif dengan Laravel, Tailwind CSS v4,
                dan teknologi modern — dari konsep hingga production.
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

        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
     IDENTITY / ABOUT - Bento Grid
════════════════════════════════════════════════════════════════ --}}
<section id="identity" class="py-32 bg-white dark:bg-slate-900">
    <div class="container mx-auto px-6">

        <div class="text-center mb-16">
            <h2 class="font-lexend text-4xl lg:text-5xl font-bold mb-4
                        bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300
                        bg-clip-text text-transparent">
                Tentang Saya
            </h2>
        </div>

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
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-sm leading-relaxed">Senior Full-Stack Developer (2020 - Sekarang)</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-sm leading-relaxed">Laravel & Vue.js Specialist</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-sm leading-relaxed">4+ tahun pengalaman</span>
                    </li>
                </ul>
            </div>

            {{-- Education (span 2 columns) --}}
            <div class="md:col-span-2 group bg-gradient-to-br from-sky-50 to-blue-100
                        dark:from-slate-800 dark:to-slate-700
                        p-8 rounded-3xl hover:scale-[1.02] transition-all duration-500
                        shadow-lg hover:shadow-sky-500/20 border border-sky-100/50 dark:border-slate-600">
                <div class="w-12 h-12 bg-sky-500 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    </svg>
                </div>
                <h3 class="font-lexend text-xl font-bold mb-4 text-sky-700 dark:text-sky-300">Education & Skills</h3>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <p class="font-semibold text-gray-800 dark:text-gray-200 mb-1">Teknik Informatika</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Universitas Indonesia · Lulus 2020</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Tech Stack utama:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach (['Laravel', 'Vue.js', 'React', 'Tailwind', 'MySQL', 'Docker'] as $skill)
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
                        shadow-lg hover:shadow-purple-500/20 border border-purple-100/50 dark:border-slate-600">
                <div class="w-12 h-12 bg-purple-500 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="font-lexend text-xl font-bold mb-4 text-purple-700 dark:text-purple-300">Interests</h3>
                <div class="grid grid-cols-2 gap-2">
                    @foreach (['Machine Learning', 'Deep Learning', 'DevOps', 'Open Source', 'AI/LLM', 'Cloud'] as $interest)
                        <span class="px-3 py-2 bg-white/60 dark:bg-slate-600/60 backdrop-blur-sm rounded-xl text-xs text-center font-medium
                                     text-gray-700 dark:text-gray-300">
                            {{ $interest }}
                        </span>
                    @endforeach
                </div>
            </div>

            {{-- Stats --}}
            <div class="md:col-span-2 group bg-gradient-to-r from-emerald-500 to-sky-500
                        p-8 rounded-3xl shadow-xl shadow-emerald-500/20">
                <div class="grid grid-cols-3 gap-6 h-full">
                    @foreach ([['4+', 'Tahun Pengalaman'], ['30+', 'Proyek Selesai'], ['10+', 'Klien Puas']] as [$num, $label])
                        <div class="text-center text-white">
                            <p class="font-lexend text-4xl font-black mb-1">{{ $num }}</p>
                            <p class="text-sm font-medium opacity-90">{{ $label }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
     PROJECTS SECTION
════════════════════════════════════════════════════════════════ --}}
<section id="projects" class="py-32 bg-gray-50 dark:bg-slate-950">
    <div class="container mx-auto px-6">

        <div class="text-center mb-16">
            <h2 class="font-lexend text-4xl lg:text-5xl font-bold mb-4
                        bg-gradient-to-r from-emerald-500 to-emerald-600 bg-clip-text text-transparent">
                Projects
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Proyek terbaik yang saya kerjakan menggunakan teknologi modern.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @forelse ($projects as $project)
                <div class="group bg-white dark:bg-slate-800 rounded-3xl overflow-hidden
                             shadow-lg hover:shadow-2xl hover:-translate-y-2
                             transition-all duration-500 cursor-pointer
                             border border-gray-100 dark:border-slate-700 custom-cursor-project"
                     onclick="window.location='{{ route('projects.show', $project) }}'">

                    {{-- Image --}}
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

                    {{-- Content --}}
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
                                <a href="{{ $project->live_link }}" target="_blank"
                                   onclick="event.stopPropagation()"
                                   class="text-sm text-emerald-500 hover:text-emerald-600 font-semibold flex items-center gap-1">
                                    Live ↗
                                </a>
                            @endif
                            @if ($project->github_link)
                                <a href="{{ $project->github_link }}" target="_blank"
                                   onclick="event.stopPropagation()"
                                   class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 font-semibold flex items-center gap-1">
                                    GitHub ↗
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-24">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <p class="text-xl text-gray-500 dark:text-gray-400">
                        Belum ada proyek.
                        @auth
                            <a href="{{ route('admin.projects.create') }}" class="text-emerald-500 hover:underline ml-1 font-semibold">
                                Tambah sekarang?
                            </a>
                        @endauth
                    </p>
                </div>
            @endforelse
        </div>

        @if ($projects->count() > 0)
            <div class="text-center mt-14">
                <a href="{{ route('projects.index') }}"
                   class="inline-block px-10 py-4 bg-white dark:bg-slate-800 border-2 border-emerald-500
                          text-emerald-600 dark:text-emerald-400 font-semibold rounded-2xl
                          hover:bg-emerald-500 hover:text-white transition-all duration-300 shadow-lg">
                    Lihat Semua Projects →
                </a>
            </div>
        @endif

    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
     ML ROADMAP - Vertical Timeline
════════════════════════════════════════════════════════════════ --}}
<section id="ml-roadmap" class="py-32 bg-white dark:bg-slate-900">
    <div class="container mx-auto px-6">

        <div class="text-center mb-16">
            <h2 class="font-lexend text-4xl lg:text-5xl font-bold mb-4
                        bg-gradient-to-r from-purple-500 to-emerald-500 bg-clip-text text-transparent">
                ML & Deep Learning Journey
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-xl mx-auto">
                Perjalanan belajar machine learning saya dari dasar hingga production.
            </p>
        </div>

        <div class="max-w-3xl mx-auto relative">
            {{-- Vertical line --}}
            <div class="absolute left-6 md:left-1/2 md:-ml-px top-0 bottom-0 w-0.5
                        bg-gradient-to-b from-emerald-400 via-sky-400 to-purple-500"></div>

            @php
                $milestones = [
                    ['num' => '01', 'year' => '2021', 'color' => 'emerald', 'title' => 'Python & NumPy Mastery',
                     'desc' => 'Fondasi ML dengan Python, NumPy, Pandas. Data manipulation dan vectorized operations untuk analisis data skala besar.'],
                    ['num' => '02', 'year' => '2022', 'color' => 'sky', 'title' => 'Scikit-Learn & TensorFlow',
                     'desc' => 'Implementasi algoritma klasik (SVM, Random Forest, K-NN) dan first deep learning model menggunakan Keras.'],
                    ['num' => '03', 'year' => '2023', 'color' => 'purple', 'title' => 'Computer Vision & NLP',
                     'desc' => 'CNN untuk image classification, RNN/LSTM untuk sequence data, fine-tuning pre-trained transformer models (BERT, GPT).'],
                    ['num' => '⚡', 'year' => '2024 →', 'color' => 'gradient', 'title' => 'Advanced Deep Learning & MLOps',
                     'desc' => 'GANs, Diffusion Models, LLM fine-tuning. Production ML pipelines dengan MLflow, Docker & Kubernetes. API serving dengan FastAPI.'],
                ];
            @endphp

            <div class="space-y-12">
                @foreach ($milestones as $i => $m)
                    <div class="relative flex {{ $i % 2 === 0 ? '' : 'flex-row-reverse' }} items-start gap-8 md:gap-12">
                        {{-- Node --}}
                        <div class="flex-shrink-0 relative z-10">
                            @if ($m['color'] === 'gradient')
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white font-black text-xl
                                            shadow-xl bg-gradient-to-br from-emerald-500 to-purple-500 animate-pulse">
                                    {{ $m['num'] }}
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


{{-- ═══════════════════════════════════════════════════════════
     CONTACT SECTION
════════════════════════════════════════════════════════════════ --}}
<section id="contact" class="py-32 bg-gray-50 dark:bg-slate-950">
    <div class="container mx-auto px-6 max-w-2xl">

        <div class="text-center mb-16">
            <h2 class="font-lexend text-4xl lg:text-5xl font-bold mb-4
                        bg-gradient-to-r from-emerald-500 to-emerald-600 bg-clip-text text-transparent">
                Let's Talk
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Punya proyek menarik? Mari berkolaborasi dan wujudkan idemu!
            </p>
        </div>

        <div class="bg-white dark:bg-slate-800 p-10 md:p-12 rounded-3xl shadow-2xl border border-gray-100 dark:border-slate-700">

            @if (session('success'))
                <div class="mb-8 p-5 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 rounded-2xl">
                    <p class="text-emerald-700 dark:text-emerald-300 font-medium">
                        ✅ {{ session('success') }}
                    </p>
                </div>
            @endif

            <form id="contact-form"
                  method="POST"
                  action="{{ route('contact.store') }}"
                  class="space-y-6">
                @csrf

                <div>
                    <label for="contact-name"
                           class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">
                        Nama Lengkap *
                    </label>
                    <input type="text"
                           id="contact-name"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           class="contact-input w-full px-5 py-4 rounded-2xl
                                  bg-gray-50 dark:bg-slate-700
                                  border-2 border-gray-200 dark:border-slate-600
                                  focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20
                                  outline-none transition-all duration-300 text-base
                                  @error('name') border-red-500 @enderror"
                           placeholder="Nama Anda">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="contact-email"
                           class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">
                        Email *
                    </label>
                    <input type="email"
                           id="contact-email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           class="contact-input w-full px-5 py-4 rounded-2xl
                                  bg-gray-50 dark:bg-slate-700
                                  border-2 border-gray-200 dark:border-slate-600
                                  focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20
                                  outline-none transition-all duration-300 text-base
                                  @error('email') border-red-500 @enderror"
                           placeholder="email@contoh.com">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="contact-message"
                           class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">
                        Pesan *
                    </label>
                    <textarea id="contact-message"
                              name="message"
                              rows="6"
                              required
                              class="contact-input w-full px-5 py-4 rounded-2xl
                                     bg-gray-50 dark:bg-slate-700
                                     border-2 border-gray-200 dark:border-slate-600
                                     focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20
                                     outline-none transition-all duration-300 text-base resize-vertical
                                     @error('message') border-red-500 @enderror"
                              placeholder="Ceritakan tentang proyek atau ide Anda...">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600
                               hover:from-emerald-600 hover:to-emerald-700
                               text-white font-bold py-5 px-8 rounded-2xl text-lg
                               shadow-xl shadow-emerald-500/25 hover:shadow-emerald-500/40
                               transition-all duration-300 hover:-translate-y-1">
                    Kirim Pesan ✉️
                </button>

            </form>
        </div>

    </div>
</section>

@endsection