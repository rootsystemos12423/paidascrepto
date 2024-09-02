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
use App\Mail\UserCredentials;
use App\Models\Afiliados;
use App\Models\Referral;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


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
    $plano = $description['plan']['name'];
    $maquinas = 0;
    $level = 0;

    // Atribui valores baseados no plano.
    switch ($plano) {
        case 'Shark':
        case 'Shark 20% OFF': 
            $maquinas = 4;
            $level = 3;
            $user->assignRole('shark');
            break;
        case 'Lion':
            $maquinas = 3;
            $level = 2;
            $user->assignRole('lion');
            break;
        case 'Bear':
            $maquinas = 2;
            $level = 2;
            $user->assignRole('bear');
            break;
        default:
            throw new \Exception('Plano não encontrado');
    }

    // Atribui máquinas ao usuário com base no plano.
    for ($i = 0; $i < $maquinas; $i++) {
        // Aqui você precisa definir como uma nova máquina é criada em relação ao usuário.
        // Este é apenas um exemplo e você deve ajustá-lo conforme seu modelo de dados.
        $user->miningMachines()->create([
            'level' => $level,
        ]);
    }

}

private function handleReferral($user, $referralCode, $checkout)
{
    $referrer = Afiliados::where('codigo_afiliado', $referralCode)->first();
    if ($referrer) {
        $description = json_decode($checkout->description, true);
        $plano = $description['plan']['name'];
        $desc = 0;

        // Determina o nível da máquina com base no plano do indicado
        switch ($plano) {
            case 'Shark':
            case 'Shark 20% OFF': 
                $desc = 'rec3';
                break;
            case 'Lion':
                $desc = 'rec2';
                break;
            case 'Bear':
                $desc = 'rec1';
                break;
            default:
                throw new \Exception('Plano não encontrado');
        }

        // Criar uma máquina para o referenciador com base no nível determinado
        $referrerUser = User::find($referrer->user_id);
        if ($referrerUser) {
            $referral = new Referral;
            $referral->affiliate_code_id = $referralCode;
            $referral->referred_user_id = $user->id;
            $referral->reffer_status = 'Unclaimed';
            $referral->item_purchased = $desc;
            $referral->save();
        }
    }
}


}
