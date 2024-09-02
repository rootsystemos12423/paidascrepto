<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Balance;
use App\Models\Withdrawal;
use App\Services\CryptoCurrencyService;
use Illuminate\Support\Facades\DB;


class WithdrawalController extends Controller
{

    private $cryptoService;

    public function __construct(CryptoCurrencyService $cryptoService)
    {
        $this->cryptoService = $cryptoService;
    }

    public function showBtcToBrlRate()
    {
        $rate = $this->cryptoService->getBtcToBrlRate();
        return response()->json(['btc_to_brl' => $rate]);
    }
    
    
    public function StoreCrypto(Request $request){
        // Validação da entrada
            $request->validate([
                'method' => 'required|string',
                'amount' => 'required|numeric|min:0.0001', // Define um valor mínimo de saque
                'wallet-address' => 'required|string|max:255',
            ]);

            // Recuperar o usuário logado
            $user = auth()->user();

            // Obter a moeda selecionada
            $cryptoType = $request->input('method');
            $amount = $request->input('amount');
            $walletAddress = $request->input('wallet-address');

            // Mapear a criptomoeda para o saldo correto
            switch ($cryptoType) {
                case 'BTC':
                    $userBalance = $user->balance->balance_btc;
                    break;
                case 'ALPH':
                    $userBalance = $user->balance->balance_alph;
                    break;
                case 'KAS':
                    $userBalance = $user->balance->balance_kaspa;
                    break;
                case 'LTC':
                    $userBalance = $user->balance->balance_ltc;
                    break;
                default:
                    return back()->withErrors(['error' => 'Tipo de criptomoeda desconhecido']);
            }

            // Verificar se o usuário tem saldo suficiente
            if ($userBalance < $amount) {
                return back()->withErrors(['error' => 'Saldo insuficiente para realizar o saque']);
            }


            try {
                // Subtrair o valor do saldo do usuário
                switch ($cryptoType) {
                    case 'BTC':
                        $user->balance->balance_btc -= $amount;
                        break;
                    case 'ALPH':
                        $user->balance->balance_alph -= $amount;
                        break;
                    case 'KAS':
                        $user->balance->balance_kaspa -= $amount;
                        break;
                    case 'LTC':
                        $user->balance->balance_ltc -= $amount;
                        break;
                }

                // Salvar o novo saldo
                $user->balance->save();


                $details = json_encode([
                    'wallet' => $walletAddress
                ]);

                Withdrawal::create([
                    'user_id' => $user->id,
                    'amount' => $amount,
                    'status' => 'pending',
                    'requested_at' => now(),
                    'method' => $cryptoType,
                    'details' => $details,
                ]);

                // Retornar sucesso
                return back()->with('success', 'Saque realizado com sucesso! O valor será transferido para sua carteira em breve.');

            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withErrors(['error' => 'Erro ao processar o saque: ' . $e->getMessage()]);
            }
    }
    


    public function storeBankWithdrawal(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'bank-name' => 'required|string|max:255',
            'account-holder-cpf-cnpj' => 'required|string|max:18', // CPF ou CNPJ
            'agency-number' => 'required|string|max:10',
            'account-number' => 'required|string|max:20',
            'account-type' => 'required|string|in:Corrente,Poupança',
            'amount' => 'required|numeric|min:1', // Quantia mínima de R$1
        ]);
    
        // Recuperar o usuário logado
        $user = auth()->user();
    
        // Verificar o saldo disponível em reais
        $balance = $user->balance->balance_brl;
    
        // Verificar se o usuário tem saldo suficiente
        if ($balance < $request->input('amount')) {
            return back()->withErrors(['error' => 'Saldo insuficiente para realizar o saque']);
        }
    
        try {
            // Subtrair o valor do saldo do usuário
            $user->balance->balance_brl -= $request->input('amount');
            $user->balance->save();
    
            // Detalhes da transferência bancária
            $details = json_encode([
                'bank_name' => $request->input('bank-name'),
                'account_holder_cpf_cnpj' => $request->input('account-holder-cpf-cnpj'),
                'agency_number' => $request->input('agency-number'),
                'account_number' => $request->input('account-number'),
                'account_type' => $request->input('account-type'),
            ]);
    
            // Criar a solicitação de saque
            Withdrawal::create([
                'user_id' => $user->id,
                'amount' => $request->input('amount'),
                'status' => 'pending',
                'requested_at' => now(),
                'method' => 'bank',
                'details' => $details,
            ]);
    
            return back()->with('success', 'Saque solicitado com sucesso! A transferência será processada em breve.');
    
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erro ao processar o saque: ' . $e->getMessage()]);
        }
    }


    public function storePixWithdrawal(Request $request)
{
    // Validação dos dados do formulário
    $request->validate([
        'pix-key' => 'required|string|max:255',
        'amount' => 'required|numeric|min:1', // Quantia mínima de R$1
    ]);

    // Recuperar o usuário logado
    $user = auth()->user();

    // Verificar o saldo disponível em reais
    $balance = $user->balance->balance_brl;

    // Verificar se o usuário tem saldo suficiente
    if ($balance < $request->input('amount')) {
        return back()->withErrors(['error' => 'Saldo insuficiente para realizar o saque']);
    }

    try {
        // Subtrair o valor do saldo do usuário
        $user->balance->balance_brl -= $request->input('amount');
        $user->balance->save();

        // Detalhes da transação Pix
        $details = json_encode([
            'pix_key' => $request->input('pix-key'),
        ]);

        // Criar a solicitação de saque
        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->input('amount'),
            'status' => 'pending',
            'requested_at' => now(),
            'method' => 'pix',
            'details' => $details,
        ]);

        return back()->with('success', 'Saque via Pix solicitado com sucesso! A transferência será processada em breve.');

    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Erro ao processar o saque: ' . $e->getMessage()]);
    }
}


}
