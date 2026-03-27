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

        // Upload avatar jika ada
        if ($request->hasFile('avatar')) {
            $validated['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }

        $validated['social_links'] = array_filter($validated['social_links'] ?? []);
        unset($validated['avatar']);

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

        $validated['social_links'] = array_filter($validated['social_links'] ?? []);
        unset($validated['avatar']);

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

        return redirect()->route('admin.profiles.index')
            ->with('success', 'Profil berhasil dihapus.');
    }
}