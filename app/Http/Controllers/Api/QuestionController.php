<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return Question::all(); 
    }

    public function store(Request $request)
    {
        $question = Question::create($request->all()); 
        return response()->json($question, 201); 
    }

    public function show($id)
    {
        $question = Question::find($id); 
        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404); 
        }
        return $question; 
    }

    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }
        $question->update($request->all()); 
        return response()->json($question, 200); 
    }

    public function destroy($id)
    {
        $question = Question::find($id);
        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }
        $question->delete(); 
        return response()->json(['message' => 'Question deleted'], 204); 
    }
}
