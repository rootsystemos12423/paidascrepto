<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'txId',
        'status',
        'description',
        'cpf',
        'email',
        'telefone',
        'nome',
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'description' => 'array',
    ];

    /**
     * Validações de status do checkout.
     *
     * @param string $status
     * @return bool
     */
    public static function isValidStatus($status)
    {
        $validStatuses = ['in_review', 'pending', 'approved', 'refused'];
        return in_array($status, $validStatuses);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
