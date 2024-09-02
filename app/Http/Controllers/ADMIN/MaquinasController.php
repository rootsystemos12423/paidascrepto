<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MachineCota;
use App\Models\User;
use App\Models\CriptoMachine;
use Goutte\Client;


class MaquinasController extends Controller
{
    public function index(){

        $maquinas = CriptoMachine::all();


        return view('admin.maquinas', compact('maquinas'));
    }


    public function create(Request $request) {
        // Validação dos dados submetidos no formulário
        $request->validate([
            'username' => 'required',
            'machine_qtd' => 'required|numeric',
            'cota_type' => 'required',
        ]);


        $user = User::where('username', $request->username)
                ->orWhere('email', $request->username)
                ->firstOrFail();

        $machine = CriptoMachine::findOrFail($request->cota_type);       

        for ($i = 0; $i < $request->machine_qtd; $i++) {
            $cota = new MachineCota;
            $cota->machine_id = $machine->id;
            $cota->user_id = $user->id;
            $cota->hashrate = $machine->hashrate * 0.01;
            $cota->hashrate_type = $machine->hashrate_type;
            $cota->save();
        }
    
        return back()->with('success', 'Cota adicionada com sucesso!');
    }

    public function charge(Request $request) {
        // Validação dos dados submetidos no formulário
        $request->validate([
            'username' => 'required',
            'machine_qtd' => 'required|numeric',
        ]);
    
        $user = User::where('username', $request->username)
                    ->orWhere('email', $request->username)
                    ->firstOrFail();
    
        // Obtendo as máquinas com menor energia primeiro
        $miningMachines = $user->miningMachines()
                               ->orderBy('energy', 'asc')
                               ->take($request->machine_qtd)
                               ->get();
    
        foreach ($miningMachines as $machine) {
            $machine->energy = 100; // Atualizando a energia.
            $machine->save();
        }
    
        return back()->with('success', 'Máquinas recarregadas com sucesso!');
    }    
    
    public function delete(Request $request) {
        // Validação dos dados submetidos no formulário
        $request->validate([
            'username' => 'required',
            'machine_qtd' => 'required|numeric',
            'cota_type' => 'required',
        ]);
    
        // Buscando o usuário pelo username ou email
        $user = User::where('username', $request->username)
                    ->orWhere('email', $request->username)
                    ->firstOrFail();
    
        // Encontrando a máquina específica com base no tipo de cota
        $machine = CriptoMachine::findOrFail($request->cota_type);       
    
        // Obtendo as cotas associadas ao usuário e à máquina, ordenadas pela criação mais recente
        $cotasToDelete = MachineCota::where('user_id', $user->id)
                                    ->where('machine_id', $machine->id)
                                    ->orderBy('created_at', 'desc')
                                    ->take($request->machine_qtd)
                                    ->get();
    
        // Deletando as cotas mais recentes
        foreach ($cotasToDelete as $cota) {
            $cota->delete();
        }
    
        return back()->with('success', 'Cotas mais recentes deletadas com sucesso!');
    }
    
    

    public function storeEndPoint(Request $request)
    {
        // Valida os dados do formulário
        $validatedData = $request->validate([
            'value' => 'required|string',
            'machine_endpoint' => 'required|url',
        ]);
    
        // Instancia o cliente HTTP para fazer a requisição
        $client = new Client();
        $crawler = $client->request('GET', $request->machine_endpoint);
    
        // Extrai o preço (valor) do HTML
        $priceDiv = $crawler->filter('div[class*="text-[15px]"]')->each(function ($node) {
            // Extrai o texto e usa expressão regular para capturar apenas o valor numérico
            $text = $node->text();
            preg_match('/\$([\d,\.]+)/', $text, $matches);
            return isset($matches[1]) ? $matches[1] : 'Unknown'; // Retorna o valor ou 'Unknown' se não encontrado
        });
    
        // Extrai o nome da máquina
        $name = $crawler->filter('h1.hidden.lg\\:block.text-3xl.leading-\\[44px\\].font-semibold.mb-\\[10px\\].xl\\:text-4xl')
                ->each(function ($node) {
                    // Captura o texto dentro do <h1> e remove espaços não separáveis
                    $fullText = $node->text();
                    $formattedName = str_replace("\u{A0}", ' ', $fullText);
                    return trim($formattedName);
                        });
        $name = !empty($name) ? $name[0] : 'Unknown'; // Pega o primeiro elemento ou define como 'Unknown' se não houver
                
        // Extrai a eficiência energética (hashrate)
        $energyEfficiency = $crawler->filter('span.text-\\[25px\\].leading-8.dark\\:text-\\[color\\:\\#ddd\\]')
        ->each(function ($node) {
            $text = $node->text();
            preg_match('/([\d\.]+)\s*(TH|GH|MH)/i', $text, $matches);
            $hashrateValue = isset($matches[1]) ? $matches[1] : 'Unknown';
            $hashrateUnit = isset($matches[2]) ? $matches[2] : 'Unknown';
            return ['value' => $hashrateValue, 'unit' => $hashrateUnit];
        });
        $energyEfficiency = !empty($energyEfficiency) ? $energyEfficiency[0] : ['value' => 'Unknown', 'unit' => 'Unknown'];

        // Captura o algoritmo
        $algorithm = $crawler->filter('div.flex.flex-col')
        ->filter('span.text-\\[25px\\]')
        ->each(function ($node) {
            return trim($node->text());
        });
        // Pega o primeiro resultado e limpa espaços extras
        $algorithm = !empty($algorithm) ? trim($algorithm[5]) : 'Unknown';
        
        // Cria uma nova entrada no banco de dados
        CriptoMachine::create([
            'name' => $name,
            'value' => $validatedData['value'],
            'machine_endpoint' => $validatedData['machine_endpoint'],
            'algorithm' => $algorithm,
            'hashrate' => $energyEfficiency['value'],
            'hashrate_type' => $energyEfficiency['unit'],
            'mining_profit' => !empty($priceDiv) ? $priceDiv[0] : 'Unknown', // Pega o primeiro elemento ou define como 'Unknown' se não houver
        ]);
    
        return redirect()->back()->with('success', 'Machine saved successfully.');
    }
    
    

}
