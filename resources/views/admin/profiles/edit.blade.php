@extends('layouts.app')

@section('title', 'Edit Profil - Admin')

@section('content')
@php
    $aboutData   = $profile->resolvedAboutData();
    $roadmapData = $profile->resolvedRoadmapItems();
    $roadmapColors = [
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
            <h1 class="my-2 font-lexend text-3xl font-bold">Edit Profil</h1>
        </div>

        <form method="POST" action="{{ route('admin.profiles.update', $profile) }}"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            @method('PUT')

            {{-- ── CARD: Profil Dasar ─────────────────────────────────────────── --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-6">
                <h2 class="font-lexend text-lg font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-xs font-black">1</span>
                    Profil Dasar
                </h2>

                {{-- Foto Profil --}}
                <div>
                    <label class="block text-sm font-semibold mb-3 text-gray-700 dark:text-gray-300">Foto Profil</label>
                    <div class="flex items-center gap-6">
                        <div class="w-24 h-24 rounded-full flex-shrink-0 overflow-hidden bg-gradient-to-br from-emerald-400 to-sky-400 flex items-center justify-center">
                            @if ($profile->avatar_url)
                                <img id="avatar-preview" src="{{ $profile->avatar_url }}" alt="{{ $profile->name }}" class="w-full h-full object-cover">
                            @else
                                <span id="avatar-preview" class="text-white font-black text-3xl">{{ $profile->initials }}</span>
                            @endif
                        </div>
                        <div class="flex-1 space-y-3">
                            <div>
                                <input type="file" name="avatar" id="avatar-input" accept="image/*"
                                       class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all">
                                <p class="text-xs text-gray-400 mt-1">Upload baru untuk mengganti. Max 2MB.</p>
                            </div>
                            @if ($profile->avatar_path)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="remove_avatar" value="1" class="w-4 h-4 accent-rose-500">
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
            </div>

            {{-- ── CARD: About — Experience ───────────────────────────────────── --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-5">
                <div class="flex items-center justify-between">
                    <h2 class="font-lexend text-lg font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-xs font-black">2</span>
                        About — Experience
                    </h2>
                    <span class="text-xs text-gray-400">Ditampilkan di kartu "Experience"</span>
                </div>

                <div id="experience-container" class="space-y-3">
                    @foreach ($aboutData['experience'] as $idx => $exp)
                        <div class="flex gap-2 items-start experience-row">
                            <div class="flex-1 grid grid-cols-2 gap-2">
                                <input type="text" name="about[experience][{{ $idx }}][title]"
                                       value="{{ old('about.experience.'.$idx.'.title', $exp['title']) }}"
                                       placeholder="Jabatan / Posisi"
                                       class="px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
                                <input type="text" name="about[experience][{{ $idx }}][period]"
                                       value="{{ old('about.experience.'.$idx.'.period', $exp['period']) }}"
                                       placeholder="Periode (misal: 2025 - Sekarang)"
                                       class="px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
                            </div>
                            <button type="button" onclick="removeRow(this, 'experience-container')"
                                    class="px-3 py-2.5 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-colors shrink-0">✕</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="addExperience()"
                        class="px-4 py-2 text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 rounded-xl text-sm font-medium transition-colors">
                    + Tambah Pengalaman
                </button>
            </div>

            {{-- ── CARD: About — Education & Skills ───────────────────────────── --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-5">
                <div class="flex items-center justify-between">
                    <h2 class="font-lexend text-lg font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-sky-100 dark:bg-sky-900/40 flex items-center justify-center text-sky-600 dark:text-sky-400 text-xs font-black">3</span>
                        About — Education & Skills
                    </h2>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 text-gray-500 dark:text-gray-400 uppercase tracking-wide">Jurusan / Gelar</label>
                        <input type="text" name="about[education][degree]"
                               value="{{ old('about.education.degree', $aboutData['education']['degree']) }}"
                               placeholder="Teknik Informatika"
                               class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 text-gray-500 dark:text-gray-400 uppercase tracking-wide">Institusi & Tahun</label>
                        <input type="text" name="about[education][institution]"
                               value="{{ old('about.education.institution', $aboutData['education']['institution']) }}"
                               placeholder="STMIK Widya Utama · Lulus 2027"
                               class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold mb-2 text-gray-500 dark:text-gray-400 uppercase tracking-wide">Tech Stack / Skills</label>
                    <div id="skills-container" class="space-y-2">
                        @foreach ($aboutData['skills'] as $skill)
                            <div class="flex gap-2 skill-row">
                                <input type="text" name="about[skills][]" value="{{ $skill }}"
                                       placeholder="Nama teknologi"
                                       class="flex-1 px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
                                <button type="button" onclick="removeRow(this, 'skills-container')"
                                        class="px-3 py-2 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-colors">✕</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addSkill()"
                            class="mt-2 px-4 py-2 text-sky-600 hover:bg-sky-50 dark:hover:bg-sky-900/20 rounded-xl text-sm font-medium transition-colors">
                        + Tambah Skill
                    </button>
                </div>
            </div>

            {{-- ── CARD: About — Interests ─────────────────────────────────────── --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-5">
                <div class="flex items-center justify-between">
                    <h2 class="font-lexend text-lg font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center text-purple-600 dark:text-purple-400 text-xs font-black">4</span>
                        About — Interests
                    </h2>
                    <span class="text-xs text-gray-400">Tampil dalam grid 2 kolom</span>
                </div>

                <div id="interests-container" class="space-y-2">
                    @foreach ($aboutData['interests'] as $interest)
                        <div class="flex gap-2 interest-row">
                            <input type="text" name="about[interests][]" value="{{ $interest }}"
                                   placeholder="Bidang minat"
                                   class="flex-1 px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
                            <button type="button" onclick="removeRow(this, 'interests-container')"
                                    class="px-3 py-2 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-colors">✕</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="addInterest()"
                        class="px-4 py-2 text-purple-600 hover:bg-purple-50 dark:hover:bg-purple-900/20 rounded-xl text-sm font-medium transition-colors">
                    + Tambah Interest
                </button>
            </div>

            {{-- ── CARD: About — Stats ─────────────────────────────────────────── --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-5">
                <div class="flex items-center justify-between">
                    <h2 class="font-lexend text-lg font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-xs font-black">5</span>
                        About — Stats
                    </h2>
                    <span class="text-xs text-gray-400">Tepat 3 item — ditampilkan di kartu hijau</span>
                </div>

                <div class="grid sm:grid-cols-3 gap-4">
                    @foreach ($aboutData['stats'] as $sIdx => $stat)
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

            {{-- ── CARD: Learning Journey (Roadmap) ───────────────────────────── --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl p-10 border border-gray-100 dark:border-gray-700 space-y-5">
                <div class="flex items-center justify-between">
                    <h2 class="font-lexend text-lg font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-gradient-to-br from-emerald-100 to-purple-100 dark:from-emerald-900/40 dark:to-purple-900/40 flex items-center justify-center text-gray-600 dark:text-gray-400 text-xs font-black">6</span>
                        Learning Journey — Roadmap
                    </h2>
                    <span class="text-xs text-gray-400">Tepat 4 step — Step 4 selalu aktif/terkini</span>
                </div>

                <div class="space-y-4">
                    @foreach ($roadmapData as $rIdx => $step)
                        @php $rc = $roadmapColors[$rIdx]; @endphp
                        <div class="{{ $rc['bg'] }} rounded-2xl p-5 border {{ $rc['border'] }} space-y-3">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-black {{ $rc['text'] }} uppercase tracking-widest">
                                    Step {{ $rIdx + 1 }}{{ $rIdx === 3 ? '  ✦ Terkini (Selalu Aktif)' : '' }}
                                </span>
                            </div>
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
                                          placeholder="Jelaskan apa yang dipelajari pada tahap ini..."
                                          class="w-full px-4 py-2.5 rounded-xl border-2 border-white/70 dark:border-slate-600 bg-white dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm resize-none">{{ old('roadmap.'.$rIdx.'.desc', $step['desc']) }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ── Submit ───────────────────────────────────────────────────────── --}}
            <div class="flex gap-4 pt-2 pb-8">
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
// ── Avatar Preview ────────────────────────────────────────────────────────────
const avatarInput   = document.getElementById('avatar-input');
const avatarPreview = document.getElementById('avatar-preview');

avatarInput?.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
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
});

// ── Generic Row Removal ───────────────────────────────────────────────────────
function removeRow(btn, containerId) {
    const container = document.getElementById(containerId);
    const rows = container.querySelectorAll('[class*="-row"]');
    if (rows.length <= 1) { alert('Minimal harus ada 1 item.'); return; }
    btn.closest('[class*="-row"]').remove();
    reIndexRows(container);
}

function reIndexRows(container) {
    // Re-index experience rows
    container.querySelectorAll('.experience-row').forEach((row, i) => {
        row.querySelectorAll('[name]').forEach(input => {
            input.name = input.name.replace(/\[experience\]\[\d+\]/, `[experience][${i}]`);
        });
    });
    // Re-index skill/interest rows (flat arrays — no index needed)
}

// ── Experience ────────────────────────────────────────────────────────────────
function addExperience() {
    const container = document.getElementById('experience-container');
    const idx = container.querySelectorAll('.experience-row').length;
    const div = document.createElement('div');
    div.className = 'flex gap-2 items-start experience-row';
    div.innerHTML = `
        <div class="flex-1 grid grid-cols-2 gap-2">
            <input type="text" name="about[experience][${idx}][title]"
                   placeholder="Jabatan / Posisi"
                   class="px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
            <input type="text" name="about[experience][${idx}][period]"
                   placeholder="Periode"
                   class="px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
        </div>
        <button type="button" onclick="removeRow(this,'experience-container')"
                class="px-3 py-2.5 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-colors shrink-0">✕</button>`;
    container.appendChild(div);
}

// ── Skills ────────────────────────────────────────────────────────────────────
function addSkill() {
    const container = document.getElementById('skills-container');
    const div = document.createElement('div');
    div.className = 'flex gap-2 skill-row';
    div.innerHTML = `
        <input type="text" name="about[skills][]" placeholder="Nama teknologi"
               class="flex-1 px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
        <button type="button" onclick="removeRow(this,'skills-container')"
                class="px-3 py-2 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-colors">✕</button>`;
    container.appendChild(div);
}

// ── Interests ─────────────────────────────────────────────────────────────────
function addInterest() {
    const container = document.getElementById('interests-container');
    const div = document.createElement('div');
    div.className = 'flex gap-2 interest-row';
    div.innerHTML = `
        <input type="text" name="about[interests][]" placeholder="Bidang minat"
               class="flex-1 px-4 py-2.5 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-slate-700 focus:border-emerald-500 outline-none transition-all text-sm">
        <button type="button" onclick="removeRow(this,'interests-container')"
                class="px-3 py-2 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-colors">✕</button>`;
    container.appendChild(div);
}
</script>
@endsection