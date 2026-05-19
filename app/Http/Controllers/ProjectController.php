<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Course;
use Gate;

class ProjectController extends Controller
{

    


    public function index()
    {

        if (Gate::inspect('viewAny', Project::class)->denied()) {
            return redirect()->route('index.index')->with('error', '403 Unauthorized access: Contact your admin!');
        }

        $projects = Project::query()
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return inertia('Project/Index', [
            'projects' => $projects,
            'filters' => []
        ]);
    }


    public function create()
    {

        if (Gate::inspect('create', Project::class)->denied()) {
            return redirect()->route('project.index')->with('error', '403 Unauthorized access: Contact your admin!');
        }

        return inertia('Project/Create', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        if (Gate::inspect('create', Project::class)->denied()) {
            return redirect()->route('index.index')->with('error', '403 Unauthorized access: Contact your admin!');
        }

        $validated = $request->validated();

        $project = Project::create([
            'title' => $validated['title'],
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project was created!');
    }

    public function show(Project $project)
    {

        if (Gate::inspect('view', $project)->denied()) {
            return redirect()->route('index.index')->with('error', '403 Unauthorized access: Contact your admin!');
        }

        $courses = Course::query()
            ->where('project_id', $project->id)
            ->latest('id')
            ->paginate(10);

        return inertia('Project/Show', [
            'project' => $project,
            'user' => auth()->user(),
            'courses' => $courses,
        ]);
    }


    public function edit(Project $project)
    {

        if (Gate::inspect('update', $project)->denied()) {
            return redirect()->route('index.index')->with('error', '403 Unauthorized access: Contact your admin!');
        }


        return inertia('Project/Edit', [
            'project' => $project,
            'user' => auth()->user(),
        ]);
    }


    public function update(UpdateProjectRequest $request, Project $project)
    {

        if (Gate::inspect('update', $project)->denied()) {
            return redirect()->route('index.index')->with('error', '403 Unauthorized access: Contact your admin!');
        }

        $validated = $request->validated();

        $project->update([
            'title' => $validated['title'],
        ]);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }


    public function destroy(Project $project)
    {
        if (Gate::inspect('delete', $project)->denied()) {
            return redirect()->route('index.index')->with('error', '403 Unauthorized access: Contact your admin!');
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project archived successfully!');
    }
}

