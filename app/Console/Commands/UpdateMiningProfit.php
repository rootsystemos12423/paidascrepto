<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CriptoMachine;
use Goutte\Client;

class UpdateMiningProfit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-mining-profit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Obtém todas as máquinas
        $machines = CriptoMachine::all();
            
        foreach ($machines as $machine) {
            // Instancia o cliente HTTP para fazer a requisição
            $client = new Client();
            $crawler = $client->request('GET', $machine->machine_endpoint);

            // Extrai o preço (valor) do HTML
            $priceDiv = $crawler->filter('li.w-1\\/4.px-0\\.5.py-3\\.5.flex.item-center.justify-center.md\\:text-sm.md\\:leading-normal.md\\:p-\\[14px\\]')
            ->eq(1)  // Seleciona o segundo 'li' baseado em zero-index
            ->text();

            // Remove o símbolo de dólar e espaços em branco adicionais
            $priceDiv = str_replace(['$', ' '], '', $priceDiv);

            // Extrai a eficiência energética (hashrate)
            $energyEfficiency = $crawler->filter('span.text-\\[25px\\].leading-8.dark\\:text-\\[color\\:\\#ddd\\]')
                ->each(function ($node) {
                    $text = $node->text();
                    preg_match('/([\d\.]+)\s*(TH|GH|MH)/i', $text, $matches);
                    return [
                        'value' => isset($matches[1]) ? $matches[1] : null,
                        'unit'  => isset($matches[2]) ? $matches[2] : null
                    ];
                });
            
            // Se o valor de hashrate foi encontrado, use o primeiro valor
            $energyEfficiency = !empty($energyEfficiency) ? $energyEfficiency[0] : ['value' => null, 'unit' => null];

            // Atualiza os valores da máquina no banco de dados
            $machine->update([
                'hashrate'      => $energyEfficiency['value'],  // Atualiza o hashrate
                'hashrate_type' => $energyEfficiency['unit'],   // Atualiza o tipo de hashrate
                'mining_profit' => $priceDiv, // Atualiza o valor de mining_profit
            ]);
        }
    }

}
