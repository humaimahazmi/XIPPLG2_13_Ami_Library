<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Controllers\ReviewsController;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();

        return response()->json([
            'status' => 200,
            'message' => 'Review retrieved successfully.',
            'data' => $reviews
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate(rules: [
            'book_id' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'rating' => 'required|exists:users,id',
            'comment' => 'required|exists:categories,id',
            'cretaed_at' => 'required|string|max:255',
        ]);

        $review = Review::create(attributes: $request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Review created successfully.',
            'data' => $review
        ], 201);
    }

    public function show($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => 404,
                'message' => 'Review not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Review retrieved successfully.',
            'data' => $review
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => 404,
                'message' => 'Loan not found.',
                'data' => null
            ], 404);
        }

        $request->validate(rules: [
            'book_id' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'rating' => 'required|exists:users,id',
            'comment' => 'required|exists:categories,id',
            'created_at' => 'required|string|max:255',
        ]);

        $review->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Review updated successfully.',
            'data' => $review
        ], 200);
    }

    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => 404,
                'message' => 'Review not found.',
                'data' => null
            ], 404);
        }

        $review->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Review deleted successfully.',
            'data' => null
        ], 200);
    }
}
