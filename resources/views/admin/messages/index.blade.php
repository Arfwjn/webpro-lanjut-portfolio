@extends('layouts.app')

@section('title', 'Pesan Masuk - Admin')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-6 max-w-5xl">
        <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
            <div>
                <h1 class="font-lexend text-4xl font-bold mb-1">Pesan Masuk</h1>
                <p class="text-gray-500 dark:text-gray-400">Pesan dari form kontak portfolio</p>
            </div>
            @if ($messages->where('is_read', false)->count() > 0)
                <form method="POST" action="{{ route('admin.messages.read-all') }}">
                    @csrf
                    <button type="submit"
                            class="px-6 py-2 transition-all bg-emerald-500 hover:bg-emerald-600 hover:shadow-lg hover:shadow-emerald-500/25 hover:-translate-y-0.5 font-semibold rounded-xl text-white whitespace-nowrap text-sm">
                        Tandai Semua Dibaca
                    </button>
                </form>
            @endif
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-gray-100 dark:border-slate-700 overflow-hidden">
            @if ($messages->count() > 0)
                <div class="divide-y divide-gray-100 dark:divide-slate-700">
                    @foreach ($messages as $msg)
                        <div class="flex items-start gap-4 px-8 py-5 {{ !$msg->is_read ? 'bg-indigo-50/50 dark:bg-indigo-900/10' : 'hover:bg-gray-50 dark:hover:bg-slate-700/50' }} transition-colors">

                            {{-- Avatar --}}
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 via-sky-500 to-purple-500 
                                relative z-10 rounded-full transition-all hover:scale-105 whitespace-nowrap
                                flex items-center justify-center text-white font-black text-xl shrink-0">
                                {{ strtoupper(substr($msg->name, 0, 1)) }}
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1 flex-wrap">
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $msg->name }}</span>
                                    @if (!$msg->is_read)
                                        <span class="text-xs bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 px-2 py-0.5 rounded-full font-medium">
                                            Baru
                                        </span>
                                    @endif
                                    <span class="text-xs text-gray-400 ml-auto">
                                        {{ $msg->created_at->format('d M Y, H:i') }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                    <a href="mailto:{{ $msg->email }}" class="hover:text-indigo-500 transition-colors">{{ $msg->email }}</a>
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed line-clamp-2">
                                    {{ $msg->message }}
                                </p>
                            </div>

                            <div class="flex-shrink-0 flex gap-2 ml-4">
                                <a href="{{ route('admin.messages.show', $msg) }}"
                                   class="px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg font-medium text-xs transition-all hover:scale-105 whitespace-nowrap">
                                    Baca
                                </a>
                                <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}"
                                      onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs font-medium transition-all hover:scale-105 whitespace-nowrap">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-8 py-6 border-t border-gray-100 dark:border-slate-700">
                    {{ $messages->links() }}
                </div>
            @else
                <div class="py-24 text-center">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Belum ada pesan</h3>
                    <p class="text-gray-500 dark:text-gray-400">Pesan dari form kontak akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection