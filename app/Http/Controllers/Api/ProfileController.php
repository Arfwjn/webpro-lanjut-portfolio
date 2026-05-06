<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        try {
            $profiles = Profile::all();
            return response()->json(['success' => true, 'data' => $profiles], 200);
        } catch (\Exception $e) {
            Log::error('API Profile Index Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function show($id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $profile], 200);
    }

    /**
     * Buat profil baru via API.
     * Profil pertama otomatis di-set aktif.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'         => 'required|string|max:255',
                'bio'          => 'required|string',
                'detailed_bio' => 'nullable|string',
                'avatar'       => 'nullable|image|max:2048',
                'social_links' => 'nullable|array',
                'is_active'    => 'sometimes|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }

            $data = $validator->validated();
            unset($data['avatar']);

            if ($request->hasFile('avatar')) {
                $data['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
            }

            // Profil pertama otomatis aktif
            if (Profile::count() === 0) {
                $data['is_active'] = true;
            }

            $profile = Profile::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil dibuat',
                'data'    => $profile,
            ], 201);

        } catch (\Exception $e) {
            Log::error('API Profile Store Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $profile = Profile::find($id);

            if (!$profile) {
                return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan'], 404);
            }

            $validator = Validator::make($request->all(), [
                'name'         => 'sometimes|required|string|max:255',
                'bio'          => 'sometimes|required|string',
                'detailed_bio' => 'nullable|string',
                'avatar'       => 'nullable|image|max:2048',
                'social_links' => 'nullable|array',
                'about_data'   => 'nullable|array',
                'roadmap_items'=> 'nullable|array',
                'is_active'    => 'sometimes|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }

            // Ambil data tervalidasi, buang key 'avatar' (diproses terpisah)
            $data = $validator->validated();
            unset($data['avatar']);

            if ($request->hasFile('avatar')) {
                if ($profile->avatar_path) {
                    Storage::disk('public')->delete($profile->avatar_path);
                }
                $data['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
            }

            $profile->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Profil diperbarui',
                'data'    => $profile->fresh(),
            ], 200);

        } catch (\Exception $e) {
            Log::error('API Profile Update Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $profile = Profile::find($id);

            if (!$profile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profil tidak ditemukan',
                ], 404);
            }

            // Hapus avatar dari storage sebelum hapus record
            if ($profile->avatar_path) {
                Storage::disk('public')->delete($profile->avatar_path);
            }

            $profile->delete();

            // Jika profil aktif yang dihapus, aktifkan profil lain
            if ($profile->is_active) {
                Profile::latest()->first()?->update(['is_active' => true]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil dihapus',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error deleting profile: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server saat menghapus data.',
            ], 500);
        }
    }
}