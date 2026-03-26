<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // ─── PUBLIC ────────────────────────────────────────────────────────────────

    public function index()
    {
        $projects = Project::with('profile')->latest()->paginate(9);

        if (request()->is('admin/*')) {
            return view('admin.projects.index', compact('projects'));
        }

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    // ─── ADMIN ─────────────────────────────────────────────────────────────────

    public function create()
    {
        $profiles = Profile::pluck('name', 'id');
        return view('admin.projects.create', compact('profiles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:2048',
            'tech_stack'  => 'required|array',
            'tech_stack.*'=> 'string|max:50',
            'live_link'   => 'nullable|url',
            'github_link' => 'nullable|url',
            'date'        => 'required|date',
            'profile_id'  => 'nullable|exists:profiles,id',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('projects', 'public');
        }

        unset($validated['image']);
        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil dibuat.');
    }

    public function edit(Project $project)
    {
        $profiles = Profile::pluck('name', 'id');
        return view('admin.projects.edit', compact('project', 'profiles'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:2048',
            'tech_stack'  => 'required|array',
            'tech_stack.*'=> 'string|max:50',
            'live_link'   => 'nullable|url',
            'github_link' => 'nullable|url',
            'date'        => 'required|date',
            'profile_id'  => 'nullable|exists:profiles,id',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image_path) {
                Storage::disk('public')->delete($project->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('projects', 'public');
        }

        unset($validated['image']);
        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        if ($project->image_path) {
            Storage::disk('public')->delete($project->image_path);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }
}