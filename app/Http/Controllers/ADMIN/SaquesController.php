<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdrawal;

class SaquesController extends Controller
{

    public function index()
    {
        // Defina o número de itens por página, por exemplo, 10
        $withdrawals = Withdrawal::where('status', 'pending')->paginate(10);

        return view('admin.saques', compact('withdrawals'));
    }



    public function update(Request $request, $id)
{
    $request->validate([
        'action' => 'required|in:1,2', // 1: Recusar, 2: Aprovar
    ]);

    $withdrawal = Withdrawal::findOrFail($id);

    if ($request->action == '1') {
        // Recusar
        $withdrawal->status = 'refused';
        
        // Encontra o usuário associado ao saque
        $user = $withdrawal->user;
        
        $balance = $user->balance;

        if($withdrawal->method === 'ALPH'){
            $balance->balance_alph += $withdrawal->amount;   
        }elseif ($withdrawal->method === 'KAS') {
            $balance->balance_kaspa += $withdrawal->amount; 
        }elseif ($withdrawal->method === 'LTC') {
            $balance->balance_ltc += $withdrawal->amount; 
        }elseif ($withdrawal->method === 'BTC') {
            $balance->balance_btc += $withdrawal->amount; 
        }
        $balance->save();
    }
     elseif ($request->action == '2') {
        // Aprovar
        $withdrawal->status = 'approved';
    }

    $withdrawal->save();

    return back()->with('success', 'Ação realizada com sucesso!');
}

}
