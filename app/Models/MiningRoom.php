<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiningRoom extends Model
{
    use HasFactory;

    protected $table = 'mining_rooms';

    protected $fillable = [
        'total_power',
        'capacity',
        'role_allowed',
        'end_date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Método para acessar as contribuições da sala
    public function userContributions()
    {
        return $this->hasMany(UserContribution::class);
    }

    // Método para acessar diretamente os usuários contribuintes desta sala
    public function contributors()
    {
        return $this->hasManyThrough(
            User::class,
            UserContribution::class,
            'mining_room_id', // Chave estrangeira em UserContribution
            'id', // Chave estrangeira em User
            'id', // Chave local em MiningRoom
            'user_id' // Chave local em UserContribution
        );
    }
}
