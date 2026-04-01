<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * ProfileController (Admin): CRUD lengkap untuk data profil portfolio.
 *
 * Setiap profil menyimpan:
 * - Data dasar: nama, avatar, bio singkat, bio detail, social links
 * - Data about: experience, education, skills, interests, stats (via about_data JSON)
 * - Data roadmap: 4 tahapan learning journey (via roadmap_items JSON)
 *
 * Profil yang di-set aktif akan ditampilkan di halaman publik (homepage).
 */
class ProfileController extends Controller
{
    // Tampilkan semua profil, diurutkan terbaru.
    public function index()
    {
        $profiles = Profile::latest()->get();
        return view('admin.profiles.index', compact('profiles'));
    }

    // Form tambah profil baru.
    public function create()
    {
        return view('admin.profiles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'avatar'         => 'nullable|image|max:2048',
            'bio'            => 'required|string',
            'detailed_bio'   => 'nullable|string',
            'social_links'   => 'nullable|array',
            'social_links.*' => 'nullable|url',
        ]);

        // Simpan avatar jika ada upload, ke disk 'public' (storage/app/public/avatars)
        if ($request->hasFile('avatar')) {
            $validated['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }

        // Buang social link yang kosong, hapus key 'avatar' dari validated (sudah diproses)
        $validated['social_links'] = array_filter($validated['social_links'] ?? []);
        unset($validated['avatar']);

        // Proses data about & roadmap dari input (nested array dari form)
        $validated['about_data']    = $this->processAboutData($request);
        $validated['roadmap_items'] = $this->processRoadmapItems($request);

        // Profil pertama otomatis jadi aktif agar langsung tampil di homepage
        if (Profile::count() === 0) {
            $validated['is_active'] = true;
        }

        Profile::create($validated);

        return redirect()->route('admin.profiles.index')
            ->with('success', 'Profil berhasil dibuat.');
    }

    // Form edit profil (data profil yang sudah tersimpan di-pass ke view).
    public function edit(Profile $profile)
    {
        return view('admin.profiles.edit', compact('profile'));
    }

    public function update(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'avatar'         => 'nullable|image|max:2048',
            'bio'            => 'required|string',
            'detailed_bio'   => 'nullable|string',
            'social_links'   => 'nullable|array',
            'social_links.*' => 'nullable|url',
        ]);

        // Ganti avatar lama dengan yang baru jika ada upload
        if ($request->hasFile('avatar')) {
            if ($profile->avatar_path) {
                Storage::disk('public')->delete($profile->avatar_path);
            }
            $validated['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }

        // Hapus avatar jika user centang checkbox 'remove_avatar'
        if ($request->boolean('remove_avatar') && $profile->avatar_path) {
            Storage::disk('public')->delete($profile->avatar_path);
            $validated['avatar_path'] = null;
        }

        $validated['social_links']  = array_filter($validated['social_links'] ?? []);
        unset($validated['avatar']);

        $validated['about_data']    = $this->processAboutData($request);
        $validated['roadmap_items'] = $this->processRoadmapItems($request);

        $profile->update($validated);

        return redirect()->route('admin.profiles.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function destroy(Profile $profile)
    {
        // Hapus avatar dari storage sebelum hapus record
        if ($profile->avatar_path) {
            Storage::disk('public')->delete($profile->avatar_path);
        }
        $profile->delete();

        // Jika profil yang dihapus adalah yang aktif, aktifkan profil lain
        if ($profile->is_active) {
            Profile::latest()->first()?->update(['is_active' => true]);
        }

        return redirect()->route('admin.profiles.index')
            ->with('success', 'Profil berhasil dihapus.');
    }

    // Set profil ini sebagai profil aktif yang tampil di homepage.
    public function setActive(Profile $profile)
    {
        $profile->setAsActive();

        return redirect()->back()
            ->with('success', "Profil \"{$profile->name}\" kini ditampilkan di halaman portfolio.");
    }

    // Private Helpers

    /**
     * Ambil dan bersihkan data "About" dari request form.
     * @return array{experience: array, education: array, skills: array, interests: array, stats: array}
     */
    private function processAboutData(Request $request): array
    {
        $about = $request->input('about', []);

        // Experience: filter baris yang title-nya kosong
        $experience = collect($about['experience'] ?? [])
            ->filter(fn($e) => !empty(trim($e['title'] ?? '')))
            ->values()
            ->map(fn($e) => [
                'title'  => trim($e['title']  ?? ''),
                'period' => trim($e['period'] ?? ''),
            ])
            ->all();

        // Education: dua field statis
        $education = [
            'degree'      => trim($about['education']['degree']      ?? ''),
            'institution' => trim($about['education']['institution']  ?? ''),
        ];

        // Skills & Interests: flat array, buang yang kosong lalu re-index
        $skills    = array_values(array_filter(array_map('trim', $about['skills']    ?? [])));
        $interests = array_values(array_filter(array_map('trim', $about['interests'] ?? [])));

        // Stats: selalu 3 item
        $stats = [];
        foreach (range(0, 2) as $i) {
            $stats[] = [
                'number' => trim($about['stats'][$i]['number'] ?? ''),
                'label'  => trim($about['stats'][$i]['label']  ?? ''),
            ];
        }

        return compact('experience', 'education', 'skills', 'interests', 'stats');
    }

    /**
     * Ambil data Learning Journey dari request form.
     * Selalu 4 item, step ke-4 selalu bertanda aktif/terkini.
     *
     * @return array 4 item roadmap dengan keys: title, year, desc
     */
    private function processRoadmapItems(Request $request): array
    {
        $roadmap = $request->input('roadmap', []);
        $result  = [];

        foreach (range(0, 3) as $i) {
            $result[] = [
                'title' => trim($roadmap[$i]['title'] ?? ''),
                'year'  => trim($roadmap[$i]['year']  ?? ''),
                'desc'  => trim($roadmap[$i]['desc']  ?? ''),
            ];
        }

        return $result;
    }
}