<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balance;
use App\Models\CryptoPrice;


class ExchangeController extends Controller
{
    public function index(){

        $user = auth()->user();

        $balance = $user->balance()->first();

        return view('exchange.main', compact('balance'));
    }

    public function convertCrypto(Request $request)
{
    // Valida o formulário recebido
    $request->validate([
        'method' => 'required|string',  // Ex: BTC, ALPH, KAS, LTC
        'amount' => 'required|numeric|min:0.00000001',  // Quantidade a converter
    ]);

    $user = auth()->user();
    $balance = Balance::where('user_id', $user->id)->firstOrFail();
    $method = strtoupper($request->method);
    $amount = $request->amount;

    // Cotação da moeda recebida via banco de dados (campo 'price_in_brl')
    $cryptoPrices = CryptoPrice::all()->keyBy('crypto_symbol');

    // Calcula o saldo em BRL com base na criptomoeda e cotação
    $convertedAmount = 0;
    switch ($method) {
        case 'BTC':
            if ($balance->balance_btc < $amount) {
                return back()->withErrors(['message' => 'Saldo insuficiente de BTC']);
            }
            $balance->balance_btc -= $amount;
            $convertedAmount = $amount * $cryptoPrices['BTC']->price_in_brl;
            break;
        case 'ALPH':
            if ($balance->balance_alph < $amount) {
                return back()->withErrors(['message' => 'Saldo insuficiente de ALPH']);
            }
            $balance->balance_alph -= $amount;
            $convertedAmount = $amount * $cryptoPrices['ALPH']->price_in_brl;
            break;
        case 'KAS':
            if ($balance->balance_kaspa < $amount) {
                return back()->withErrors(['message' => 'Saldo insuficiente de KASPA']);
            }
            $balance->balance_kaspa -= $amount;
            $convertedAmount = $amount * $cryptoPrices['KAS']->price_in_brl;
            break;
        case 'LTC':
            if ($balance->balance_ltc < $amount) {
                return back()->withErrors(['message' => 'Saldo insuficiente de LTC']);
            }
            $balance->balance_ltc -= $amount;
            $convertedAmount = $amount * $cryptoPrices['LTC']->price_in_brl;
            break;
        default:
            return back()->withErrors(['message' => 'Método de criptomoeda inválido']);
    }

    // Atualiza o saldo em BRL
    $balance->balance_brl += $convertedAmount;
    $balance->save();

    return back()->with('success', 'Conversão realizada com sucesso!');
}

}
