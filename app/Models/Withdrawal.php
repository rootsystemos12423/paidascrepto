<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $table = 'withdrawals';

    // Definindo as propriedades que podem ser atribuídas em massa.
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'requested_at',
        'processed_at',
        'transaction_id',
        'method',
        'details',
    ];

    /**
     * Relacionamento com o modelo User.
     * Cada saque pertence a um usuário.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Você pode adicionar mais relacionamentos aqui, por exemplo, com uma tabela de transações,
    // se houver um relacionamento definido entre saques e transações.
}
