<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses, 200);
    }
    public function store(Request $request)
    {
        $validationRules = [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required_if:is_free,false|integer|min:0',
            'is_free' => 'required|boolean',
            'instructor_id' => 'required|exists:users,id',
            'course_type' => 'required|in:video,live',
        ];

        if ($request->course_type == 'live') {
            $validationRules = array_merge($validationRules, [
                'live_platform' => 'required|string|max:255',
                'live_link' => 'required|url',
                'live_schedule' => 'required|date',
                'live_details' => 'required|string',
            ]);
        } else {
            $validationRules = array_merge($validationRules, [
                'playlist_id' => 'required|exists:playlists,id',
            ]);
        }

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // $role_id =Auth::user()->role_id;
        // if($role_id!=1||$role_id!=4||$role_id!=3){
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }
        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->is_free ? 0 : $request->price,
            'is_free' => $request->is_free,
            'instructor_id' => $request->instructor_id,
            'playlist_id' => $request->playlist_id ?? null,
            'thumbnail' => $request->thumbnail ?? 'https://campustechnology.com/-/media/EDU/CampusTechnology/2019-Images/20191209online.jpg',
            'course_type' => $request->course_type,
            'live_platform' => $request->live_platform ?? null,
            'live_link' => $request->live_link ?? null,
            'live_schedule' => $request->live_schedule ?? null,
            'live_details' => $request->live_details ?? null,
        ]);

        return response()->json($course, 201);
    }


    public function show($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $enrollments = Enrollment::where('course_id', $id)->get();
        $course->enrollments = $enrollments;

        return response()->json($course, 200);
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $validationRules = [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required',
            'price' => 'required_if:is_free,false|integer|min:0',
            'is_free' => 'sometimes|required|boolean',
            'instructor_id' => 'sometimes|required|exists:users,id',
            'playlist_id' => 'sometimes|required|exists:playlists,id',
        ];

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $course->update($request->all());

        return response()->json($course, 200);
    }

    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Course deleted successfully'], 200);
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $courses = Course::query()
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->orWhere('price', $keyword)
            ->get();

        return response()->json($courses);
    }


}
