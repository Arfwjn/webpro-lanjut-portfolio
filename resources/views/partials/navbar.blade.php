<nav class="sticky top-0 z-50 backdrop-blur-xl bg-white/80 dark:bg-midnight-900/90 border-b border-gray-200 dark:border-gray-800 shadow-sm transition-all duration-300 glassmorphism">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold bg-gradient-to-r from-emerald-500 to-emerald-600 bg-clip-text text-transparent hover:scale-105 transition-transform duration-300">
                Portfolio
                <span class="text-xs block -mt-1 font-light">v1.0</span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#hero" class="group relative text-lg font-medium transition-colors hover:text-emerald-500">
                    Home
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="#projects" class="group relative text-lg font-medium transition-colors hover:text-emerald-500">
                    Projects 
                    <span class="skill-hover">Skill</span>
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="#identity" class="group relative text-lg font-medium transition-colors hover:text-emerald-500">
                    About
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="#contact" class="group relative text-lg font-medium transition-colors hover:text-emerald-500">
                    Contact
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                </a>
            </div>

            <!-- Auth & Dark Toggle -->
            <div class="flex items-center space-x-4">
                <!-- Dark/Light Toggle -->
                <button id="theme-toggle" class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-800 transition-colors duration-200" aria-label="Toggle dark mode">
                    <svg id="sun-icon" class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.706a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                    <svg id="moon-icon" class="w-5 h-5 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                </button>

                <!-- Auth Links -->
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn-emerald px-6 py-2 rounded-full font-medium transition-all hover:scale-105">
                        Admin
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-6 py-2 bg-gray-200 dark:bg-gray-800 rounded-full font-medium hover:bg-gray-300 dark:hover:bg-gray-700 transition-all">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2 bg-emerald-500 text-white rounded-full font-medium hover:bg-emerald-600 transition-all">Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Menu Placeholder for emilkowalski/skill -->
<!-- Will be enhanced with JS -->
