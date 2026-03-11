<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = $request->user()->categories()->latest()->get();
        return response()->json($categories);
    }
    public function show(Request $request, $id)
    {
        $category = $request->user()->categories()->findOrFail($id);
        return response()->json($category);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => [
                'required',
                'max:250',
                'string',
                Rule::unique('categories')->where('user_id', $request->user()->id)
            ]
        ]);

        $category = $request->user()->categories()->create($fields);


        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'name' => [
                'required',
                'max:250',
                'string',
                Rule::unique('categories')->where('user_id', $request->user()->id)->ignore($id)
            ]
        ]);
        $category = $request->user()->categories()->findOrFail($id);
        $category->update($fields);

        return response()->json([
            'message' => 'Update successfully',
            'data' => $category
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $category = $request->user()->categories()->findOrFail($id);
        $category->delete();
        return response()->json([
            'message' => 'Delete successfully',
            'data' => $category
        ], 200);
    }
}
