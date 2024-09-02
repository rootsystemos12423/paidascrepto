<?php

namespace App\Http\Controllers\PAYLOADERS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use GuzzleHttp\Client;
use App\Events\PaymentSucess;
use App\Models\User;
use App\Models\UserContribution;
use App\Models\MiningMachine;
use Carbon\Carbon;
use App\Mail\PurchaseConfirmation;
use Illuminate\Support\Facades\Mail;

class SalasPayloaderController extends Controller
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

        $this->addMiningRoomsToUser($user, $checkout);
        Mail::to($checkout->email)->send(new PurchaseConfirmation($checkout, $pedido));
        event(new PaymentSucess($checkout));
        return response()->json(['message' => 'Pagamento processado com sucesso.'], 200);
    }

    private function addMiningRoomsToUser($user, $checkout)
    {
        $description = json_decode($checkout->description, true);
        $durationInMinutes = match ($description['salaData']['duration']) {
            '15' => 15,
            '30' => 30,
            '50' => 60,
            '100' => 120,
            default => 0
        };

        // Cria a sala de mineração e associa ao usuário.
        $room = $user->miningRooms()->create([
            'capacity' => $description['salaData']['capacity'],
            'end_date' => $durationInMinutes > 0 ? Carbon::now()->addMinutes($durationInMinutes) : null,
            'role_allowed' => 'todos',
        ]);

        // Puxa as máquinas do usuário
        $machines = MiningMachine::where('user_id', $user->id)->get();

        // Soma o poder de mineração com base no nível de cada máquina
        $contributionPower = 0;
        foreach ($machines as $machine) {
            switch ($machine->level) {
                case 1:
                    $contributionPower += 200;
                    break;
                case 2:
                    $contributionPower += 300;
                    break;
                case 3:
                    $contributionPower += 400;
                    break;
                case 4:
                    $contributionPower += 900;
                    break;
            }
        }
        // Cria a contribuição para o usuário com o poder total calculado
        UserContribution::create([
            'user_id' => $user->id,
            'mining_room_id' => $room->id,
            'contribution_power' => $contributionPower,
        ]);


    }




}