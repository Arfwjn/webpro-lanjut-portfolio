<nav class="sticky top-0 z-50 backdrop-blur-sm bg-white/80 dark:bg-slate-900/90 border-b border-gray-200 dark:border-gray-700 shadow-sm transition-all duration-300">
    <div class="container mx-auto px-6 py-4">
        <div class="grid grid-cols-2 md:grid-cols-3 items-center">

            <div class="flex justify-start">
                <a href="{{ route('home') }}"
                   class="flex items-center gap-2 font-lexend text-2xl font-bold bg-gradient-to-r from-emerald-500 to-emerald-600 bg-clip-text text-transparent hover:scale-105 transition-transform duration-300">
                    Portfolio
                </a>
            </div>

            <div class="hidden md:flex justify-center items-center gap-8">
                <a href="{{ route('home') }}#hero"
                    class="group relative text-base font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors">
                    Home
                    <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="{{ route('home') }}#identity"
                    class="group relative text-base font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors">
                    About
                    <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="{{ route('home') }}#projects"
                    class="group relative text-base font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors">
                    Projects
                    <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="{{ route('home') }}#contact"
                    class="group relative text-base font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors">
                    Contact
                    <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-emerald-500 group-hover:w-full transition-all duration-300"></span>
                </a>
            </div>

            <div class="flex items-center justify-end gap-3">
                {{-- Dark/Light Toggle --}}
                <button id="theme-toggle"
                        class="p-2.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200"
                        aria-label="Toggle dark mode">
                    {{-- Moon (tampil di light mode) --}}
                    <svg id="moon-icon" class="w-5 h-5 text-gray-700 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    {{-- Sun (tampil di dark mode) --}}
                    <svg id="sun-icon" class="w-5 h-5 text-gray-300 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.706a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                    </svg>
                </button>

                @auth
                    {{-- Messages badge --}}
                    @php
                        $unread = \App\Models\ContactMessage::unread()->count();
                    @endphp
                    <a href="{{ route('admin.messages.index') }}"
                       class="relative p-2.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        @if ($unread > 0)
                            <span class="absolute top-1 right-1 w-4 h-4 bg-red-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center">
                                {{ $unread > 9 ? '9+' : $unread }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('admin.dashboard') }}"
                       class="px-5 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full font-medium text-sm transition-all hover:scale-105 whitespace-nowrap">
                       Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="px-5 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full font-medium text-sm transition-all whitespace-nowrap">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="px-5 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full font-medium text-sm transition-all hover:scale-105 whitespace-nowrap">
                        Login
                    </a>
                @endauth
            </div>

        </div>
    </div>
</nav>