<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'crypto_symbol',
        'price_in_brl',
        'display_price',
        'change_pct_24h',
        'high_24h',
        'low_24h',
        'volume_24h',
    ];
}
