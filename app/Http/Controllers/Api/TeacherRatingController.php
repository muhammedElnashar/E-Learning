<?php

namespace App\Http\Controllers\Api;

use App\Models\TeacherRating;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherRatingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:users,id',
            'rating' => 'required|between:1,5',
        ]);

        if (!$request->user()->payments()->whereHas('course', function ($query) use ($request) {
            $query->where('instructor_id', $request->teacher_id);
        })->exists()) {
            return response()->json(['error' => 'You are not enrolled in any course by this teacher'], 403);
        }

        if ($request->user()->id == $validated['teacher_id']) {
            return response()->json(['error' => 'You cannot rate yourself'], 403);
        }

        if (TeacherRating::where('user_id', $request->user()->id)
                         ->where('teacher_id', $validated['teacher_id'])
                         ->exists()) {
            return response()->json(['error' => 'You have already rated this teacher'], 403);
        }

        try {
            $rating = TeacherRating::create([
                'user_id' => $request->user()->id,
                'teacher_id' => $validated['teacher_id'],
                'rating' => $validated['rating'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }

        return response()->json($rating, 201);
    }

    public function index($teacherId)
    {
        $ratings = TeacherRating::where('teacher_id', $teacherId)->get();
        return response()->json($ratings);
    }
}
