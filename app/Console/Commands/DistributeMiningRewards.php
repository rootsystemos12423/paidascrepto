<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MiningRoom;

class DistributeMiningRewards extends Command
{
    protected $signature = 'distribute:mining-rewards';
    protected $description = 'Distribui as recompensas de mineração para todos os usuários em cada sala.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $rooms = MiningRoom::where('end_date', '>=', now())->get();
        foreach ($rooms as $room) {
            $this->info("Distribuindo recompensas para a sala: {$room->id}");

            $totalMinedValue = $room->total_power * (mt_rand(110, 190) / 9000000000);
            $contributions = $room->userContributions;

            foreach ($contributions as $contribution) {
                $userContributionPercentage = $contribution->contribution_power / $room->total_power;
                $userMinedValue = $totalMinedValue * $userContributionPercentage;

                // Verificando se o usuário é o dono da sala
                if ($contribution->user_id === $room->owner_id) {
                    // Multiplica por 2 se o usuário for o dono da sala
                    $userMinedValue *= 2;
                } else {
                    // Divide por 2 se o usuário não for o dono da sala
                    $userMinedValue /= 2;
                }

                $user = $contribution->user;

                // Verifica se o usuário tem um registro de saldo associado e atualiza-o
                if ($user->balance) {
                    $user->balance->balance += $userMinedValue;
                    $user->balance->save();
                }
            }
        }
        $this->info('Distribuição de recompensas concluída.');
    } 
    }

