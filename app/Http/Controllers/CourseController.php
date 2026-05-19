<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;


class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index(Request $request)
    {
        

        $filters =  [
            'showDeleted' => $request->boolean('showDeleted') ?? null,
            'search' => $request->string('search') ?? null,
            'instructor' => $request->integer('instructor') ?? null,
            'author' => $request->integer('author') ?? null
        ];


        

        $courses = Course::with('createdby:id,first_name,last_name')
                    ->Filter($filters)
                    ->paginate(10)
                    ->withQueryString();

        $instructors =  User::getInstructors()
            ->orderBy('first_name', 'ASC')
            ->orderBy('last_name', 'ASC')
            ->get(['id','first_name','last_name']);

        $authors = User::whereHas('courses') 
            ->orderBy('first_name', 'ASC')
            ->orderBy('last_name', 'ASC')
            ->get(['id', 'first_name', 'last_name']);


        return Inertia('Course/Index', [
            'courses' => $courses,
            'instructors' => $instructors,
            'authors' => $authors,
            'filters' => $filters
        ]);
    }


    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        if (Gate::inspect('create', Course::class)->denied()) {
            return redirect()->route('courses.index')->with('error', 'You are not allowed.');
        }
    
        $course_instructors = User::getInstructors()
            ->get()
            ->map(fn ($user) => [
                'id' => $user->id,
                'dasid' => $user->dasid,
                'name' => $user->first_name . ' ' . $user->last_name
            ]);
    
        return Inertia('Course/Create', [
            'instructors' => $course_instructors,
            'projects' => Project::orderBy('title','ASC')->get()
        ]);
    }

    public function createFromProject(Project $project)
    {
        if (Gate::inspect('create', Course::class)->denied()) {
            return redirect()->route('courses.index')->with('error', 'You are not allowed.');
        }
    
        $course_instructors = User::getInstructors()
            ->get()
            ->map(fn ($user) => [
                'id' => $user->id,
                'dasid' => $user->dasid,
                'name' => $user->first_name . ' ' . $user->last_name
            ]);
    
        return Inertia('Course/Create', [
            'instructors' => $course_instructors,
            'projects' => Project::orderBy('title','ASC')->get(),
            'project' => $project // This will be the Project model or null
        ]);
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {

        if (Gate::inspect('create', course::class)->denied()) {
            return redirect()->route('courses.index')->with('error', 'You are not allowed to edit someone else course.');
        }



        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'instructor' => 'required|exists:users,id',
            'publish_date' => 'required|date',
            'expiration_date' => 'required|date|nullable',
            'project_id' => 'required|exists:projects,id'
        ]);

        $validated['created_by'] = Auth::id();

        $course = Course::create($validated);
        return redirect()->back()->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {

        $creatorName = $course->createdby;

        return Inertia('Course/Show', [
            'course' => $course,
        ]);
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {


        if (Gate::inspect('update', $course)->denied()) {
            return redirect()->route('courses.index')->with('error', 'You are not allowed to edit someone else course.');
        }

        $course_instructors = User::getInstructors()
            ->get()
            ->map(fn ($user) => [
                'id' => $user->id,
                'dasid' => $user->dasid,
                'name' => $user->first_name . ' ' . $user->last_name
            ]);

        return Inertia('Course/Edit', [
            'course' => $course,
            'instructors' => $course_instructors,
            'projects' => Project::orderBy('title','ASC')->get(),
        ]);
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
    {

        if (Gate::inspect('update', $course)->denied()) {
            return redirect()->route('courses.index')->with('error', 'You are not allowed to edit someone else Course.');
        }

        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'instructor' => 'nullable|string|max:255',
            'publish_date' => 'required|date',
            'expiration_date' => 'required|date|nullable'
        ]);

        $course->update($validated);

        return redirect()->back()->with(['success' => 'Course updated successfully!']);
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {

        if (Gate::inspect('delete', $course)->denied()) {
            return redirect()->route('courses.index')->with('error', 'You are not allowed to delete someone else Course!');
        }

        $course->deleteOrFail();

        return redirect()->back()->with(['success' => 'Course deleted successfully!']);
    }
}
