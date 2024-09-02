<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessions';  // Especifica a tabela do banco de dados
    public $timestamps = false;     // Desativa timestamps se sua tabela de sessões não tiver campos de timestamp
}
