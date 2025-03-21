<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'loan_date',
        'return_date',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(related: Category::class);
    }
    public function bookr(): BelongsTo
    {
        return $this->belongsTo(related: Book::class);
    }
}
