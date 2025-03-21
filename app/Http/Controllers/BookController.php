<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\http\Controllers\BookController;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return response()->json([
            'status' => 200,
            'message' => 'Book retrieved successfully.',
            'data' => $books
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate(rules: [
            'title' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date(format: 'Y')
        ]);

        $book = Book::create(attributes: $request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Book created successfully.',
            'data' => $book
        ], 201);
    }

    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 404,
                'message' => 'Book not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Book retrieved successfully.',
            'data' => $book
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 404,
                'message' => 'Book not found.',
                'data' => null
            ], 404);
        }

        $request->validate(rules: [
            'title' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date(format: 'Y')
        ]);
        $category->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Book updated successfully.',
            'data' => $book
        ], 200);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 404,
                'message' => 'Book not found.',
                'data' => null
            ], 404);
        }

        $book->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Book deleted successfully.',
            'data' => null
        ], 200);
    }
}
