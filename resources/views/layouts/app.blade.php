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

    <!-- Tailwind v4 + App JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-inter antialiased bg-white dark:bg-slate-900 text-gray-900 dark:text-white transition-colors duration-300">

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Flash Messages -->
    @if (session('success'))
        <div id="flash-success" class="fixed top-20 right-4 z-50 bg-emerald-500 text-white px-6 py-3 rounded-xl shadow-2xl">
            {{ session('success') }}
        </div>
        <script>setTimeout(() => document.getElementById('flash-success')?.remove(), 4000)</script>
    @endif

    @if (session('error'))
        <div id="flash-error" class="fixed top-20 right-4 z-50 bg-red-500 text-white px-6 py-3 rounded-xl shadow-2xl">
            {{ session('error') }}
        </div>
        <script>setTimeout(() => document.getElementById('flash-error')?.remove(), 4000)</script>
    @endif

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-200 dark:border-gray-700 mt-24 py-12 bg-gray-50 dark:bg-slate-900">
        <div class="container mx-auto px-6 text-center text-sm text-gray-500 dark:text-gray-400">
            © {{ date('Y') }} Portfolio. Dibuat dengan Laravel & Tailwind CSS v4.
        </div>
    </footer>

</body>
</html>