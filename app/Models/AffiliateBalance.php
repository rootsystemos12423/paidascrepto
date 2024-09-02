<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateBalance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'balance_brl'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
