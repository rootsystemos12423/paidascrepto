<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineCota extends Model
{
    use HasFactory;

    // Definir a tabela associada ao modelo
    protected $table = 'machine_cotas';

    // Definir os campos que podem ser preenchidos em massa
    protected $fillable = [
        'machine_id',
        'hashrate',
        'hashrate_type',
        'user_id',
    ];

    // Definir as relações com outros modelos, se necessário
    public function machine()
    {
        return $this->belongsTo(CriptoMachine::class, 'machine_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
