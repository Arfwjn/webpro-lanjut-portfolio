@extends('layouts.app')

@section('title', 'Detail Pesan - Admin')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-6 max-w-3xl">
        <div class="flex items-center gap-4 mb-16">
            <a href="{{ route('admin.messages.index') }}"
               class="text-indigo-500 hover:text-indigo-600 font-medium">← Kembali ke Pesan</a>
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
                                <span class="text-xs bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 px-2 py-0.5 rounded-full font-medium">
                                    ✓ Sudah dibaca
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
                   class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg font-semibold transition-all hover:scale-105 whitespace-nowrap">
                    Balas via Email ↗
                </a>
                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}"
                      onsubmit="return confirm('Yakin hapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl transition-all">
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