<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MiningMachine;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\Checkout;
use App\Models\Withdrawal;
use App\Models\Payment;
use App\Models\IpDetail;
use App\Models\CryptoPrice;



class UserController extends Controller
{


    public function index(){

        return view('admin.users');
    }


    public function Moreinfo($id){

        $user = User::FindOrfail($id);

        $pedido = Checkout::where('email', $user->email)
        ->where('status', 'paid')
        ->orderBy('created_at', 'asc') // 'asc' para obter o mais antigo
        ->first(); // Retorna o primeiro registro encontrado
        
        $deposits = Checkout::where('email', $user->email)->get();

        $totalDeposits = $deposits->where('status', 'aprovado')->sum(function ($deposit) {
            $description = json_decode($deposit->description, true);
        
            // Corrigir formatação de valores
            $valor = isset($description['valor']) ? floatval(preg_replace('/[^\d,.-]/', '', str_replace(',', '.', str_replace('.', '', $description['valor'])))) : 0;
            $taxaServico = isset($description['taxaServico']) ? floatval(preg_replace('/[^\d,.-]/', '', str_replace(',', '.', str_replace('.', '', $description['taxaServico'])))) : 0;
            $imposto = isset($description['imposto']) ? floatval(preg_replace('/[^\d,.-]/', '', str_replace(',', '.', str_replace('.', '', $description['imposto'])))) : 0;
        
            return $valor + $taxaServico + $imposto;
        });
            
        $withdrawals = Withdrawal::where('user_id', $user->id)
            ->where('status', 'paid')
            ->get();

        $totalWithdrawals = '0'; // Começar a soma como string

        foreach ($withdrawals as $withdrawal) {
            $valor = '0'; // Inicializar o valor como string

            switch ($withdrawal->method) {
                case 'ALPH':
                case 'KAS':
                case 'LTC':
                case 'BTC':
                    // Obter o preço em BRL da criptomoeda correspondente
                    $cryptoPrice = CryptoPrice::where('crypto_symbol', $withdrawal->method)->first();
                    if ($cryptoPrice) {
                        // Garantir que amount e price_in_brl são strings bem formatadas
                        $amount = number_format($withdrawal->amount, 8, '.', ''); 
                        $price_in_brl = number_format($cryptoPrice->price_in_brl, 8, '.', '');
                        $valor = bcmul($amount, $price_in_brl, 8); // Multiplicação precisa
                    }
                    break;

                case 'bank':
                case 'pix':
                    // Para métodos de banco ou pix, processar o valor diretamente
                    $valor = number_format(floatval($withdrawal->amount), 8, '.', '');
                    break;

                default:
                    $valor = '0'; // Caso algum método novo ou desconhecido apareça
                    break;
            }

            // Somar ao total usando `bcadd` para precisão
            $totalWithdrawals = bcadd($totalWithdrawals, $valor, 8);
        }

        $chartData = [
            $totalDeposits,
            $totalWithdrawals
        ];

        return view('admin.moreinfo', compact('user', 'pedido', 'chartData'));
    }

    public function BanUser($id) {
        // Encontra o usuário a ser banido
        $user = User::findOrFail($id);
    
        // 1. Marcar como `banned = true` todos os IPs na tabela `IpDetail` que têm `user_id` igual ao do usuário banido
        $userIps = IpDetail::where('user_id', $user->id)->get();
    
        // Array para armazenar os IDs dos usuários que serão banidos
        $bannedUserIds = [$user->id];
    
        foreach ($userIps as $userIp) {
            $userIp->banned = true;
            $userIp->save();
    
            // 2. Consultar cada um desses IPs banidos e verificar se eles têm algum outro `user_id` associado a eles
            $otherUserIps = IpDetail::where('ip', $userIp->ip)->where('user_id', '!=', $user->id)->get();
    
            foreach ($otherUserIps as $otherUserIp) {
                $otherUserIp->banned = true;
                $otherUserIp->save();
    
                // Adiciona o user_id do outro usuário à lista de IDs de usuários banidos
                if (!in_array($otherUserIp->user_id, $bannedUserIds)) {
                    $bannedUserIds[] = $otherUserIp->user_id;
                }
            }
        }
    
        // 3. Marcar como `banned` os registros onde o `user_id` é `null` e o IP foi acessado pelo usuário banido
        $nullUserIps = IpDetail::whereNull('user_id')->whereIn('ip', $userIps->pluck('ip'))->get();
        foreach ($nullUserIps as $nullUserIp) {
            $nullUserIp->banned = true;
            $nullUserIp->save();
        }
    
        // 4. Associar a permissão de "banido" a todos os usuários que foram banidos
        foreach ($bannedUserIds as $bannedUserId) {
            $bannedUser = User::find($bannedUserId);
            if ($bannedUser) {
                $bannedUser->givePermissionTo('banido');
            }
        }
    
        return back()->with('success', 'Usuário banido com sucesso!');
    }    
    
    
    public function impersonate($id)
    {
    
        // Encontra o usuário pelo ID e verifica se não é o mesmo usuário.
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return redirect()->route('dashboard')->withErrors('Você já está logado com este usuário.');
        }

        // Armazena o ID do usuário original na sessão para poder reverter depois.
        session()->put('impersonate', Auth::id());

        // Realiza a autenticação como o novo usuário.
        Auth::login($user);

        return redirect()->route('dashboard'); // Ou redirecione para a rota desejada.
    }
        
    public function updateRole(Request $request)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::where('username', $request->username)->firstOrFail();
        
        // Removendo todas as roles atuais do usuário
        $user->roles()->detach();

        // Atribuindo a nova role ao usuário
        $user->assignRole($request->role);

        return back()->with('success', 'Role do usuário atualizada com sucesso.');
    }

    

}
