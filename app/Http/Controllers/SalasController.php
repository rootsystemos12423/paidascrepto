<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MiningRoom;
use App\Models\UserContribution;
use App\Models\MiningMachine;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Checkout;


class SalasController extends Controller
{

      public function store(Request $request)
{
    // Validação dos dados recebidos do formulário
    $validatedData = $request->validate([
        'duration' => 'required|string',
        'capacity' => 'required|numeric|min:1',
        'role_allowed' => 'required|string',
    ]);

    $user = auth()->user();

    // Criação da sala de mineração
    $miningRoom = new MiningRoom();
    $miningRoom->total_power = 0; // Defina conforme a necessidade
    $miningRoom->capacity = $request->capacity;
    $miningRoom->owner_id = $user->id;
    $miningRoom->role_allowed = $request->role_allowed;

    // Calcula o end_date com base na duração selecionada
    $durationInMinutes = 0;
    switch ($request->duration) {
        case '15':
            $durationInMinutes = 15;
            break;
        case '20':
            $durationInMinutes = 30;
            break;
        case '50':
            $durationInMinutes = 60;
            break;
        case '100':
            $durationInMinutes = 120;
            break;
    }
    
    if ($durationInMinutes > 0) {
        $miningRoom->end_date = Carbon::now()->addMinutes($durationInMinutes);
    }

    $miningRoom->save();

    // Redireciona para a página desejada após a criação
    return redirect()->route('salas.create')->with('success', 'Sala criada com sucesso!');
}

public function JoinRoom($id)
{
    // Verifica se a sala existe
    $room = MiningRoom::find($id);
    if (!$room) {
        return back()->with('error', 'A sala não existe.');
    }

    // Obtém o usuário atual
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login')->with('error', 'Você precisa estar logado para entrar em uma sala.');
    }

    // Verifica se o usuário já está na sala
    $contribution = UserContribution::where('mining_room_id', $id)
                                    ->where('user_id', $user->id)
                                    ->first();

    if ($contribution) {
        return back()->with('error', 'Você já está participando desta sala.');
    }

   // Puxa as máquinas do usuário
   $machines = MiningMachine::where('user_id', $user->id)->get();

   // Soma o poder de mineração com base no nível de cada máquina
   $contributionPower = 0;
   foreach ($machines as $machine) {
       switch ($machine->level) {
           case 1:
               $contributionPower += 200;
               break;
           case 2:
               $contributionPower += 300;
               break;
           case 3:
               $contributionPower += 400;
               break;
           case 4:
               $contributionPower += 900;
               break;
       }
   }
   // Cria a contribuição para o usuário com o poder total calculado
   UserContribution::create([
       'user_id' => $user->id,
       'mining_room_id' => $id,
       'contribution_power' => $contributionPower,
   ]);

    // Redireciona para a sala com uma mensagem de sucesso
    return back()->with('success', 'Você entrou na sala com sucesso.');
}


    public function index(){

        return view('admin.salas');
    }


    public function create(Request $request) {
        // Validação dos dados recebidos do formulário
        $validatedData = $request->validate([
            'duration' => 'required|string',
            'capacity' => 'required|numeric|min:1',
            'role_allowed' => 'required|string',
            'username' => 'required',
        ]);

        $user = User::where('username', $request->username)
        ->orWhere('email', $request->username)
        ->firstOrFail();;

        // Criação da sala de mineração
        $miningRoom = new MiningRoom();
        $miningRoom->total_power = 0; // Assuma um valor inicial ou calcule conforme necessário
        $miningRoom->capacity = $request->capacity;
        $miningRoom->owner_id = $user->id;
        $miningRoom->role_allowed = "todos";

        // Correspondência exata da duração vinda do formulário
        $durationInMinutes = match ($request->duration) {
            '15' => 15,
            '30' => 30,
            '50' => 60,
            '100' => 120,
            default => 0
        };
        
        if ($durationInMinutes > 0) {
            $miningRoom->end_date = Carbon::now()->addMinutes($durationInMinutes);
        }

        $miningRoom->save();

        // Redirecionamento com mensagem de sucesso
        return redirect()->route('salas.menu')->with('success', 'Sala criada com sucesso!');
    }


    public function createOrder(Request $request)
      {
          // Valida os dados de entrada.
          $validatedData = $request->validate([
            'duration' => 'required|string',
            'capacity' => 'required|numeric|min:1',
        ]);
      
          $user = Auth::user();
          do {
              $txId = Str::random(8);  // Gera uma string aleatória.
          } while (Checkout::where('txId', $txId)->exists()); // Verifica se o txId já existe na tabela.
      
      
            $salaData = [];
              $salaData = [
                  'salaData' => [
                      'user_id' => $user->id,
                      'value' => $request->input('valorCalculado'),
                      'capacity' => $request->capacity,
                      'duration' => $request->duration,
                      'qtd' => 1,
                  ],
              ];
          // Cria uma nova instância de Checkout.
          $checkout = new Checkout;
      
          // Atribui valores ao modelo. Os valores são coletados do request validado.
          $checkout->txId = $txId;
          $checkout->description = json_encode($salaData); // Converte o array para JSON
          $checkout->save();
      
          // Retorna uma resposta ou redireciona o usuário para outra página.
          return redirect()->route('checkout', ['id' => $checkout->txId]);
      }

}
