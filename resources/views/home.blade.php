@extends('layouts.app')

@section('title', 'Home - Portfolio')

@section('content')
<!-- Hero Section -->
<section id="hero" class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 to-emerald-50 dark:from-midnight-900 dark:to-slate-900 pt-20">
    <div class="container mx-auto px-6 text-center">
        <div class="max-w-4xl">
            <!-- Gradient Text -->
            <h1 class="font-lexend text-7xl md:text-8xl lg:text-9xl font-black leading-tight mb-8 bg-gradient-to-r from-emerald-400 via-sky-400 to-emerald-600 bg-clip-text text-transparent animate-float">
                Senior Full-Stack<br>
                <span class="text-6xl md:text-7xl lg:text-8xl">Engineer</span>
            </h1>
            <p class="font-inter text-xl md:text-2xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-12 leading-relaxed">
                Membangun aplikasi web inovatif dengan Laravel, Tailwind CSS v4, dan teknologi modern lainnya.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#projects" class="btn-emerald px-10 py-5 text-lg font-semibold rounded-2xl shadow-2xl hover:shadow-emerald/25 transition-all duration-500 transform hover:-translate-y-2">
                    Lihat Projects
                </a>
                <a href="#contact" class="px-10 py-5 border-2 border-emerald-500 text-emerald-500 font-semibold rounded-2xl hover:bg-emerald-500 hover:text-white transition-all duration-500">
                    Hubungi Saya
                </a>
            </div>
        </div>
        <!-- Floating Hero Image - Framer Motion animasi via JS -->
        <div class="absolute -bottom-20 right-10 w-80 h-80 md:w-96 md:h-96 rounded-3xl bg-gradient-to-br from-emerald-400 to-sky-400 opacity-20 animate-pulse-hero"></div>
    </div>
</section>

<!-- Identity Section - 3-column Bento Grid -->
<section id="identity" class="py-32 bg-white dark:bg-midnight-900">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Experience Bento -->
            <div class="group relative bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-midnight-800 dark:to-midnight-700 p-10 rounded-3xl hover:scale-105 transition-all duration-500 shadow-lg hover:shadow-emerald/30">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/10 rounded-3xl group-hover:opacity-100 opacity-0 transition-opacity"></div>
                <h3 class="font-lexend text-3xl font-bold mb-4 relative z-10 text-emerald-600 dark:text-emerald-400">Experience</h3>
                <ul class="space-y-3 relative z-10">
                    <li class="font-inter text-lg flex items-center">
                        <span class="w-3 h-3 bg-emerald-500 rounded-full mr-4"></span>
                        Senior Full-Stack Developer (2020 - Sekarang)
                    </li>
                    <li class="font-inter text-lg flex items-center">
                        <span class="w-3 h-3 bg-emerald-500 rounded-full mr-4"></span>
                        Laravel & Vue.js Specialist
                    </li>
                </ul>
            </div>

            <!-- Education Bento -->
            <div class="md:col-span-2 group relative bg-gradient-to-br from-sky-50 to-blue-100 dark:from-midnight-800 dark:to-midnight-700 p-10 md:p-12 rounded-3xl hover:scale-105 transition-all duration-500 shadow-lg hover:shadow-sky/30">
                <div class="absolute inset-0 bg-gradient-to-r from-sky-400/10 rounded-3xl group-hover:opacity-100 opacity-0 transition-opacity"></div>
                <h3 class="font-lexend text-3xl font-bold mb-4 relative z-10 text-sky-600 dark:text-sky-400">Education</h3>
                <p class="font-inter text-lg mb-6 relative z-10 leading-relaxed">
                    Teknik Informatika - Universitas Indonesia<br>
                    <span class="text-sm opacity-75">Lulusan 2020</span>
                </p>
            </div>

            <!-- Interests Bento -->
            <div class="group relative bg-gradient-to-br from-purple-50 to-pink-100 dark:from-midnight-800 dark:to-midnight-700 p-10 rounded-3xl hover:scale-105 transition-all duration-500 shadow-lg hover:shadow-purple/30">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-400/10 rounded-3xl group-hover:opacity-100 opacity-0 transition-opacity"></div>
                <h3 class="font-lexend text-3xl font-bold mb-6 relative z-10 text-purple-600 dark:text-purple-400">Interests</h3>
                <div class="grid grid-cols-2 gap-4 relative z-10">
                    <span class="font-inter px-4 py-2 bg-white/50 dark:bg-white/20 backdrop-blur-sm rounded-xl text-center font-medium">Machine Learning</span>
                    <span class="font-inter px-4 py-2 bg-white/50 dark:bg-white/20 backdrop-blur-sm rounded-xl text-center font-medium">Deep Learning</span>
                    <span class="font-inter px-4 py-2 bg-white/50 dark:bg-white/20 backdrop-blur-sm rounded-xl text-center font-medium">DevOps</span>
                    <span class="font-inter px-4 py-2 bg-white/50 dark:bg-white/20 backdrop-blur-sm rounded-xl text-center font-medium">Open Source</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section - 3-column Cards -->
