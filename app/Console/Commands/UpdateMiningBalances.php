<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CriptoMachine;
use App\Models\Balance;
use App\Models\CryptoPrice;
use App\Models\MachineCota;

class UpdateMiningBalances extends Command
{
    protected $signature = 'mining:update';
    protected $description = 'Atualiza os saldos dos usuários com base no lucro de mineração diário';

    public function handle()
    {
        // 1. Recupera todas as máquinas de mineração
        $machines = CriptoMachine::all();

        $dolar = CryptoPrice::where('crypto_symbol', 'USDT')->first();
    
        // 2. Itera sobre cada máquina de mineração
        foreach ($machines as $machine) {
            // Obtemos o tipo de algoritmo e o lucro de mineração em dólares
            $algorithm = $machine->Algorithm;
            $miningProfitInDollars = $machine->mining_profit;
    
            // Recupera a taxa de câmbio da criptomoeda
            $cryptoSymbol = $this->mapAlgorithmToCryptoSymbol($algorithm);
            $cryptoPriceInBrl = $this->getCryptoPriceInBrl($cryptoSymbol);
    
            // Converte o lucro de mineração de dólares para BRL
            $profitInBrl = $miningProfitInDollars * $dolar->price_in_brl / $cryptoPriceInBrl * 0.01 / 24;
    
            // 3. Encontrar todas as cotas de máquinas associadas com base no tipo de criptomoeda
            $machineCotas = MachineCota::where('machine_id', $machine->id)->get();
    
            // 4. Iterar sobre cada grupo de cotas por usuário
            foreach ($machineCotas as $cota) {
                $userId = $cota->user_id;
                $userQuantity = $cota->cotas;
    
                // 5. Atualizar o saldo do usuário com base na criptomoeda
                $balance = Balance::where('user_id', $userId)->first();
    
                if ($balance) {
                    switch ($cryptoSymbol) {
                        case 'BTC':
                            $balance->balance_btc += $profitInBrl;
                            break;
                        case 'ALPH':
                            $balance->balance_alph += $profitInBrl;
                            break;
                        case 'KAS':
                            $balance->balance_kaspa += $profitInBrl;
                            break;
                        case 'LTC':
                            $balance->balance_ltc += $profitInBrl;
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

