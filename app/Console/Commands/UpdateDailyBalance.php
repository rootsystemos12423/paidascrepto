<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\DailyBalance;
use Carbon\Carbon;

class UpdateDailyBalance extends Command
{
    protected $signature = 'balance:update-daily';
    protected $description = 'Update daily balance for all users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::with('balance')->get(); // Pré-carrega o relacionamento 'balance'.
    
        foreach ($users as $user) {
            $today = Carbon::today();
    
            // Busca o registro de saldo diário do usuário para o dia atual.
            $dailyBalance = DailyBalance::where('user_id', $user->id)
                                        ->whereDate('date', $today)
                                        ->first();
    
            if ($dailyBalance) {
                // Atualiza o saldo se o registro já existe.
                $dailyBalance->balance = $user->balance->balance;
            } else {
                // Cria um novo registro se não existir.
                $dailyBalance = new DailyBalance();
                $dailyBalance->user_id = $user->id;  // Garante que o user_id é atribuído.
                $dailyBalance->date = $today;
                $dailyBalance->balance = $user->balance->balance;
            }
    
            $dailyBalance->save();
        }
    
        $this->info('Daily balances updated successfully.');
    }
    

}
