<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'rating',
        'comment',
        'created_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(related: Category::class);
    }
    public function book(): BelongsTo
    {
        return $this->belongsTo(related: Book::class);
    }
    public function loan(): BelongsTo
    {
        return $this->belongsTo(related: Loan::class);
    }
}
