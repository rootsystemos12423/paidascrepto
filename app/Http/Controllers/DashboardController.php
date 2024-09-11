<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CryptoCurrencyService;

use App\Models\Balance;
use App\Models\Withdrawal;
use App\Models\MiningMachine;
use App\Models\MiningRoom;
use App\Models\User;
use App\Models\TransactionHistory;
use App\Models\MachineCota;
use App\Models\MachineFicticia;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\CriptoMachine;
use Goutte\Client;

use Barryvdh\DomPDF\Facade\PDF;

class DashboardController extends Controller
{

    
    public function index()
    {
        $user = auth()->user(); // Obtém o ID do usuário autenticado

        $cotas = MachineCota::select('machine_id', 'hashrate_type')
            ->selectRaw('SUM(hashrate) as total_hashrate')
            ->where('user_id', $user->id) // Filtra pelo ID do usuário autenticado
            ->groupBy('machine_id', 'hashrate_type')
            ->with('machine') // Carrega a relação com o modelo Machine
            ->get();

        // Define a ordem dos algoritmos
        $algorithmOrder = ['Blake3', 'KHeavyHash', 'Scrypt', 'SHA-256'];

        // Obtém a soma do hashrate para cada tipo de algoritmo
        $dataChart = MachineCota::select('cripto_machines_list.Algorithm', 'machine_cotas.hashrate_type')
            ->selectRaw('SUM(machine_cotas.hashrate) as total_hashrate')
            ->selectRaw('COUNT(*) as total_cotas')
            ->join('cripto_machines_list', 'machine_cotas.machine_id', '=', 'cripto_machines_list.id')
            ->where('machine_cotas.user_id', $user->id)
            ->groupBy('cripto_machines_list.Algorithm', 'machine_cotas.hashrate_type')
            ->get();

        // Inicializa arrays para labels e dados
        $labels = [];
        $data = [];

        $totalCotas = 0;

        // Preenche os arrays com os dados, removendo valores nulos
        foreach ($dataChart as $item) {
            $algorithm = $item->Algorithm;
            $index = array_search($algorithm, $algorithmOrder);
            if ($index !== false) {
                // Apenas adiciona se o total de cotas for maior que 0
                if ($item->total_cotas > 0) {
                    $labels[] = $algorithm;
                    $data[] = $item->total_cotas;
                    $totalCotas += $item->total_cotas;
                }
            }
        }

        // Define os dados para a view
        $chartData = [
            'labels' => $labels,
            'data' => $data,
            'backgroundColor' => [
                'rgba(239, 68, 68, 1)',  // Blake3
                'rgba(75, 192, 192, 1)',  // KHeavyHash
                'rgba(156, 163, 175, 1)',  // Scrypt
                'rgba(255, 206, 86, 1)',  // SHA-256
            ],
            'totalCotas' => $totalCotas
        ];


            $conversionFactors = [
                'GH' => 0.01, // 1 GH = 0.001 TH
                'MH' => 0.00001, // 1 MH = 0.000001 TH
                'TH' => 1, // Já está em TH, então fator de conversão é 1
            ];

            // Inicializa o total de hash rate em TH/s
            $totalHashrateTH = 0;

            // Obtém os tipos de hashrate e soma
            $hashrateTypes = ['GH', 'MH', 'TH'];
            foreach ($hashrateTypes as $type) {
                $totalHashrate = MachineCota::where('hashrate_type', $type)
                ->sum('hashrate');

                // Converte o total para TH/s e adiciona ao total geral
                $totalHashrateTH += $totalHashrate * $conversionFactors[$type];
            }

            $machines = MachineFicticia::all();

        return view('dashboard', compact('cotas', 'chartData', 'totalHashrateTH', 'user', 'machines'));
    }
    
    

    public function SaquesIndex()
    {
        $user = auth()->user();
    
        // Obtém o saldo do usuário ou define como null caso não exista
        $balance = $user->balance()->first();

        $withdrawals = $user->withdrawals()->orderBy('created_at', 'desc')->paginate(10);

        return view('saques.efetuar', compact('balance', 'withdrawals'));
    }

    public function HistoryIndex()
    {
        // Obtém o usuário logado
        $user = Auth::user();
    
        // Recupera os saques relacionados ao usuário logado e ordena-os do mais recente para o mais antigo
        $withdrawals = $user->withdrawals()->orderBy('created_at', 'desc')->get();
    
        // Passa os saques para a view
        return view('saques.historico', compact('withdrawals'));
    }
    

    public function indexMachines()
    {
        // Obtém o usuário autenticado
        $user = auth()->user();

        // Se existe um usuário logado, busca suas máquinas
        if ($user) {
            // Recupera todas as máquinas de mineração associadas ao usuário logado
            $machines = $user->miningMachines()->get();
        } else {
            // Define máquinas como uma coleção vazia se nenhum usuário estiver logado
            $machines = collect();
        }

        // Passa as máquinas para a view
        return view('maquinas.menu', compact('machines'));
    }


    public function CotasIndex(){

        return view('cotas.adquirir');
    }


    public function RelatorioIndex(){

        return view('relatorios.relatorio');
    }

    public function MinhaContaIndex(){

        $user = auth()->user();

        $cotas = MachineCota::select('machine_id', 'hashrate_type')
        ->selectRaw('COUNT(*) as total_cotas')
        ->where('user_id', $user->id) // Filtra pelo ID do usuário autenticado
        ->groupBy('machine_id', 'hashrate_type') // Agrupa pelo ID da máquina e tipo de hashrate
        ->with('machine') // Carrega o relacionamento com o modelo Machine
        ->get();


        return view('profile.minhaconta', compact('cotas'));
    }

    public function SuporteIndex(){

        return view('suporte.index');
    }

    public function relatorio()
    {
    
        return PDF::loadView('pdf.relatorio')->stream('relatorio.pdf');
    }

    public function relatorioHtml()
    {
    
        return view('pdf.relatorio');
    }
    
    public function StatusIndex(){

        return view('status.status');
    }

    public function maquinaFicticiastore(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'machine_modelo' => 'required|string|max:255',
            'algoritmo' => 'required|string|max:255',
            'qtd' => 'required|integer|min:1',
        ]);

        // Definir abreviações para algoritmos
        $algoritmoAbreviacoes = [
            'SHA-256' => 'SHA',
            'Blake3' => 'BLK',
            'Scrypt' => 'SCR',
            'KHeavyHash' => 'KHH'
        ];

        for ($i = 0; $i < $validatedData['qtd']; $i++) {
            $machine = new MachineFicticia();

            // Gerar uma abreviação baseada no algoritmo
            $algoritmoAbrev = $algoritmoAbreviacoes[$validatedData['algoritmo']] ?? strtoupper(substr($validatedData['algoritmo'], 0, 3));

            // Gerar um sufixo numérico ou string aleatória
            $sufixoUnico = str_pad($i + 1, 4, '0', STR_PAD_LEFT); // Exemplo de sufixo numérico com 4 dígitos

            // Formatar o nome: Modelo-Algoritmo-Sufixo
            $machine->nome = strtoupper($validatedData['machine_modelo'] . '-' . $algoritmoAbrev . '-' . $sufixoUnico);
            $machine->maquina_modelo = $validatedData['machine_modelo'];
            $machine->uptime = 99.97;
            $machine->algoritmo = $validatedData['algoritmo'];
            $machine->save(); // Salvar cada máquina individualmente
        }

        // Redirecionamento com mensagem de sucesso
        return redirect()->back()->with('success', $validatedData['qtd'] . ' máquinas salvas com sucesso!');
    }

}
