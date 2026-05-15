<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{

    public function index()
    {

        $projects = Project::query()
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return inertia('Project/Index', [
            'projects' => $projects,
            'filters' => [],
            'user' => auth()->user(),
        ]);
    }


    public function create()
    {
        return inertia('Project/Create', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {


        $validated = $request->validated();

        $project = Project::create([
            'title' => $validated['title'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('projects.index')->with('success', 'Project was created!');
    }

    public function show(Project $project)
    {


        return inertia('Project/Show', [
            'project' => $project,
            'user' => auth()->user(),
        ]);
    }


    public function edit(Project $project)
    {


        return inertia('Project/Edit', [
            'project' => $project,
            'user' => auth()->user(),
        ]);
    }


    public function update(UpdateProjectRequest $request, Project $project)
    {


        $validated = $request->validated();

        $project->update([
            'title' => $validated['title'],
        ]);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }


    public function destroy(Project $project)
    {

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project archived successfully!');
    }
}

