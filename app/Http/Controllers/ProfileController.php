<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

/**
 * Controller untuk mengelola data profil pengguna.
 * Menggunakan Storage untuk penanganan gambar jika diperlukan.
 */
class ProfileController extends Controller
{
    /**
     * Menampilkan daftar profil.
     */
    public function index()
    {
        $profiles = Profile::latest()->get();
        return view('profiles.index', compact('profiles'));
    }

    /**
     * Menampilkan form buat profil baru (admin).
     */
    public function create()
    {
        return view('admin.profiles.create');
    }

    /**
     * Menyimpan profil baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'detailed_bio' => 'nullable|string',
            'social_links' => 'required|array',
            'social_links.*' => 'nullable|url',
        ]);

        Profile::create($validated);

        return redirect()->route('profiles.index')
                        ->with('success', 'Profil berhasil dibuat.');
    }

    /**
     * Menampilkan profil spesifik.
     */
    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }

    /**
     * Menampilkan form edit profil.
     */
    public function edit(Profile $profile)
    {
        return view('admin.profiles.edit', compact('profile'));
    }

    /**
     * Update profil.
     */
    public function update(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'detailed_bio' => 'nullable|string',
            'social_links' => 'required|array',
            'social_links.*' => 'nullable|url',
        ]);

        $profile->update($validated);

        return redirect()->route('profiles.index')
                        ->with('success', 'Profil berhasil diupdate.');
    }

    /**
     * Hapus profil.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();

        return redirect()->route('profiles.index')
                        ->with('success', 'Profil berhasil dihapus.');
    }
}

