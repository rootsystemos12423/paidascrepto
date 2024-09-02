<?php

namespace App\Http\Controllers\PAYLOADERS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Payment;
use App\Events\PaymentSucess;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use GuzzleHttp\Client;
use App\Models\User;
use App\Mail\PurchaseConfirmation;
use Illuminate\Support\Facades\Mail;

class MaquinasPayloaderController extends Controller
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

        $this->addMachinesToUser($user, $checkout);
        Mail::to($checkout->email)->send(new PurchaseConfirmation($checkout, $pedido));
        event(new PaymentSucess($checkout));
        return response()->json(['message' => 'Pagamento processado com sucesso.'], 200);
    }

    private function addMachinesToUser($user, $checkout)
{
    // Supomos que a descrição do checkout contém informações sobre o plano e, consequentemente, sobre o número de máquinas a serem adicionadas.
    $description = json_decode($checkout->description, true);
    $qtd = $description['maquinas']['qtd'];
    // Adiciona as máquinas ao usuário.
    for ($i = 0; $i < $qtd; $i++) {
        // Assumindo que você tem um método na relação 'maquinas' para criar uma nova máquina
        $user->miningMachines()->create([
            // Defina os atributos da máquina conforme necessário
            'level' => 1,
            // Pode ser necessário passar mais informações, dependendo do seu esquema de banco de dados
        ]);
    }
}

}
