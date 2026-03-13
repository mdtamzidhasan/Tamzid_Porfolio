<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller {
    public function index() {
        $projects = Project::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }
    public function create() { return view('admin.projects.create'); }

    public function store(Request $request) {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'long_description' => 'nullable|string',
            'category'         => 'required|string',
            'tech_stack'       => 'required|string',
            'live_url'         => 'nullable|url',
            'github_url'       => 'nullable|url',
            'is_featured'      => 'boolean',
            'sort_order'       => 'nullable|integer',
            'is_active'        => 'boolean',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }
        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project created!');
    }

    public function edit(Project $project) { return view('admin.projects.edit', compact('project')); }

    public function update(Request $request, Project $project) {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'long_description' => 'nullable|string',
            'category'         => 'required|string',
            'tech_stack'       => 'required|string',
            'live_url'         => 'nullable|url',
            'github_url'       => 'nullable|url',
            'is_featured'      => 'boolean',
            'sort_order'       => 'nullable|integer',
            'is_active'        => 'boolean',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);
        if ($request->hasFile('image')) {
            if ($project->image) Storage::disk('public')->delete($project->image);
            $data['image'] = $request->file('image')->store('projects', 'public');
        }
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated!');
    }

    public function destroy(Project $project) {
        if ($project->image) Storage::disk('public')->delete($project->image);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted!');
    }
}