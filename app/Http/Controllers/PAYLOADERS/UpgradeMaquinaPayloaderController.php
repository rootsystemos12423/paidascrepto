<?php

namespace App\Http\Controllers\PAYLOADERS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Events\PaymentSucess;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use GuzzleHttp\Client;
use App\Models\User;
use App\Mail\PurchaseConfirmation;
use Illuminate\Support\Facades\Mail;

class UpgradeMaquinaPayloaderController extends Controller
{
    public function data(Request $request)
    {
        $payload = $request->json()->all();

        if ($payload['data']['status'] !== 'PAID') {
            return response()->json(['message' => 'Status não é pago.'], 400);
        }

        $transactionId = $payload['data']['code'];
        $pedido = Payment::where('order_id', $transactionId)->first();

        if (!$pedido) {
            return response()->json(['message' => 'Order_id inválido.'], 404);
        }

        $pedido->status = 'paid';
        $pedido->save();

        $checkout = $pedido->checkout;
        if (!$checkout) {
            return response()->json(['message' => 'Checkout não encontrado.'], 404);
        }

        $checkout->status = 'paid';
        $checkout->save();

        $user = User::where('email', $checkout->email)->first();
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 200);
        }        

        $this->upgradeMachineForUser($user, $checkout);
        Mail::to($checkout->email)->send(new PurchaseConfirmation($checkout, $pedido));
        event(new PaymentSucess($checkout));
        return response()->json(['message' => 'Pagamento processado com sucesso.'], 200);
    }

    private function upgradeMachineForUser($user, $checkout)
    {
        // Supomos que a descrição do checkout contém informações sobre o upgrade e, consequentemente, sobre quantos níveis devem ser adicionados.
        $description = json_decode($checkout->description, true);
        $machineId = $description['upgradeMaquinas']['machine_id'];
        // Encontra a máquina específica do usuário usando o machine_id.
        $machine = $user->miningMachines()->find($machineId);

        $maxLevelAllowed = 4;  // Define o nível máximo permitido.

        $machine->update([
            'level' => min($machine->level + 1, $maxLevelAllowed),
        ]);
    }

    
}
