<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Portfolio'))</title>

    <!-- Fonts: Inter & Lexend -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Lexend:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = savedTheme ? savedTheme === 'dark' : systemDark;
            if (isDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- Tailwind v4 + App JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-inter antialiased bg-white dark:bg-slate-900 text-gray-900 dark:text-white transition-colors duration-300">

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Flash Messages -->
    @if (session('success'))
        <div id="flash-success" 
            class="fixed top-20 right-4 z-100 flex items-center gap-3
                    bg-white dark:bg-slate-800 
                    px-4 py-3 rounded-2xl 
                    shadow-xl shadow-emerald-500/10 dark:shadow-emerald-900/20
                    border border-emerald-100 dark:border-emerald-800/50 
                    animate-slide-in-top transition-all duration-300">
            
            {{-- Ikon SVG --}}
            <div class="flex-shrink-0 flex items-center justify-center 
                        w-8 h-8 rounded-xl 
                        bg-emerald-100/50 dark:bg-emerald-900/40">
                <svg class="w-5 h-5 text-emerald-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
                </svg>
            </div>

            {{-- Pesan Success --}}
            <span class="font-lexend text-sm font-bold tracking-tight 
                        text-slate-700 dark:text-emerald-50 pr-1">
                {{ session('success') }}
            </span>

            {{-- Tombol Silang --}}
            <button onclick="this.parentElement.remove()" class="ml-auto p-1
                    text-slate-300 dark:text-emerald-800/60
                    hover:text-rose-500 transition-colors"
                    aria-label="Tutup">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div id="flash-error" 
            class="fixed top-20 right-4 z-[100] flex items-center gap-3
                    bg-white dark:bg-slate-800 
                    px-4 py-3 rounded-2xl
                    shadow-xl shadow-rose-500/10 dark:shadow-rose-900/20
                    border border-rose-100 dark:border-rose-800/50 
                    animate-slide-in-top transition-all duration-300">
            
            {{-- Ikon SVG --}}
            <div class="flex-shrink-0 flex items-center justify-center 
                        w-8 h-8 rounded-xl
                        bg-rose-100/50 dark:bg-rose-900/40">
                <svg class="w-5 h-5 text-rose-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/>
                </svg>
            </div>

            {{-- Pesan Error --}}
            <span class="font-lexend text-sm font-bold tracking-tight 
                        text-slate-700 dark:text-rose-50 pr-1">
                {{ session('error') }}
            </span>

            {{-- Tombol Silang --}}
            <button onclick="this.parentElement.remove()" class="ml-auto p-1
                    text-slate-300 dark:text-rose-800/60
                    hover:text-rose-600 transition-colors"
                    aria-label="Tutup">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-200 dark:border-gray-700mt-4 py-12 bg-gray-50 dark:bg-slate-900">
        <div class="container mx-auto px-6 text-center text-sm text-gray-500 dark:text-gray-400">
            © {{ date('Y') }} Web Programming Lanjut. Portfolio Arief Sidik Wijayanto. Dibuat dengan Laravel & Tailwind CSS v4.
        </div>
    </footer>

</body>
</html>