@extends('layouts.app')

@section('title', 'Tambah Profil - Admin')

@section('content')
@php
    $defaultAbout   = \App\Models\Profile::defaultAboutData();
    $defaultRoadmap = \App\Models\Profile::defaultRoadmapItems();
    $roadmapColors  = [
        0 => ['bg' => 'bg-emerald-100 dark:bg-emerald-900/30', 'text' => 'text-emerald-700 dark:text-emerald-300', 'border' => 'border-emerald-200 dark:border-emerald-800'],
        1 => ['bg' => 'bg-sky-100 dark:bg-sky-900/30',     'text' => 'text-sky-700 dark:text-sky-300',         'border' => 'border-sky-200 dark:border-sky-800'],
        2 => ['bg' => 'bg-purple-100 dark:bg-purple-900/30','text' => 'text-purple-700 dark:text-purple-300',   'border' => 'border-purple-200 dark:border-purple-800'],
        3 => ['bg' => 'bg-gradient-to-r from-emerald-50 to-purple-50 dark:from-emerald-900/20 dark:to-purple-900/20', 'text' => 'text-gray-700 dark:text-gray-300', 'border' => 'border-emerald-200 dark:border-emerald-800'],
    ];
@endphp

<div class="py-12">
    <div class="container mx-auto px-6 max-w-3xl">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.profiles.index') }}"
            class="group inline-flex items-center gap-2 text-slate-500 hover:text-gray-600 font-sm transition-colors">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
                <span class="text-sm">Kembali ke Profil</span>
            </a>
        </div>
        <div class="flex items-center justify-center">
            <h1 class="my-2 font-lexend text-3xl font-bold">Tambah Profil Baru</h1>
        </div>

        <form method="POST" action="{{ route('admin.profiles.store') }}"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf

            {{-- CARD: Profil Dasar─--}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-6">
                <h2 class="font-lexend text-lg font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-xs font-black">1</span>
                    Profil Dasar
                </h2>

                {{-- Foto Profil --}}
                <div>
                    <label class="block text-sm font-semibold mb-3 text-gray-700 dark:text-gray-300">Foto Profil</label>
                    <div class="flex items-center gap-6">
                        <div id="avatar-preview-container"
                             class="w-24 h-24 rounded-full bg-gradient-to-br from-emerald-400 to-sky-400
                                    flex items-center justify-center flex-shrink-0 overflow-hidden">
                            <span id="avatar-placeholder" class="text-white font-black text-3xl">?</span>
                            <img id="avatar-preview" src="" alt="Preview" class="hidden w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <input type="file" name="avatar" id="avatar-input" accept="image/*"
                                   class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all @error('avatar') border-rose-500 @enderror">
                            <p class="text-xs text-gray-400 mt-2">Max 2MB. Format: JPG, PNG, WebP.</p>
                            @error('avatar') <p class="text-rose-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Nama *</label>
                    <input type="text" name="name" id="name-input" value="{{ old('name') }}" required
                           class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all @error('name') border-rose-500 @enderror">
                    @error('name') <p class="text-rose-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Bio Singkat *</label>
                    <textarea name="bio" rows="3" required
                              class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all resize-vertical @error('bio') border-rose-500 @enderror">{{ old('bio') }}</textarea>
                    @error('bio') <p class="text-rose-500 text-sm mt-1">{{ $message }}</p> @enderror
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
            </div>

            {{-- CARD: About Experience --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-5">
                <h2 class="font-lexend text-lg font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-xs font-black">2</span>
                    About — Experience
                </h2>

                {{-- Container baris experience --}}
                <div id="experience-container" class="space-y-3">
                    @foreach ($defaultAbout['experience'] as $idx => $exp)
                        <div class="flex gap-2 items-start experience-row">
                            <div class="flex-1 grid grid-cols-2 gap-2">
                                <input type="text" name="about[experience][{{ $idx }}][title]"
                                       value="{{ old('about.experience.'.$idx.'.title', $exp['title']) }}"
                                       placeholder="Jabatan / Posisi"
                                       class="px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
                                <input type="text" name="about[experience][{{ $idx }}][period]"
                                       value="{{ old('about.experience.'.$idx.'.period', $exp['period']) }}"
                                       placeholder="Periode"
                                       class="px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
                            </div>
                            {{-- Tombol hapus baris (SVG X) --}}
                            <button type="button" onclick="removeRow(this, 'experience-container')"
                                    class="p-2.5 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-colors shrink-0" aria-label="Hapus baris">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
                {{-- Tombol tambah baris experience (SVG plus) --}}
                <button type="button" onclick="addExperience()"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 rounded-xl text-sm font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Pengalaman
                </button>
            </div>

            {{-- CARD: About Education & Skills --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-5">
                <h2 class="font-lexend text-lg font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-sky-100 dark:bg-sky-900/40 flex items-center justify-center text-sky-600 dark:text-sky-400 text-xs font-black">3</span>
                    About — Education & Skills
                </h2>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 text-gray-500 dark:text-gray-400 uppercase tracking-wide">Jurusan / Gelar</label>
                        <input type="text" name="about[education][degree]"
                               value="{{ old('about.education.degree', $defaultAbout['education']['degree']) }}"
                               placeholder="Teknik Informatika"
                               class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 text-gray-500 dark:text-gray-400 uppercase tracking-wide">Institusi & Tahun</label>
                        <input type="text" name="about[education][institution]"
                               value="{{ old('about.education.institution', $defaultAbout['education']['institution']) }}"
                               placeholder="Universitas · Lulus 2027"
                               class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold mb-2 text-gray-500 dark:text-gray-400 uppercase tracking-wide">Tech Stack / Skills</label>
                    <div id="skills-container" class="space-y-2">
                        @foreach ($defaultAbout['skills'] as $skill)
                            <div class="flex gap-2 skill-row">
                                <input type="text" name="about[skills][]" value="{{ old('about.skills.'.$loop->index, $skill) }}"
                                       placeholder="Nama teknologi"
                                       class="flex-1 px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
                                <button type="button" onclick="removeRow(this, 'skills-container')"
                                        class="p-2 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-colors" aria-label="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addSkill()"
                            class="mt-2 inline-flex items-center gap-1.5 px-4 py-2 text-sky-600 hover:bg-sky-50 dark:hover:bg-sky-900/20 rounded-xl text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Skill
                    </button>
                </div>
            </div>

            {{-- CARD: About Interests --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-5">
                <h2 class="font-lexend text-lg font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center text-purple-600 dark:text-purple-400 text-xs font-black">4</span>
                    About — Interests
                </h2>

                <div id="interests-container" class="space-y-2">
                    @foreach ($defaultAbout['interests'] as $interest)
                        <div class="flex gap-2 interest-row">
                            <input type="text" name="about[interests][]" value="{{ $interest }}"
                                   placeholder="Bidang minat"
                                   class="flex-1 px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
                            <button type="button" onclick="removeRow(this, 'interests-container')"
                                    class="p-2 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-colors" aria-label="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="addInterest()"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-purple-600 hover:bg-purple-50 dark:hover:bg-purple-900/20 rounded-xl text-sm font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Interest
                </button>
            </div>

            {{-- CARD: About Stats --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-5">
                <div class="flex items-center justify-between">
                    <h2 class="font-lexend text-lg font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-xs font-black">5</span>
                        About — Stats
                    </h2>
                    <span class="text-xs text-gray-400">Tepat 3 item</span>
                </div>

                <div class="grid sm:grid-cols-3 gap-4">
                    @foreach ($defaultAbout['stats'] as $sIdx => $stat)
                        <div class="bg-gray-50 dark:bg-slate-700/50 rounded-2xl p-4 space-y-2">
                            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Statistik {{ $sIdx + 1 }}</label>
                            <input type="text" name="about[stats][{{ $sIdx }}][number]"
                                   value="{{ old('about.stats.'.$sIdx.'.number', $stat['number']) }}"
                                   placeholder="10+"
                                   class="w-full px-3 py-2 rounded-lg border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm font-bold text-center">
                            <input type="text" name="about[stats][{{ $sIdx }}][label]"
                                   value="{{ old('about.stats.'.$sIdx.'.label', $stat['label']) }}"
                                   placeholder="Label"
                                   class="w-full px-3 py-2 rounded-lg border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm text-center">
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- CARD: Learning Journey --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-5">
                <div class="flex items-center justify-between">
                    <h2 class="font-lexend text-lg font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-gradient-to-br from-emerald-100 to-purple-100 dark:from-emerald-900/40 dark:to-purple-900/40 flex items-center justify-center text-gray-600 dark:text-gray-400 text-xs font-black">6</span>
                        Learning Journey — Roadmap
                    </h2>
                    <span class="text-xs text-gray-400">Tepat 4 step</span>
                </div>

                <div class="space-y-4">
                    @foreach ($defaultRoadmap as $rIdx => $step)
                        @php $rc = $roadmapColors[$rIdx]; @endphp
                        <div class="{{ $rc['bg'] }} rounded-2xl p-5 border {{ $rc['border'] }} space-y-3">
                            <span class="text-xs font-black {{ $rc['text'] }} uppercase tracking-widest">
                                Step {{ $rIdx + 1 }}{{ $rIdx === 3 ? '  ✦ Terkini (Selalu Aktif)' : '' }}
                            </span>
                            <div class="grid sm:grid-cols-3 gap-3">
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400">Judul</label>
                                    <input type="text" name="roadmap[{{ $rIdx }}][title]"
                                           value="{{ old('roadmap.'.$rIdx.'.title', $step['title']) }}"
                                           placeholder="Judul tahapan belajar"
                                           class="w-full px-4 py-2.5 rounded-xl border-2 border-white/70 dark:border-slate-600 bg-white dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm font-semibold">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400">Tahun / Periode</label>
                                    <input type="text" name="roadmap[{{ $rIdx }}][year]"
                                           value="{{ old('roadmap.'.$rIdx.'.year', $step['year']) }}"
                                           placeholder="2024"
                                           class="w-full px-4 py-2.5 rounded-xl border-2 border-white/70 dark:border-slate-600 bg-white dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400">Deskripsi</label>
                                <textarea name="roadmap[{{ $rIdx }}][desc]" rows="2"
                                          placeholder="Jelaskan apa yang dipelajari..."
                                          class="w-full px-4 py-2.5 rounded-xl border-2 border-white/70 dark:border-slate-600 bg-white dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm resize-none">{{ old('roadmap.'.$rIdx.'.desc', $step['desc']) }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Submit--}}
            <div class="flex gap-4 pt-2 pb-8">
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
// Avatar Preview
// Preview foto sebelum upload, inisial berubah dinamis sesuai input nama.
const avatarInput       = document.getElementById('avatar-input');
const avatarPreview     = document.getElementById('avatar-preview');
const avatarPlaceholder = document.getElementById('avatar-placeholder');
const nameInput         = document.getElementById('name-input');

function updateInitials(name) {
    const words = name.trim().split(' ').filter(Boolean);
    const initials = words.slice(0, 2).map(w => w[0].toUpperCase()).join('');
    if (avatarPlaceholder) avatarPlaceholder.textContent = initials || '?';
}
nameInput?.addEventListener('input', () => updateInitials(nameInput.value));

avatarInput?.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        avatarPreview.src = e.target.result;
        avatarPreview.classList.remove('hidden');
        avatarPlaceholder?.classList.add('hidden');
    };
    reader.readAsDataURL(file);
});

// Generic Row Removal 
// Hapus baris input dinamis dari container tertentu.
// Minimal 1 baris harus tersisa agar form masih valid.
function removeRow(btn, containerId) {
    const container = document.getElementById(containerId);
    const rows = container.querySelectorAll('[class*="-row"]');
    if (rows.length <= 1) { alert('Minimal harus ada 1 item.'); return; }
    btn.closest('[class*="-row"]').remove();
}

// SVG X
const svgX = `
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
    </svg>`;

// SVG Plus
const svgPlus = `
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
    </svg>`;

// Experience
function addExperience() {
    const container = document.getElementById('experience-container');
    const idx = container.querySelectorAll('.experience-row').length;
    const div = document.createElement('div');
    div.className = 'flex gap-2 items-start experience-row';
    div.innerHTML = `
        <div class="flex-1 grid grid-cols-2 gap-2">
            <input type="text" name="about[experience][${idx}][title]" placeholder="Jabatan / Posisi"
                   class="px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
            <input type="text" name="about[experience][${idx}][period]" placeholder="Periode"
                   class="px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
        </div>
        <button type="button" onclick="removeRow(this,'experience-container')"
                class="p-2.5 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-colors shrink-0" aria-label="Hapus baris">
            ${svgX}
        </button>`;
    container.appendChild(div);
}

// Skills
function addSkill() {
    const container = document.getElementById('skills-container');
    const div = document.createElement('div');
    div.className = 'flex gap-2 skill-row';
    div.innerHTML = `
        <input type="text" name="about[skills][]" placeholder="Nama teknologi"
               class="flex-1 px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
        <button type="button" onclick="removeRow(this,'skills-container')"
                class="p-2 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-colors" aria-label="Hapus">
            ${svgX}
        </button>`;
    container.appendChild(div);
}

// Interests
function addInterest() {
    const container = document.getElementById('interests-container');
    const div = document.createElement('div');
    div.className = 'flex gap-2 interest-row';
    div.innerHTML = `
        <input type="text" name="about[interests][]" placeholder="Bidang minat"
               class="flex-1 px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
        <button type="button" onclick="removeRow(this,'interests-container')"
                class="p-2 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-colors" aria-label="Hapus">
            ${svgX}
        </button>`;
    container.appendChild(div);
}
</script>
@endsection