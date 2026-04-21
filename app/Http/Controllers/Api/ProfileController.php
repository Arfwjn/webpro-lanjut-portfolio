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
        if (!$profile) return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan'], 404);
        return response()->json(['success' => true, 'data' => $profile], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $profile = Profile::find($id);
            if (!$profile) return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan'], 404);

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|required|string|max:255',
                'bio' => 'sometimes|required|string',
                'avatar' => 'nullable|image|max:2048',
                'social_links' => 'nullable|array',
                'about_roadmap' => 'nullable|array',
                'is_active' => 'sometimes|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }

            $data = $request->except('avatar');

            // Penanganan unggahan avatar baru
            if ($request->hasFile('avatar')) {
                if ($profile->avatar) {
                    Storage::disk('public')->delete($profile->avatar);
                }
                $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
            }

            $profile->update($data);

            return response()->json(['success' => true, 'message' => 'Profil diperbarui', 'data' => $profile], 200);

        } catch (\Exception $e) {
            Log::error('API Profile Update Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan server'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
