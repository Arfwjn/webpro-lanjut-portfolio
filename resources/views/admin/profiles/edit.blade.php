@extends('layouts.app')

@section('title', 'Edit Profil - Admin')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-6 max-w-3xl">        
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.profiles.index') }}"
            class="group inline-flex items-center gap-2 text-slate-500 hover:text-gray-600 font-sm transition-colors">
                
                {{-- Ikon Panah Kembali --}}
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" 
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>

                <span class="text-sm">Kembali ke Profil</span>
            </a>            
        </div>
        <div class="flex items-center justify-center">
            <h1 class="my-2 font-lexend text-3xl font-bold">
                Edit Profil
            </h1>
        </div>

        <form method="POST" action="{{ route('admin.profiles.update', $profile) }}"
              enctype="multipart/form-data"
              class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-6">
            @csrf
            @method('PUT')

            {{-- Foto Profil --}}
            <div>
                <label class="block text-sm font-semibold mb-3 text-gray-700 dark:text-gray-300">Foto Profil</label>
                <div class="flex items-center gap-6">
                    {{-- Preview current avatar --}}
                    <div class="w-24 h-24 rounded-full flex-shrink-0 overflow-hidden bg-gradient-to-br from-emerald-400 to-sky-400 flex items-center justify-center">
                        @if ($profile->avatar_url)
                            <img id="avatar-preview"
                                 src="{{ $profile->avatar_url }}"
                                 alt="{{ $profile->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <span id="avatar-preview" class="text-white font-black text-3xl">{{ $profile->initials }}</span>
                        @endif
                    </div>
                    <div class="flex-1 space-y-3">
                        <div>
                            <input type="file" name="avatar" id="avatar-input" accept="image/*"
                                   class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700
                                          focus:border-emerald-500 outline-none transition-all">
                            <p class="text-xs text-gray-400 mt-1">Upload baru untuk mengganti. Max 2MB.</p>
                        </div>
                        @if ($profile->avatar_path)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="remove_avatar" value="1"
                                       class="w-4 h-4 accent-rose-500">
                                <span class="text-sm text-rose-500 font-medium">Hapus foto profil saat ini</span>
                            </label>
                        @endif
                        @error('avatar') <p class="text-rose-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Nama *</label>
                <input type="text" name="name" value="{{ old('name', $profile->name) }}" required
                       class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all @error('name') border-rose-500 @enderror">
                @error('name') <p class="text-rose-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Bio Singkat *</label>
                <textarea name="bio" rows="3" required
                          class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all resize-vertical @error('bio') border-rose-500 @enderror">{{ old('bio', $profile->bio) }}</textarea>
                @error('bio') <p class="text-rose-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Bio Detail</label>
                <textarea name="detailed_bio" rows="6"
                          class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all resize-vertical">{{ old('detailed_bio', $profile->detailed_bio) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-3 text-gray-700 dark:text-gray-300">Social Links</label>
                <div class="space-y-3">
                    @foreach (['github' => 'GitHub', 'linkedin' => 'LinkedIn', 'twitter' => 'Twitter/X', 'instagram' => 'Instagram', 'website' => 'Website'] as $platform => $label)
                        <div class="flex items-center gap-3">
                            <span class="w-24 text-sm font-medium text-gray-600 dark:text-gray-400">{{ $label }}</span>
                            <input type="url" name="social_links[{{ $platform }}]"
                                   value="{{ old('social_links.'.$platform, $profile->social_links[$platform] ?? '') }}"
                                   placeholder="https://..."
                                   class="flex-1 px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit"
                        class="px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-2xl font-semibold transition-all shadow-lg hover:shadow-emerald-500/30">
                    Perbarui Profil
                </button>
                <a href="{{ route('admin.profiles.index') }}"
                   class="px-8 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-2xl font-semibold transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
const avatarInput = document.getElementById('avatar-input');
const avatarPreview = document.getElementById('avatar-preview');

avatarInput?.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            if (avatarPreview.tagName === 'IMG') {
                avatarPreview.src = e.target.result;
            } else {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';
                img.id = 'avatar-preview';
                avatarPreview.replaceWith(img);
            }
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection