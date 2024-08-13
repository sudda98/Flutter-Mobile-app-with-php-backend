<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    public function index()
    {
        return Course::all();
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Course::class);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        $course = $request->user()->courses()->create($validatedData);

        return response()->json($course, 201);
    }

    public function show(Course $course)
    {
        return $course;
    }

    public function update(Request $request, Course $course)
    {
        Gate::authorize('update', $course);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $course->update($validatedData);

        return response()->json($course);
    }

    public function destroy(Course $course)
    {
        Gate::authorize('delete', $course);

        $course->delete();

        return response()->json(['message' => 'Course deleted']);
    }

    public function enroll(Course $course)
    {
        $course->students()->attach(auth()->id());

        return response()->json(['message' => 'Enrolled successfully']);
    }

    public function unenroll(Course $course)
    {
        $course->students()->detach(auth()->id());

        return response()->json(['message' => 'Unenrolled successfully']);
    }
}
