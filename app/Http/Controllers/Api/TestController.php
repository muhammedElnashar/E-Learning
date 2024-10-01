<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use App\Http\Resources\TestResource;
use App\Imports\ExamImport;
use App\Imports\TestImport;
use App\Models\Test;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    public function index()
    {
        return TestResource::collection(Test::all());
    }

    public function store(StoreTestRequest $request)
    {
        $test = Test::create($request->all());
        return response()->json(new TestResource($test), 201);
    }

    public function show($id)
    {
        $test = Test::find($id);
        if (!$test) {
            return response()->json(['message' => 'Test not found'], 404);
        }
        return new TestResource($test);
    }

    public function update(UpdateTestRequest $request, $id)
    {
        $test = Test::find($id);
        if (!$test) {
            return response()->json(['message' => 'Test not found'], 404);
        }
        $test->update($request->all());
        return response()->json(new TestResource($test), 200);
    }

    public function destroy($id)
    {
        $test = Test::find($id);
        if (!$test) {
            return response()->json(['message' => 'Test not found'], 404);
        }
        $test->delete();
        return response()->json([
            'message' => 'Deleted  Successfully',
        ],200);
    }

}
