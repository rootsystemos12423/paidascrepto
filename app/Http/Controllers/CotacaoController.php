<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use App\Models\CriptoMachine;

class CotacaoController extends Controller
{
    public function cotacao()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://miningnow.com/asic-miner/bitmain-antminer-al1-15-6th-s/');
        
        // Aqui, usamos um seletor de atributo que verifica se a classe contém "text-[15px]"
        $priceDiv = $crawler->filter('div[class*="text-[15px]"]')->each(function ($node) {
            return $node->text();
        });

        $NameDiv = $crawler->filter('h1.hidden.lg\\:block.text-3xl.leading-\\[44px\\].font-semibold.mb-\\[10px\\].xl\\:text-4xl')
                ->each(function ($node) {
                    // Captura o texto dentro do <h1> e o conteúdo do <span>
                    $fullText = $node->text();
                    return $fullText;
                });

          $energyEfficiency = $crawler->filter('span.text-\\[25px\\].leading-8.dark\\:text-\\[color\\:\\#ddd\\]')
                ->each(function ($node) {
                    // Captura o texto do primeiro <span>
                    $mainValue = $node->text();
                    // Captura o texto do span aninhado
                    $subValue = $node->filter('span.text-\\[color\\:\\#949494\\].text-\\[17px\\].font-medium.ml-\\[2px\\]')->text();
                    return $mainValue . ' ' . $subValue;
                });
            
        dd($energyEfficiency);        

        // Exibe ou processa os dados extraídos
        return view('cotacao', compact('title', 'price', 'description'));
    }

    

    public function listmachines()
    {
        // Obtém todas as máquinas agrupadas por criptomoeda
        $machines = CriptoMachine::all()->groupBy('Algorithm'); // Ajuste conforme necessário
        
        // Retorna como JSON
        return response()->json($machines);
    }

    
}
