<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'status',
        'due_date',
        'pix_code_url',
        'pix_code_base64',
        'checkout_id',
    ];

    /**
     * Get the checkout that owns the payment.
     */
    public function checkout()
    {
        return $this->belongsTo(Checkout::class, 'checkout_id');
    }
}
