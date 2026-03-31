<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::latest()->get();
        return view('admin.profiles.index', compact('profiles'));
    }

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

        if ($request->hasFile('avatar')) {
            $validated['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }

        // social links
        $validated['social_links'] = array_filter($validated['social_links'] ?? []);
        unset($validated['avatar']);

        // About data
        $validated['about_data']    = $this->processAboutData($request);
        // Roadmap items
        $validated['roadmap_items'] = $this->processRoadmapItems($request);

        // Jika ini profil pertama, jadikan aktif secara otomatis
        if (Profile::count() === 0) {
            $validated['is_active'] = true;
        }

        Profile::create($validated);

        return redirect()->route('admin.profiles.index')
            ->with('success', 'Profil berhasil dibuat.');
    }

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

        if ($request->hasFile('avatar')) {
            if ($profile->avatar_path) {
                Storage::disk('public')->delete($profile->avatar_path);
            }
            $validated['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }

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
        if ($profile->avatar_path) {
            Storage::disk('public')->delete($profile->avatar_path);
        }
        $profile->delete();

        if ($profile->is_active) {
            Profile::latest()->first()?->update(['is_active' => true]);
        }

        return redirect()->route('admin.profiles.index')
            ->with('success', 'Profil berhasil dihapus.');
    }

    public function setActive(Profile $profile)
    {
        $profile->setAsActive();

        return redirect()->back()
            ->with('success', "Profil \"{$profile->name}\" kini ditampilkan di halaman portfolio.");
    }

    // Private Helpers

    private function processAboutData(Request $request): array
    {
        $about = $request->input('about', []);

        // Experience
        $experience = collect($about['experience'] ?? [])
            ->filter(fn($e) => !empty(trim($e['title'] ?? '')))
            ->values()
            ->map(fn($e) => [
                'title'  => trim($e['title']  ?? ''),
                'period' => trim($e['period'] ?? ''),
            ])
            ->all();

        // Education
        $education = [
            'degree'      => trim($about['education']['degree']      ?? ''),
            'institution' => trim($about['education']['institution']  ?? ''),
        ];

        // Skills + Interests
        $skills    = array_values(array_filter(array_map('trim', $about['skills']    ?? [])));
        $interests = array_values(array_filter(array_map('trim', $about['interests'] ?? [])));

        // Stats (always 3)
        $stats = [];
        foreach (range(0, 2) as $i) {
            $stats[] = [
                'number' => trim($about['stats'][$i]['number'] ?? ''),
                'label'  => trim($about['stats'][$i]['label']  ?? ''),
            ];
        }

        return compact('experience', 'education', 'skills', 'interests', 'stats');
    }

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