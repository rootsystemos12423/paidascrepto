<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiPrompt extends Model
{
    use HasFactory;

    protected $table = 'ai_prompts'; // Opcional se seguir a convenção de nomenclatura

    protected $fillable = [
        'prompt',
        'desc', // Permitindo atribuição em massa para prompt
    ];

    // Aqui, você pode adicionar outras relações, acessors, mutators ou lógicas de negócios conforme necessário.
}
