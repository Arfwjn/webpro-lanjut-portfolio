@extends('layouts.app')

@section('title', 'Detail Pesan - Admin')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-6 max-w-3xl">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.messages.index') }}"
            class="group inline-flex items-center gap-2 text-slate-500 hover:text-gray-600 font-sm transition-colors">
                
                {{-- Ikon Panah Kembali --}}
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" 
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>

                <span class="text-sm">Kembali ke Pesan</span>
            </a>
        </div>
        <div class="flex items-center justify-center">
            <h1 class="my-2 font-lexend text-3xl font-bold">
                Pesan Dari
            </h1>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-gray-100 dark:border-slate-700 overflow-hidden">
            {{-- Header --}}
            <div class="px-10 py-12 border-b border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/50">
                <div class="flex items-start gap-5">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 via-sky-500 to-purple-500 
                                relative z-10 rounded-full transition-all hover:scale-105 whitespace-nowrap
                                flex items-center justify-center text-white font-black text-xl shrink-0">
                        {{ strtoupper(substr($message->name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <h1 class="font-lexend text-2xl font-bold text-gray-900 dark:text-white mb-1">
                            {{ $message->name }}
                        </h1>
                        <a href="mailto:{{ $message->email }}"
                           class="text-indigo-500 hover:text-indigo-600 font-medium transition-colors">
                            {{ $message->email }}
                        </a>
                        <div class="flex items-center gap-3 mt-2">
                            <span class="text-sm text-gray-400">
                                {{ $message->created_at->format('d M Y, H:i') }} WIB
                            </span>
                            @if ($message->is_read)
                                <span class="inline-flex items-center gap-1 text-xs bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 px-2 py-0.5 rounded-full font-medium">
                                    {{-- Ikon Check/Sudah Dibaca --}}
                                    <svg class="w-3 h-3 text-green-700 dark:text-green-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 11.917 9.724 16.5 19 7.5"/>
                                    </svg>
                                    Sudah dibaca
                                </span>
                            @else
                                <span class="text-xs bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 px-2 py-0.5 rounded-full font-medium">
                                    Belum dibaca
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Message body --}}
            <div class="px-10 py-12">
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Pesan</h3>
                <div class="text-gray-700 dark:text-gray-200 leading-relaxed whitespace-pre-line text-base">
                    {{ $message->message }}
                </div>
            </div>

            {{-- Actions --}}
            <div class="px-10 py-12 border-t border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/50 flex gap-4 flex-wrap">
                <a href="mailto:{{ $message->email }}?subject=Re: Pesan dari Portfolio"
                class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-semibold transition-all hover:scale-105 shadow-lg shadow-emerald-500/20 whitespace-nowrap">
                    
                    {{-- SVG Icon --}}
                    <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M5.027 10.9a8.729 8.729 0 0 1 6.422-3.62v-1.2A2.061 2.061 0 0 1 12.61 4.2a1.986 1.986 0 0 1 2.104.23l5.491 4.308a2.11 2.11 0 0 1 .588 2.566 2.109 2.109 0 0 1-.588.734l-5.489 4.308a1.983 1.983 0 0 1-2.104.228 2.065 2.065 0 0 1-1.16-1.876v-.942c-5.33 1.284-6.212 5.251-6.25 5.441a1 1 0 0 1-.923.806h-.06a1.003 1.003 0 0 1-.955-.7A10.221 10.221 0 0 1 5.027 10.9Z"/>
                    </svg>

                    <span>Balas via Email</span>
                </a>
                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}"
                      onsubmit="return confirm('Yakin hapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-6 py-3 bg-rose-500 hover:bg-rose-600 text-white font-semibold rounded-xl transition-all">
                        Hapus Pesan
                    </button>
                </form>
                <a href="{{ route('admin.messages.index') }}"
                   class="px-6 py-3 bg-gray-200 dark:bg-slate-700 hover:bg-gray-300 dark:hover:bg-slate-600 font-semibold rounded-xl transition-all">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection