@extends('layouts.app')

@section('title', 'Registrasi - Portfolio')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-slate-900 py-20 px-4">
    <div class="w-full max-w-md">

        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="font-lexend text-4xl font-bold bg-gradient-to-r from-emerald-500 to-emerald-600 bg-clip-text text-transparent mb-2 leading-relaxed pb-2">
                Buat Akun
            </h1>
            <p class="text-gray-500 dark:text-gray-400">Daftarkan akun admin baru</p>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl p-10 border border-gray-100 dark:border-gray-700">

            {{-- Error --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-50 dark:bg-rose-900/30 border border-rose-200 dark:border-rose-800 rounded-2xl">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-rose-600 dark:text-rose-400 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Nama Lengkap
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        class="w-full px-5 py-4 rounded-2xl bg-gray-50 dark:bg-slate-700
                               border-2 border-gray-200 dark:border-gray-600
                               focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20
                               transition-all duration-200 text-base outline-none
                               @error('name') border-rose-500 @enderror"
                        placeholder="Nama Anda"
                    >
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full px-5 py-4 rounded-2xl bg-gray-50 dark:bg-slate-700
                               border-2 border-gray-200 dark:border-gray-600
                               focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20
                               transition-all duration-200 text-base outline-none
                               @error('email') border-rose-500 @enderror"
                        placeholder="admin@example.com"
                    >
                </div>

                {{-- Password + Peek --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Password
                    </label>
                    <div class="relative flex items-center">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="w-full px-5 py-4 pr-14 rounded-2xl bg-gray-50 dark:bg-slate-700
                                border-2 border-gray-200 dark:border-gray-600
                                focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20
                                transition-all duration-200 text-base outline-none
                                @error('password') border-rose-500 @enderror"
                            placeholder="Minimal 8 karakter"
                        >
                        <button
                            type="button"
                            id="toggle-password"
                            tabindex="-1"
                            aria-label="Tampilkan / sembunyikan password"
                            class="absolute right-4 flex items-center justify-center
                                text-gray-400 hover:text-emerald-500 transition-colors duration-200"
                        >
                            <svg id="icon-eye" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="icon-eye-slash" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7
                                        a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243
                                        M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29
                                        M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943
                                        9.543 7a10.025 10.025 0 01-4.132 4.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Password Confirmation --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Konfirmasi Password
                    </label>
                    <div class="relative flex items-center">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                            class="w-full px-5 py-4 pr-14 rounded-2xl bg-gray-50 dark:bg-slate-700
                                border-2 border-gray-200 dark:border-gray-600
                                focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20
                                transition-all duration-200 text-base outline-none
                                @error('password_confirmation') border-rose-500 @enderror"
                            placeholder="Ulangi password"
                        >
                        <button
                            type="button"
                            id="toggle-confirm"
                            tabindex="-1"
                            aria-label="Tampilkan / sembunyikan konfirmasi password"
                            class="absolute right-4 flex items-center justify-center
                                text-gray-400 hover:text-emerald-500 transition-colors duration-200"
                        >
                            <svg id="icon-eye-confirm" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="icon-eye-slash-confirm" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7
                                        a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243
                                        M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29
                                        M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943
                                        9.543 7a10.025 10.025 0 01-4.132 4.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600
                           hover:from-emerald-600 hover:to-emerald-700
                           text-white font-bold py-4 px-8 rounded-2xl text-lg
                           shadow-xl hover:shadow-emerald-500/30
                           transition-all duration-300 hover:-translate-y-0.5 mt-2"
                >
                    Buat Akun
                </button>
            </form>

            {{-- Divider + Login Link --}}
            <div class="mt-8 pt-6 border-t border-gray-100 dark:border-slate-700 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                       class="font-semibold text-emerald-500 hover:text-emerald-600 transition-colors ml-1">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </div>

        <p class="text-center mt-6">
            <a href="{{ route('home') }}"
               class="group inline-flex items-center gap-2 text-slate-500 hover:text-gray-600 font-sm transition-colors">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
                <span class="text-sm">Kembali ke Portfolio</span>
            </a>
        </p>
    </div>
</div>

{{-- Script peek password --}}
<script>
    (function () {
        // Password field
        const btnPw      = document.getElementById('toggle-password');
        const inputPw    = document.getElementById('password');
        const eyePw      = document.getElementById('icon-eye');
        const slashPw    = document.getElementById('icon-eye-slash');

        if (btnPw && inputPw) {
            btnPw.addEventListener('click', function () {
                const isHidden = inputPw.type === 'password';
                inputPw.type = isHidden ? 'text' : 'password';
                eyePw.classList.toggle('hidden', isHidden);
                slashPw.classList.toggle('hidden', !isHidden);
                inputPw.focus();
            });
        }

        // Confirm password field
        const btnCf   = document.getElementById('toggle-confirm');
        const inputCf = document.getElementById('password_confirmation');
        const eyeCf   = document.getElementById('icon-eye-confirm');
        const slashCf = document.getElementById('icon-eye-slash-confirm');

        if (btnCf && inputCf) {
            btnCf.addEventListener('click', function () {
                const isHidden = inputCf.type === 'password';
                inputCf.type = isHidden ? 'text' : 'password';
                eyeCf.classList.toggle('hidden', isHidden);
                slashCf.classList.toggle('hidden', !isHidden);
                inputCf.focus();
            });
        }
    })();
</script>
@endsection