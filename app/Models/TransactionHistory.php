<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;
    
    protected $table = 'transactions_history';

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
