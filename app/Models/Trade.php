<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = [
        'user_id', 'symbol', 'type', 'amount', 'entry_price',
        'current_price', 'profit', 'status'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'entry_price' => 'decimal:2',
        'current_price' => 'decimal:2',
        'profit' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}