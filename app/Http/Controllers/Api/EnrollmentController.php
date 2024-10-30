<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Course;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::all();
        return response()->json($enrollments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $enrollment = Enrollment::where('user_id', $request->user_id)
        ->where('course_id', $request->course_id)
        ->first();
        if (isset($enrollment)) {
            return response()->json(['enrolled' => true]);
        }
        else {
            return response()->json(['enrolled' => false]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function checkEnrollForTeacherCourses(Request $request){
        try {
            $isEnrolled = Enrollment::where('user_id', $request->user()->id)
                ->whereHas('course', function ($query) use ($request) {
                    $query->where('instructor_id', $request->teacher_id);
                })
                ->exists();
            
            return response()->json(['enrolled' => $isEnrolled]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    
}
