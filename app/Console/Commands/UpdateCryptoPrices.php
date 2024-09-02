<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\CryptoPrice;

class UpdateCryptoPrices extends Command
{
    // O nome e a assinatura do comando no terminal
    protected $signature = 'crypto:update-prices';

    // A descrição do comando
    protected $description = 'Atualiza os preços das criptomoedas e suas variações em 24h';

    /**
     * Execute o comando.
     *
     * @return int
     */
    public function handle()
    {
        // URL da API com mais informações, incluindo a variação de preço
        $url = 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms=KAS,BTC,ALPH,LTC,USDT&tsyms=BRL';
        $response = Http::get($url);
        
        if ($response->successful()) {
            $data = $response->json()['RAW']; // Extrair dados de 'RAW' da resposta
            
            foreach ($data as $crypto => $info) {
                $priceData = $info['BRL'];
                
                // Salvar ou atualizar dados no banco
                CryptoPrice::updateOrCreate(
                    ['crypto_symbol' => $crypto],
                    [
                        'price_in_brl' => $priceData['PRICE'],
                        'display_price' => number_format($priceData['PRICE'], 2, ',', '.'), // Formatação para exibição
                        'change_pct_24h' => $priceData['CHANGEPCT24HOUR'] ?? null,
                        'high_24h' => $priceData['HIGH24HOUR'] ?? null,
                        'low_24h' => $priceData['LOW24HOUR'] ?? null,
                        'volume_24h' => $priceData['VOLUME24HOUR'] ?? null,
                    ]
                );

                $this->info("Preços da criptomoeda {$crypto} atualizados com sucesso.");
            }
        } else {
            $this->error('Falha ao buscar os dados da API.');
        }

        return Command::SUCCESS;
    }
}