<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // List all courses
    public function index()
    {
        return Course::all();
    }

    // Store a new course (only accessible by instructors)
    public function store(Request $request)
    {
        $this->authorize('create', Course::class); // Authorization check

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        $course = $request->user()->courses()->create($validatedData);

        return response()->json($course, 201);
    }

    // Show a specific course
    public function show(Course $course)
    {
        return $course;
    }

    // Update a course (only accessible by instructors)
    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course); // Authorization check

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $course->update($validatedData);

        return response()->json($course);
    }

    // Delete a course (only accessible by instructors)
    public function destroy(Course $course)
    {
        $this->authorize('delete', $course); // Authorization check

        $course->delete();

        return response()->json(['message' => 'Course deleted']);
    }

    // Enroll in a course (only accessible by students)
    public function enroll(Course $course)
    {
        $course->students()->attach(auth()->id());

        return response()->json(['message' => 'Enrolled successfully']);
    }

    // Unenroll from a course (only accessible by students)
    public function unenroll(Course $course)
    {
        $course->students()->detach(auth()->id());

        return response()->json(['message' => 'Unenrolled successfully']);
    }
}
