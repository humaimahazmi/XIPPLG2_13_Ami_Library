<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index()
    {
            $categories = Category::all();

            return response()->json([
                'status' => 200,
                'message' => 'Categories retrieved successfully.',
                'data' => $categories
            ], 200);
    }
    public function store(Request $request)
    {
        try {
            $request->validate(['name' => 'required|string|max:255']);
    
            $category = Category::create(['name' => $request->name]);
    
            return response()->json([
                'status' => 201,
                'message' => 'Category created successfully.',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
    
            return response()->json([
                "server_err" => $e->getMessage()
            ], 500);
        }
    }
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200, 
            'message' => 'Category retrieved seccessfully.',
            'data' => $category
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        // if (1$category) {
        //     return response()->json([
        //         'status' => 404,
        //         'message' => 'Category not found.',
        //         'data' => null
        //     ], 404);
        // }

        $request->validate(['name' => 'string|max:255']);
        $category->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Category update successfully.',
            'data' => $category
        ], 200);
    }
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 404, 
                'message' => 'Category not found.',
                'data' => null
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Category deleted successfully.',
            'data' => null
        ], 200);
    }
}