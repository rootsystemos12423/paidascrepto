<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserContribution extends Model
{
    use HasFactory;

      /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'user_contributions';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'mining_room_id',
        'contribution_power',
    ];

    /**
     * Obtém o usuário associado à contribuição.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Após criar ou atualizar uma contribuição, recalcula o total_power da sala.
        static::saved(function ($contribution) {
            $room = MiningRoom::find($contribution->mining_room_id);
            if ($room) {
                $totalPower = $room->userContributions()->sum('contribution_power');
                $room->total_power = $totalPower;
                $room->save();
            }
        });

        // Considerando a possibilidade de remoção de contribuições
        static::deleted(function ($contribution) {
            $room = MiningRoom::find($contribution->mining_room_id);
            if ($room) {
                $totalPower = $room->userContributions()->sum('contribution_power');
                $room->total_power = $totalPower;
                $room->save();
            }
        });
    }

    public function miningRoom()
    {
        return $this->belongsTo(MiningRoom::class);
    }
    
}
