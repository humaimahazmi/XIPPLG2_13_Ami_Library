<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('books', BookController::class);
Route::apiResource('loans', LoanController::class);
Route::apiResource('reviews', LoanController::class);
Route::get('/user', function (Request $request) 
{
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('categories', CategoryController::class);
