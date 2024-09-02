<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiningMachine extends Model
{
    use HasFactory;

    protected $table = 'mining_machines'; // Especifica a tabela associada

    protected $fillable = [
        'user_id',
        'level',
        'bitcoins_mined',
        'energy',
    ];

    // Relacionamento com UserMining
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
