<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
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
        return Inertia('Course/Create');
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor' => 'nullable|string|max:255',
        ]);

        $course = Course::create($validated);

        return redirect()->route('courses.index')->with('success','Course was created!');
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        return Inertia::render('Course/Show', [
            'course' => $course,
        ]);
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        return Inertia::render('Course/Edit', [
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
            'instructor' => 'nullable|string|max:255',
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