<section id="projects" class="py-32 bg-gray-50 dark:bg-midnight-800">
    <div class="container mx-auto px-6">
        <div class="text-center mb-20">
            <h2 class="font-lexend text-5xl lg:text-6xl font-bold bg-gradient-to-r from-emerald-500 to-emerald-600 bg-clip-text text-transparent mb-6">
                Projects
            </h2>
            <p class="font-inter text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Beberapa proyek terbaik yang saya kerjakan menggunakan teknologi terkini.
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @forelse ($projects ?? [] as $project)
            <div class="group relative bg-white dark:bg-midnight-900 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-500 cursor-pointer custom-cursor-project" onclick="window.location='{{ route('projects.show', $project) }}'">
                <div class="h-48 bg-gradient-to-r from-emerald-400 to-sky-500 relative overflow-hidden">
                    @if($project->image_path)
                        <img src="{{ Storage::url($project->image_path) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 animate-pulse"></div>
                    @endif
                    <div class="absolute top-4 right-4 bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $project->date->format('Y') }}
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="font-lexend text-2xl font-bold mb-4 group-hover:text-emerald-500 transition-colors">{{ $project->title }}</h3>
                    <p class="font-inter text-gray-600 dark:text-gray-300 mb-6 line-clamp-3 leading-relaxed">{{ $project->description }}</p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($project->tech_stack as $tech)
                            <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 rounded-full text-sm font-medium">
                                {{ $tech }}
                            </span>
                        @endforeach
                    </div>
                    <div class="flex space-x-4">
                        @if($project->live_link)
                            <a href="{{ $project->live_link }}" target="_blank" class="text-emerald-500 hover:text-emerald-600 font-medium flex items-center gap-2">
                                Live <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.558h3.308c-.093-1.416.377-2.651.766-3.558.24-.559.499-.948.737-1.182.233-.23.389-.262.465-.262zm-.812 9.922a3.999 3.999 0 004.506 0l.514-.514a1 1 0 00-1.414-1.414l-.514.514a1.999 1.999 0 01-2.572 0l-.514-.514a1 1 0 00-1.414 1.414l.514.514z" clip-rule="evenodd"></path></svg>
                            </a>
                        @endif
                        @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 font-medium flex items-center gap-2">
                                GitHub <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.058-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.176 2.873.171 3.176.768.84 1.239 1.91 1.239 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-7.219-5.865-13.998-13.998-13.998z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <p class="text-2xl text-gray-500 dark:text-gray-400">Belum ada proyek. <a href="{{ route('admin.projects.create') }}" class="text-emerald-500 font-semibold hover:underline">Tambah sekarang?</a></p>
            </div>
            @endforelse
        </div>
        
        <!-- Load More Button (infinite scroll placeholder) -->
        <div class="text-center mt-16">
            <button class="px-12 py-4 bg-emerald-500 text-white rounded-2xl font-semibold text-lg hover:bg-emerald-600 transition-all duration-300 shadow-xl hover:shadow-emerald/25 transform hover:-translate-y-1">
                Load More Projects
            </button>
        </div>
    </div>
</section>

