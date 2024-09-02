<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailRemarketing extends Model
{
    use HasFactory;

    protected $table = 'email_remarketing'; // Define explicitamente o nome da tabela

    protected $fillable = [
        'email',
        'alerted',
    ];
}
