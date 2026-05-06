<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function index()
    {
        try {
            $projects = Project::with('profile')->latest()->get();

            return response()->json([
                'success' => true,
                'message' => 'Daftar proyek berhasil diambil',
                'data'    => $projects,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error fetching projects: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server saat mengambil data.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_id'   => 'required|exists:profiles,id',
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'tech_stack'   => 'required|array|min:1',
            'tech_stack.*' => 'required|string',
            'live_link'    => 'nullable|url',
            'github_link'  => 'nullable|url',
            'date'         => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        try {
            // FIX: gunakan validated() bukan $request->all()
            // agar tidak ada field liar yang masuk ke DB (mass assignment protection)
            $project = Project::create($validator->validated());

            return response()->json([
                'success' => true,
                'message' => 'Proyek berhasil dibuat',
                'data'    => $project,
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error creating project: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server saat menyimpan data.',
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $project = Project::with('profile')->find($id);

            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Proyek tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Detail proyek berhasil diambil',
                'data'    => $project,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error fetching project detail: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server saat mengambil detail data.',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $project = Project::find($id);

            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Proyek tidak ditemukan',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'profile_id'   => 'required|exists:profiles,id',
                'title'        => 'required|string|max:255',
                'description'  => 'required|string',
                'tech_stack'   => 'required|array|min:1',
                'tech_stack.*' => 'required|string',
                'live_link'    => 'nullable|url',
                'github_link'  => 'nullable|url',
                'date'         => 'required|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            $project->update($validator->validated());

            return response()->json([
                'success' => true,
                'message' => 'Proyek berhasil diperbarui',
                'data'    => $project->fresh(),
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error updating project: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server saat memperbarui data.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $project = Project::find($id);

            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Proyek tidak ditemukan',
                ], 404);
            }

            $project->delete();

            return response()->json([
                'success' => true,
                'message' => 'Proyek berhasil dihapus',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error deleting project: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server saat menghapus data.',
            ], 500);
        }
    }
}