<!-- ML Roadmap - Vertical Timeline -->
<section id="ml-roadmap" class="py-32 bg-gradient-to-b from-gray-50 to-white dark:from-midnight-900 dark:to-midnight-800">
    <div class="container mx-auto px-6">
        <div class="text-center mb-20">
            <h2 class="font-lexend text-5xl lg:text-6xl font-bold mb-6 bg-gradient-to-r from-purple-500 to-emerald-500 bg-clip-text text-transparent">
                ML & Deep Learning Roadmap
            </h2>
        </div>
        <div class="max-w-4xl mx-auto relative">
            <!-- Timeline Line -->
            <div class="absolute left-8 md:left-1/2 top-0 bottom-0 w-0.5 bg-gradient-to-b from-emerald-400 to-purple-500"></div>
            
            <div class="space-y-12">
                <!-- Milestone 1 -->
                <div class="flex items-start relative">
                    <div class="flex-shrink-0 w-16 h-16 bg-emerald-500 rounded-3xl flex items-center justify-center text-white font-bold text-xl shadow-2xl border-4 border-white z-10">1</div>
                    <div class="ml-8 md:ml-0 md:-ml-4 md:flex-1">
                        <h3 class="font-lexend text-2xl font-bold mb-4 text-emerald-600 dark:text-emerald-400">Python & NumPy Mastery</h3>
                        <p class="font-inter text-lg text-gray-600 dark:text-gray-300 leading-relaxed">Dasar machine learning dengan Python, NumPy, Pandas. Memahami data manipulation dan vectorized operations.</p>
                        <span class="block mt-2 text-sm font-medium text-emerald-500">2021</span>
                    </div>
                </div>
                
                <!-- Milestone 2 -->
                <div class="flex items-start relative md:flex-row-reverse">
                    <div class="flex-shrink-0 w-16 h-16 bg-purple-500 rounded-3xl flex items-center justify-center text-white font-bold text-xl shadow-2xl border-4 border-white z-10">2</div>
                    <div class="ml-8 md:ml-0 md:-ml-4 md:flex-1">
                        <h3 class="font-lexend text-2xl font-bold mb-4 text-purple-600 dark:text-purple-400">Scikit-Learn & TensorFlow</h3>
                        <p class="font-inter text-lg text-gray-600 dark:text-gray-300 leading-relaxed">Implementasi algoritma klasik dan deep learning pertama dengan TensorFlow/Keras.</p>
                        <span class="block mt-2 text-sm font-medium text-purple-500">2022</span>
                    </div>
                </div>
                
                <!-- Current Milestone -->
                <div class="flex items-start relative">
                    <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-r from-emerald-500 to-purple-500 rounded-3xl flex items-center justify-center text-white font-bold text-xl shadow-2xl border-4 border-white z-10 animate-pulse">⚡</div>
                    <div class="ml-8 md:ml-0 md:-ml-4 md:flex-1">
                        <h3 class="font-lexend text-3xl font-bold mb-4 bg-gradient-to-r from-emerald-500 to-purple-500 bg-clip-text text-transparent">Advanced Deep Learning</h3>
                        <p class="font-inter text-lg text-gray-600 dark:text-gray-300 leading-relaxed">GANs, Transformers, Reinforcement Learning. Production ML pipelines dengan Docker & Kubernetes.</p>
                        <span class="block mt-2 text-sm font-medium text-emerald-500">2024 →</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section - Interactive Form -->
<section id="contact" class="py-32 bg-white dark:bg-midnight-900">
    <div class="container mx-auto px-6 max-w-2xl">
        <div class="text-center mb-20">
            <h2 class="font-lexend text-5xl lg:text-6xl font-bold mb-6 bg-gradient-to-r from-emerald-500 to-emerald-600 bg-clip-text text-transparent">
                Let's Talk
            </h2>
            <p class="font-inter text-xl text-gray-600 dark:text-gray-300">
                Punya proyek menarik? Mari berkolaborasi!
            </p>
        </div>
        
        <form id="contact-form" method="POST" action="{{ route('contact.store') }}" class="space-y-6 bg-gray-50 dark:bg-midnight-800/50 backdrop-blur-xl p-12 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-800">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                <input type="text" name="name" required class="contact-input w-full px-6 py-4 rounded-2xl bg-white dark:bg-midnight-900 border-2 border-gray-200 dark:border-gray-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 text-lg @error('name') border-red-500 @enderror" placeholder="Nama Anda">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" required class="contact-input w-full px-6 py-4 rounded-2xl bg-white dark:bg-midnight-900 border-2 border-gray-200 dark:border-gray-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 text-lg @error('email') border-red-500 @enderror" placeholder="email@example.com">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Pesan</label>
                <textarea name="message" required rows="6" class="contact-input w-full px-6 py-4 rounded-2xl bg-white dark:bg-midnight-900 border-2 border-gray-200 dark:border-gray-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 text-lg resize-vertical @error('message') border-red-500 @enderror" placeholder="Ceritakan tentang proyek Anda..."></textarea>
                @error('message') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold py-6 px-8 rounded-3xl text-xl shadow-2xl hover:shadow-emerald/50 transform hover:-translate-y-2 transition-all duration-500 disabled:opacity-50 disabled:cursor-not-allowed">
                Kirim Pesan
            </button>
        </form>
    </div>
</section>
@endsection
