<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Controller untuk mengelola proyek portfolio.
 * Penanganan upload gambar menggunakan Laravel Storage (disk public).
 */
class ProjectController extends Controller
{
    /**
     * Menampilkan daftar proyek.
     */
    public function index()
    {
        $projects = Project::with('profile')->latest()->paginate(9);
        return view('projects.index', compact('projects'));
    }

    /**
     * Menampilkan form buat proyek baru.
     */
    public function create()
    {
        $profiles = Profile::pluck('name', 'id');
        return view('admin.projects.create', compact('profiles'));
    }

    /**
     * Menyimpan proyek baru dengan gambar.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // 2MB
            'tech_stack' => 'required|array',
            'tech_stack.*' => 'string|max:50',
            'live_link' => 'nullable|url',
            'github_link' => 'nullable|url',
            'date' => 'required|date',
            'profile_id' => 'nullable|exists:profiles,id',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()->route('projects.index')
                        ->with('success', 'Proyek berhasil dibuat.');
    }

    /**
     * Menampilkan proyek spesifik.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Menampilkan form edit proyek.
     */
    public function edit(Project $project)
    {
        $profiles = Profile::pluck('name', 'id');
        return view('admin.projects.edit', compact('project', 'profiles'));
    }

    /**
     * Update proyek, handle gambar lama/baru.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'tech_stack' => 'required|array',
            'tech_stack.*' => 'string|max:50',
            'live_link' => 'nullable|url',
            'github_link' => 'nullable|url',
            'date' => 'required|date',
            'profile_id' => 'nullable|exists:profiles,id',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($project->image_path) {
                Storage::disk('public')->delete($project->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('projects.index')
                        ->with('success', 'Proyek berhasil diupdate.');
    }

    /**
     * Hapus proyek dan gambar.
     */
    public function destroy(Project $project)
    {
        if ($project->image_path) {
            Storage::disk('public')->delete($project->image_path);
        }
        $project->delete();

        return redirect()->route('projects.index')
                        ->with('success', 'Proyek berhasil dihapus.');
    }
}

