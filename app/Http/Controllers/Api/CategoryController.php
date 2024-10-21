<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $category=Category::all();
        return response()->json($category);

    }


    public function store(Request $request)
    {
        $validationRules = [
            'name' => 'required|string|max:255',
        ];
        $this->validate($request, $validationRules);
        $category=Category::create($request->all());
        return response()->json([$category,'message' => 'Category Created successfully']);
    }


    public function show(string $id)
    {
        $category=Category::findOrFail($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category);
    }

    public function update(Request $request, string $id)
    {
        $category=Category::findOrFail($id);
        $validationRules = [
            'name' => 'sometimes|string|max:255',
        ];
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $this->validate($request, $validationRules);
        $category->update($request->all());
        return response()->json([$category,'message' => 'Category Updated successfully']);
    }

    public function destroy(string $id)
    {
        $category=Category::findOrFail($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
