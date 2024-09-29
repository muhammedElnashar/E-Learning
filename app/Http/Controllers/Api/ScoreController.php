<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        return Score::all();
    }

    public function store(Request $request)
    {
        $score = Score::create($request->all());
        return response()->json($score, 201);
    }

    public function show($id)
    {
        $score = Score::find($id);
        if (!$score) {
            return response()->json(['message' => 'Score not found'], 404);
        }
        return $score;
    }

    public function update(Request $request, $id)
    {
        $score = Score::find($id);
        if (!$score) {
            return response()->json(['message' => 'Score not found'], 404);
        }
        $score->update($request->all());
        return response()->json($score, 200);
    }

    public function destroy($id)
    {
        $score = Score::find($id);
        if (!$score) {
            return response()->json(['message' => 'Score not found'], 404);
        }
        $score->delete(); // Delete score
        return response()->json(['message' => 'Score deleted'], 204);
    }
}
