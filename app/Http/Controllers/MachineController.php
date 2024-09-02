<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MiningMachine;
use App\Models\Checkout;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class MachineController extends Controller
{
      public function upgradeMachine($id)
      {
          // Busca a máquina pelo ID
          $machine = MiningMachine::findOrFail($id);
  
          // Passa a máquina encontrada para a view
          return view('maquinas.upgrade', ['machine' => $machine]);
      }

      public function createOrderAdicionar(Request $request)
      {
          // Valida os dados de entrada.
          $validatedData = $request->validate([
              'qtd' => 'required|numeric',
              'valorCalculado' => 'required|numeric',
          ]);
      
          $user = Auth::user();

          do {
              $txId = Str::random(8);  // Gera uma string aleatória.
          } while (Checkout::where('txId', $txId)->exists()); // Verifica se o txId já existe na tabela.
      
      
          $machineData = [];
              $planData = [
                  'maquinas' => [
                      'user_id' => $user->id,
                      'value' => $request->input('valorCalculado'),
                      'qtd' => $request->input('qtd'),
                  ],
              ];
          // Cria uma nova instância de Checkout.
          $checkout = new Checkout;
      
          // Atribui valores ao modelo. Os valores são coletados do request validado.
          $checkout->txId = $txId;
          $checkout->description = json_encode($planData); // Converte o array para JSON
          $checkout->save();
      
          // Retorna uma resposta ou redireciona o usuário para outra página.
          return redirect()->route('checkout', ['id' => $checkout->txId]);
      }


      public function createOrderUpgrade(Request $request)
      {
          // Valida os dados de entrada.
          $validatedData = $request->validate([
              'machine_id' => 'required|numeric',
          ]);
      
          $user = Auth::user();
          $machine = MiningMachine::findOrFail($validatedData['machine_id']);

          do {
              $txId = Str::random(8);  // Gera uma string aleatória.
          } while (Checkout::where('txId', $txId)->exists()); // Verifica se o txId já existe na tabela.
      
      
          $machineData = [];
          if($machine->level === 1)
              $machineData = [
                  'upgradeMaquinas' => [
                      'machine_id' => $machine->id,
                      'value' => 50,
                      'level' => $machine->level,
                      'qtd' => 1,
                  ],
              ];
            elseif($machine->level === 2){
                        $machineData = [
                            'upgradeMaquinas' => [
                                'machine_id' => $machine->id,
                                'value' => 100,
                                'level' => $machine->level,
                                'qtd' => 1,
                            ],
                        ];
                }
            elseif($machine->level === 3){
                    $machineData = [
                        'upgradeMaquinas' => [
                            'machine_id' => $machine->id,
                            'value' => 150,
                            'level' => $machine->level,
                            'qtd' => 1,
                        ],
                    ];
            }
            else{
                $machineData = [
                    'upgradeMaquinas' => [
                        'machine_id' => $machine->id,
                        'value' => 250,
                        'level' => $machine->level,
                        'qtd' => 1,
                    ],
                ];
            }
          // Cria uma nova instância de Checkout.
          $checkout = new Checkout;
      
          // Atribui valores ao modelo. Os valores são coletados do request validado.
          $checkout->txId = $txId;
          $checkout->description = json_encode($machineData); // Converte o array para JSON
          $checkout->save();
      
          // Retorna uma resposta ou redireciona o usuário para outra página.
          return redirect()->route('checkout', ['id' => $checkout->txId]);
      }
      

}