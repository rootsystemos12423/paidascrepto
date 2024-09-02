<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CriptoMachine; // Atualize o namespace conforme necessário
use App\Models\Balance; // Atualize o namespace conforme necessário
use App\Models\CryptoPrice; // Atualize o namespace conforme necessário
use App\Models\MachineCota; // Atualize o namespace conforme necessário

class UpdateMiningBalances extends Command
{
    protected $signature = 'mining:update';
    protected $description = 'Atualiza os saldos dos usuários com base no lucro de mineração diário';

    public function handle()
{
    // 1. Recupera todas as máquinas de mineração
    $machines = CriptoMachine::all();

    // 2. Itera sobre cada máquina de mineração
    foreach ($machines as $machine) {
        // Obtemos o tipo de algoritmo e o lucro de mineração em dólares
        $algorithm = $machine->Algorithm;
        $miningProfitInDollars = $machine->mining_profit;

        // Recupera a taxa de câmbio da criptomoeda
        $cryptoSymbol = $this->mapAlgorithmToCryptoSymbol($algorithm);
        $cryptoPriceInBrl = $this->getCryptoPriceInBrl($cryptoSymbol);

        // Converte o lucro de mineração de dólares para BRL
        $profitInBrl = $miningProfitInDollars / $cryptoPriceInBrl;

        // Calcula o valor minerado (0.28% do lucro de mineração)
        $userProfit = $profitInBrl * 0.0028;

        // 3. Encontrar todas as cotas de máquinas associadas com base no tipo de criptomoeda
        $machineCotas = MachineCota::where('machine_id', $machine->id)->get();

        // 4. Agrupar as cotas por usuário
        $userCotas = $machineCotas->groupBy('user_id');

        // 5. Iterar sobre cada grupo de cotas por usuário
        foreach ($userCotas as $userId => $cotas) {
            // Calcular o total de hashrate do usuário para esta máquina
            $totalHashrate = $cotas->sum('hashrate');

            // 7. Atualizar o saldo do usuário com base na criptomoeda
            $balance = Balance::where('user_id', $userId)->first();

            if ($balance) {
                switch ($cryptoSymbol) {
                    case 'BTC':
                        $balance->balance_btc += $userProfit;
                        break;
                    case 'ALPH':
                        $balance->balance_alph += $userProfit;
                        break;
                    case 'KAS':
                        $balance->balance_kaspa += $userProfit;
                        break;
                    case 'LTC':
                        $balance->balance_ltc += $userProfit;
                        break;
                    default:
                        $this->error("Símbolo de criptomoeda desconhecido: {$cryptoSymbol}");
                        continue 2; // Pular para a próxima máquina de mineração
                }

                // Salva as alterações no saldo do usuário
                $balance->save();
            }
        }
    }

    $this->info('Atualização das máquinas e saldos realizada com sucesso!');
}

private function mapAlgorithmToCryptoSymbol($algorithm)
{
    // Mapeia algoritmos para seus símbolos de criptomoedas
    switch ($algorithm) {
        case 'SHA-256':
            return 'BTC';
        case 'Blake3':
            return 'ALPH';
        case 'KHeavyHash':
            return 'KAS';
        case 'Scrypt':
            return 'LTC';
        default:
            throw new \Exception("Algoritmo desconhecido: {$algorithm}");
    }
}

private function getCryptoPriceInBrl($cryptoSymbol)
{
    // Obtém a taxa de câmbio da criptomoeda em BRL
    $cryptoPrice = CryptoPrice::where('crypto_symbol', $cryptoSymbol)->first();
    if ($cryptoPrice) {
        return $cryptoPrice->price_in_brl;
    } else {
        throw new \Exception("Preço da criptomoeda não encontrado: {$cryptoSymbol}");
    }
}


    
}
