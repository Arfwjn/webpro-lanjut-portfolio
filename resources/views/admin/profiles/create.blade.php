@extends('layouts.app')

@section('title', 'Tambah Profil - Admin')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-6 max-w-3xl">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.profiles.index') }}" class="text-emerald-500 hover:text-emerald-600">← Kembali</a>
            <h1 class="font-lexend text-3xl font-bold">Tambah Profil Baru</h1>
        </div>

        <form method="POST" action="{{ route('admin.profiles.store') }}"
              enctype="multipart/form-data"
              class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-6">
            @csrf

            {{-- Foto Profil --}}
            <div>
                <label class="block text-sm font-semibold mb-3 text-gray-700 dark:text-gray-300">Foto Profil</label>
                <div class="flex items-center gap-6">
                    {{-- Preview --}}
                    <div id="avatar-preview-container"
                         class="w-24 h-24 rounded-full bg-gradient-to-br from-emerald-400 to-sky-400
                                flex items-center justify-center flex-shrink-0 overflow-hidden">
                        <span id="avatar-placeholder" class="text-white font-black text-3xl">?</span>
                        <img id="avatar-preview" src="" alt="Preview" class="hidden w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <input type="file" name="avatar" id="avatar-input" accept="image/*"
                               class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700
                                      focus:border-emerald-500 outline-none transition-all
                                      @error('avatar') border-red-500 @enderror">
                        <p class="text-xs text-gray-400 mt-2">Max 2MB. Format: JPG, PNG, WebP. Disarankan foto persegi (1:1).</p>
                        @error('avatar') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Nama *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Bio Singkat *</label>
                <textarea name="bio" rows="3" required
                          class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all resize-vertical @error('bio') border-red-500 @enderror">{{ old('bio') }}</textarea>
                @error('bio') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Bio Detail</label>
                <textarea name="detailed_bio" rows="6"
                          class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all resize-vertical">{{ old('detailed_bio') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-3 text-gray-700 dark:text-gray-300">Social Links</label>
                <div class="space-y-3">
                    @foreach (['github', 'linkedin', 'twitter', 'instagram', 'website'] as $platform)
                        <div class="flex items-center gap-3">
                            <span class="w-24 text-sm font-medium text-gray-600 dark:text-gray-400 capitalize">{{ $platform }}</span>
                            <input type="url" name="social_links[{{ $platform }}]"
                                   value="{{ old('social_links.'.$platform) }}"
                                   placeholder="https://..."
                                   class="flex-1 px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit"
                        class="px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-2xl font-semibold transition-all shadow-lg hover:shadow-emerald-500/30">
                    Simpan Profil
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
const avatarPlaceholder = document.getElementById('avatar-placeholder');
const nameInput = document.getElementById('name-input');

function updateInitials(name) {
    const words = name.trim().split(' ').filter(Boolean);
    const initials = words.slice(0, 2).map(w => w[0].toUpperCase()).join('');
    avatarPlaceholder.textContent = initials || '?';
}

nameInput?.addEventListener('input', () => updateInitials(nameInput.value));

avatarInput?.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            avatarPreview.src = e.target.result;
            avatarPreview.classList.remove('hidden');
            avatarPlaceholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        avatarPreview.classList.add('hidden');
        avatarPlaceholder.classList.remove('hidden');
    }
});
</script>
@endsection