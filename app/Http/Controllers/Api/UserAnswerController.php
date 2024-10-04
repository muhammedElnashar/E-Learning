<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserAnswer;
use Illuminate\Http\Request;

class UserAnswerController extends Controller
{
    public function index()
    {
        return UserAnswer::all();
    }

    public function store(Request $request)
    {
        $userAnswer = UserAnswer::create($request->all());
        return response()->json($userAnswer, 201);
    }

    public function show($id)
    {
        $userAnswer = UserAnswer::find($id);
        if (!$userAnswer) {
            return response()->json(['message' => 'User answer not found'], 404);
        }
        return $userAnswer;
    }

    public function update(Request $request, $id)
    {
        $userAnswer = UserAnswer::find($id);
        if (!$userAnswer) {
            return response()->json(['message' => 'User answer not found'], 404);
        }
        $userAnswer->update($request->all());
        return response()->json($userAnswer, 200);
    }

    public function destroy($id)
    {
        $userAnswer = UserAnswer::find($id);
        if (!$userAnswer) {
            return response()->json(['message' => 'User answer not found'], 404);
        }
        $userAnswer->delete();
        return response()->json(['message' => 'User answer deleted'], 204);
    }
}

