@extends('layouts.app')

@section('title', 'Edit Proyek - Admin')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-6 max-w-3xl">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.projects.index') }}" class="text-emerald-500 hover:text-emerald-600">← Kembali</a>
            <h1 class="font-lexend text-3xl font-bold">Edit: {{ $project->title }}</h1>
        </div>

        <form method="POST" action="{{ route('admin.projects.update', $project) }}"
              enctype="multipart/form-data"
              class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Judul Proyek *</label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" required
                           class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all">
                    @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Deskripsi *</label>
                    <textarea name="description" rows="5" required
                              class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all resize-vertical">{{ old('description', $project->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Gambar Cover</label>
                    @if ($project->image_path)
                        <div class="mb-3 flex items-center gap-4">
                            <img src="{{ Storage::url($project->image_path) }}"
                                 alt="Current" class="w-20 h-20 object-cover rounded-xl">
                            <p class="text-sm text-gray-500">Gambar saat ini. Upload baru untuk mengganti.</p>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*"
                           class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all">
                    @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Tech Stack *</label>
                    <div id="tech-stack-container" class="space-y-2">
                        @foreach (old('tech_stack', $project->tech_stack) as $tech)
                            <div class="flex gap-2">
                                <input type="text" name="tech_stack[]" value="{{ $tech }}"
                                       class="flex-1 px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all">
                                <button type="button" onclick="this.parentElement.remove()"
                                        class="px-4 py-3 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-colors">✕</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addTech()"
                            class="mt-2 px-4 py-2 text-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 rounded-xl text-sm font-medium transition-colors">
                        + Tambah Teknologi
                    </button>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Link Live</label>
                    <input type="url" name="live_link" value="{{ old('live_link', $project->live_link) }}"
                           class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all"
                           placeholder="https://...">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Link GitHub</label>
                    <input type="url" name="github_link" value="{{ old('github_link', $project->github_link) }}"
                           class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all"
                           placeholder="https://github.com/...">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Tanggal *</label>
                    <input type="date" name="date" value="{{ old('date', $project->date->format('Y-m-d')) }}" required
                           class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all">
                </div>

                @if ($profiles->count())
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Profil Terkait</label>
                        <select name="profile_id"
                                class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all">
                            <option value="">-- Tidak ada --</option>
                            @foreach ($profiles as $id => $name)
                                <option value="{{ $id }}" {{ old('profile_id', $project->profile_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit"
                        class="px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-2xl font-semibold transition-all shadow-lg hover:shadow-emerald-500/30">
                    Perbarui Proyek
                </button>
                <a href="{{ route('admin.projects.index') }}"
                   class="px-8 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-2xl font-semibold transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function addTech() {
    const container = document.getElementById('tech-stack-container');
    const div = document.createElement('div');
    div.className = 'flex gap-2';
    div.innerHTML = `
        <input type="text" name="tech_stack[]"
               class="flex-1 px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all"
               placeholder="Contoh: Laravel, Vue.js...">
        <button type="button" onclick="this.parentElement.remove()"
                class="px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors">✕</button>
    `;
    container.appendChild(div);
}
</script>
@endsection