<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

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
            'bio'            => 'required|string',
            'detailed_bio'   => 'nullable|string',
            'social_links'   => 'nullable|array',
            'social_links.*' => 'nullable|url',
        ]);

        // Bersihkan social_links dari nilai kosong
        $validated['social_links'] = array_filter($validated['social_links'] ?? []);

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
            'bio'            => 'required|string',
            'detailed_bio'   => 'nullable|string',
            'social_links'   => 'nullable|array',
            'social_links.*' => 'nullable|url',
        ]);

        $validated['social_links'] = array_filter($validated['social_links'] ?? []);

        $profile->update($validated);

        return redirect()->route('admin.profiles.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();

        return redirect()->route('admin.profiles.index')
            ->with('success', 'Profil berhasil dihapus.');
    }
}