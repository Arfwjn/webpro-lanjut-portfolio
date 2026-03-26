<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Portfolio') }}</title>

    <!-- Fonts: Inter & Lexend (Golden Ratio Typography) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Lexend:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind v4 Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @theme {
        /* Deep Midnight Blue Palette */
        --color-midnight-50: oklch(98% 0.02 260);
        --color-midnight-500: oklch(40% 0.25 260);
        --color-midnight-900: oklch(20% 0.15 260);
        
        /* Emerald Green Palette */
        --color-emerald-400: oklch(65% 0.20 160);
        --color-emerald-500: oklch(60% 0.22 160);
        --color-emerald-600: oklch(55% 0.20 160);
        
        /* Sky Blue Gradient for Hero */
        --gradient-hero: oklch(var(--color-emerald-400) / 0.8) to oklch(70% 0.18 220);
        
        /* Custom Shadows */
        --shadow-glass: 0 8px 32px #00000020;
        --shadow-card: 0 20px 40px #00000015;
        
        /* Custom Cursor */
        --cursor-size: 20px;
    }
</head>
<body class="font-inter antialiased bg-white dark:bg-midnight-900 text-gray-900 dark:text-white transition-colors duration-300">
    <!-- Navbar -->
    @include('partials.navbar')
    
    <!-- Flash Messages -->
    @if (session('success'))
        <div class="fixed top-20 right-4 z-50 bg-emerald-500 text-white px-6 py-3 rounded-lg shadow-lg animate-in slide-in-from-top-2 fade-in duration-300">
            {{ session('success') }}
        </div>
    @endif
    
    <main>
        {{ $slot ?? '' }}
    </main>
    
    <!-- Footer -->
    <footer class="border-t border-gray-200 dark:border-gray-800 mt-24 py-12 bg-gray-50 dark:bg-midnight-900/50">
        <div class="container mx-auto px-6 text-center text-sm text-gray-500 dark:text-gray-400">
            © {{ date('Y') }} Portfolio. Dibuat dengan Laravel 11 & Tailwind v4.
        </div>
    </footer>
</body>
</html>
