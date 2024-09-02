<?php

namespace App\Http\Controllers\PAYLOADERS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use App\Events\PaymentSucess;
use GuzzleHttp\Client;
use App\Models\User;
use App\Mail\PurchaseConfirmation;
use Illuminate\Support\Facades\Mail;

class UpgradePlanPayloaderController extends Controller
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

        $this->upgradeUserPlan($user);
        Mail::to($checkout->email)->send(new PurchaseConfirmation($checkout, $pedido));
        event(new PaymentSucess($checkout));
        return response()->json(['message' => 'Pagamento processado com sucesso.'], 200);
    }

    private function upgradeUserPlan($user)
    {
        // Salvando as roles atuais para verificação após remoção
        $isLion = $user->hasRole('lion');
        $isBear = $user->hasRole('bear');
    
        // Removendo todas as roles atuais do usuário
        $user->roles()->detach();
    
        if($isLion){
            $user->assignRole('shark');
            for ($i = 0; $i < 4; $i++) {
                $user->miningMachines()->create([
                    'level' => 3,
                ]);
            }
        }
        elseif($isBear){
            $user->assignRole('lion');
            for ($i = 0; $i < 3; $i++) {
                $user->miningMachines()->create([
                    'level' => 2,
                ]);
            }
        } else {
            throw new \Exception('Plano não encontrado');
        }
    }    
}
