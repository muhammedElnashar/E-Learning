<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\ExamImport;
use App\Imports\TestImport;
use App\Models\Test;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    public function index()
    {
        return Test::all();
    }

    public function store(Request $request)
    {
        $test = Test::create($request->all());
        return response()->json($test, 201);
    }

    public function show($id)
    {
        $test = Test::find($id);
        if (!$test) {
            return response()->json(['message' => 'Test not found'], 404);
        }
        return $test;
    }

    public function update(Request $request, $id)
    {
        $test = Test::find($id);
        if (!$test) {
            return response()->json(['message' => 'Test not found'], 404);
        }
        $test->update($request->all());
        return response()->json($test, 200);
    }

    public function destroy($id)
    {
        $test = Test::find($id);
        if (!$test) {
            return response()->json(['message' => 'Test not found'], 404);
        }
        $test->delete();
        return response()->json(['message' => 'Test deleted'], 204);
    }

}
