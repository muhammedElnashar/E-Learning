<?php

namespace App\Http\Controllers\Api;

use App\Models\CourseRating;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseRatingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'rating' => 'required|min:1|max:5',
        ]);
        
        $user = Auth::user();
        $course = Course::findorFail($validated['course_id']);
        if (!$request->user()->payments()->where('course_id', $request->course_id)->exists()) {
            return response()->json(['error' => 'You are not enrolled in this course'], 403);
        }
        if ($course->instructor_id == $user->id) {
            return response()->json(['error' => 'You cannot rate your own course'], 403);
        }
        if ($course->ratings()->where('user_id', $user->id)->exists()) {
            return response()->json(['error' => 'You have already rated this course'], 403);
        }
        try {
            $rating = CourseRating::create([
                'user_id' => $user->id,
                'course_id' => $validated['course_id'],
                'rating' => $validated['rating'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 500);
        }

        return response()->json($rating, 201);
    }

    public function index($courseId)
    {
        $ratings = CourseRating::where('course_id', $courseId)->get();

        return response()->json($ratings);
    }
}
