<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Enroll the authenticated user in a course.
     */
    public function enroll($id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($id);

        // Check if the user is already enrolled
        if (Enrollment::where('user_id', $user->id)->where('course_id', $course->id)->exists()) {
            return response()->json(['message' => 'You are already enrolled in this course'], 409);
        }

        // Enroll the user in the course
        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        return response()->json(['message' => 'Enrolled successfully'], 200);
    }

    /**
     * Unenroll the authenticated user from a course.
     */
    public function unenroll($id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($id);

        // Check if the user is enrolled in the course
        $enrollment = Enrollment::where('user_id', $user->id)->where('course_id', $course->id)->first();

        if (!$enrollment) {
            return response()->json(['message' => 'You are not enrolled in this course'], 404);
        }

        // Unenroll the user
        $enrollment->delete();

        return response()->json(['message' => 'Unenrolled successfully'], 200);
    }
}
