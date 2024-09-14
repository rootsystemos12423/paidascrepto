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
use App\Mail\CreateAccountEmail;
use App\Mail\UserCredentials;
use App\Models\Afiliados;
use App\Models\Referral;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\MachineCota;
use App\Models\CriptoMachine;
use Illuminate\Support\Facades\Http;


class PlanPayloaderController extends Controller
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
            $credentials = $this->createUserFromCheckout($checkout);
            $user = $credentials['user'];
            $password = $credentials['password'];  // Senha em texto puro.
            Mail::to($user->email)->send(new UserCredentials($user, $password));
        }        

        $planDetails = $this->processPlan($user, $checkout);
        Mail::to($checkout->email)->send(new PurchaseConfirmation($checkout, $pedido));
         // Verificar se o usuário foi indicado por alguém
         if (!empty($checkout->afiliacao)) {
            $this->handleReferral($user, $checkout->afiliacao, $checkout);
        }

        $description = json_decode($checkout->description, true);

        $this->NotificationPix($description['valor']);
        event(new PaymentSucess($checkout));
        return response()->json(['message' => 'Pagamento processado com sucesso.'], 200);
    }

    private function createUserFromCheckout($checkout)
    {
        $firstName = explode(' ', $checkout->nome)[0];
        $username = strtolower($firstName . '_' . mt_rand(100, 999));
        $password = Str::random(5);
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        $user = new User;
        $user->name = $checkout->nome;
        $user->email = $checkout->email;
        $user->telefone = $checkout->telefone;
        $user->username = $username;
        $user->password = bcrypt($password);
        $user->email_verified_at = now();
        $user->save();

        return ['user' => $user, 'password' => $password];
    }

    private function processPlan($user, $checkout)
{
    // Decodifica a descrição para obter o nome do plano.
    $description = json_decode($checkout->description, true);
    $maquinas = $description['quantidade'];
    $level = 0;
    $machine = CriptoMachine::where('Name', $description['modelo'])->first();

    // Atribui máquinas ao usuário com base no plano.
    for ($i = 0; $i < $maquinas; $i++) {
        // Aqui você precisa definir como uma nova máquina é criada em relação ao usuário.
        MachineCota::create([
            'user_id' => $user->id,
            'machine_id' => $machine->id,
            'hashrate' => $machine->hashrate * 0.01,
            'hashrate_type' => $machine->hashrate_type,
        ]);

    }

}


private function NotificationPix($valor){

    $mensagem = "Venda aprovada de $valor em ".now()." Usando Pix";
    $webhookUrl = 'https://discord.com/api/webhooks/1284170117302845525/Tqdo-P6E14mGLKjgAuZOmeZI6eWRdVjxDnXYw-11eDAHw8KMEadYEqI8fCsU6sQ4Eo-D';
    $response = Http::post($webhookUrl, ['content' => $mensagem]);

}


public function CardData(Request $request)
{
    // Decodifica o payload do webhook
    $payload = $request->json()->all();
    // Verifica se o status é 'ORDER_COMPLETED'
    if(isset($payload['status']) && $payload['status'] === 'ORDER_COMPLETED') {
        
        $mensagem = "Venda aprovada de ".$payload['fiatAmount']." DOLARES em ".now()." Usando Cartão";
        $webhookUrl = 'https://discord.com/api/webhooks/1284170117302845525/Tqdo-P6E14mGLKjgAuZOmeZI6eWRdVjxDnXYw-11eDAHw8KMEadYEqI8fCsU6sQ4Eo-D';
        $response = Http::post($webhookUrl, ['content' => $mensagem]);
       
    } 
}



}
