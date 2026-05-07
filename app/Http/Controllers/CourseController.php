<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index()
    {
        $courses = Course::all();

        return Inertia('Course/Index', [
            'courses' => $courses,
        ]);
    }


    /**
     * Show the form for creating a new course.
     */
    public function create()
    {


        $course_instructors = User::getInstructors()
        ->get()
        ->map(fn ($user) => [
            'id' => $user->id,
            'dasid' => $user->dasid,
            'name' => $user->first_name . ' ' . $user->last_name
        ]);


        return Inertia('Course/Create', ['instructors' => $course_instructors]);
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor' => 'required|exists:users,id',
            'publish_date' => 'required|date',
            'expiration_date' => 'required|date|nullable'
        ]);

        $validated['created_by'] = Auth::id();

        $course = Course::create($validated);

        return redirect()->route('courses.index')->with('success','Course was created!');
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        return Inertia('Course/Show', [
            'course' => $course,
        ]);
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        return Inertia('Course/Edit', [
            'course' => $course,
        ]);
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
    {
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
        $course->delete();

        return redirect()->back()->with(['success' => 'Course deleted successfully!']);
    }
}
