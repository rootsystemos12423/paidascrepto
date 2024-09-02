<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $table = 'balances';
    protected $fillable = [
        'balance_btc',
        'balance_brl',
        'balance_alph',
        'balance_kaspa',
        'balance_ltc'
    ];
    
    protected static function boot()
    {
        parent::boot();
    
        static::updated(function ($balance) {
            // Campos de saldo a serem verificados
            $balanceFields = [
                'balance_btc',
                'balance_brl',
                'balance_alph',
                'balance_kaspa',
                'balance_ltc'
            ];
    
            foreach ($balanceFields as $field) {
                // Verifica se o campo foi alterado
                if ($balance->isDirty($field)) {
                    $changeAmount = $balance->{$field} - $balance->getOriginal($field);
                    $transactionType = $changeAmount > 0 ? 'Entrada' : 'Saída';
    
                    TransactionHistory::create([
                        'user_id' => $balance->user_id,
                        'type' => strtoupper(substr($field, 8)), // Extraí a moeda do nome do campo (BTC, BRL, ALPH, KASPA, LTC)
                        'amount' => abs($changeAmount),
                        'description' => $transactionType,
                    ]);
                }
            }
        });
    }    
    
}
