<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'affiliate_code_id',
        'referred_user_id',
        'reffer_status',
        'item_purchased',
    ];

    /**
     * Get the user that was referred.
     */
    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }

    /**
     * Get the affiliate code.
     */
    public function affiliate()
    {
        return $this->belongsTo(Afiliados::class, 'affiliate_code_id', 'codigo_afiliado');
    }
}

