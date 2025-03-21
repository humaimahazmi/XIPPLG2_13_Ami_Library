<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Controllers\LoansController;
use App\Models\Loan;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::all();

        return response()->json([
            'status' => 200,
            'message' => 'Loan retrieved successfully.',
            'data' => $loans
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate(rules: [
            'book_id' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'loan_date' => 'required|exists:users,id',
            'return_date' => 'required|exists:categories,id',
            'status' => 'required|string|max:255',
        ]);

        $loan = Loan::create(attributes: $request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Loan created successfully.',
            'data' => $loan
        ], 201);
    }

    public function show($id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json([
                'status' => 404,
                'message' => 'Loan not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Loan retrieved successfully.',
            'data' => $loan
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json([
                'status' => 404,
                'message' => 'Loan not found.',
                'data' => null
            ], 404);
        }

        $request->validate(rules: [
            'book_id' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'loan_date' => 'required|exists:users,id',
            'return_date' => 'required|exists:categories,id',
            'status' => 'required|string|max:255',
        ]);

        $loan->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Loan updated successfully.',
            'data' => $loan
        ], 200);
    }

    public function destroy($id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json([
                'status' => 404,
                'message' => 'Loan not found.',
                'data' => null
            ], 404);
        }

        $loan->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Loan deleted successfully.',
            'data' => null
        ], 200);
    }
}
