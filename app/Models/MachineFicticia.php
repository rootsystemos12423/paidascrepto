<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineFicticia extends Model
{
    use HasFactory;

    protected $table = 'machines_ficticias';

    protected $fillable = ['maquina_modelo', 'nome', 'algoritmo', 'uptime'];
}
