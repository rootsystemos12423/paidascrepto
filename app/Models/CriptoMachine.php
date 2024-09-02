<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriptoMachine extends Model
{
    use HasFactory;

    // Defina o nome da tabela se for diferente do padrão
    protected $table = 'cripto_machines_list';

    // Atributos que são mass assignable
    protected $fillable = [
        'name',
        'value',
        'algorithm',
        'hashrate',
        'hashrate_type',
        'mining_profit',
        'machine_endpoint',
    ];

    // Defina os atributos que devem ser tratados como enums
    protected $casts = [
        'hashrate' => 'string', // Ajuste o tipo conforme necessário
    ];
}
