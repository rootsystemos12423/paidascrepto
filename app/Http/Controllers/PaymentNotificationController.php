<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;


class PaymentNotificationController extends Controller
{
    public function receiveNotification(Request $request)
    {       
            $responseBody = $request->all();
                // Você deve verificar se o responseBody e as chaves necessárias existem.
                if (!isset($responseBody['data']['status']) || !isset($responseBody['data']['code'])) {
                    return response()->json(['error' => 'Não foi possível encontrar o ID do pedido no payload.'], 400);
                }

                $transactionId = $responseBody['data']['code'];
                $pedido = Payment::where('order_id', $transactionId)->first();

                if ($responseBody['data']['status'] !== 'PAID') {
                    return response()->json(['message' => 'Status não é pago.'], 400);
                }

                if (!$pedido) {
                    return response()->json(['error' => 'Pedido não encontrado.'], 404);
                }

                if($pedido->checkout->status === 'paid'){
                    return response()->json(['message' => 'Pedido ja pago'], 400);
                }

                $amountInCents = $responseBody['data']['amount'];
                $amountInReais = $amountInCents / 100;

                // Formatar o valor para reais com 2 casas decimais, usando vírgula como separador decimal e ponto como separador de milhar
                $formattedAmount = number_format($amountInReais, 2, ',', '.');


                $mensagem = "Venda aprovada de $formattedAmount em ".now()."";
                $webhookUrl = 'https://discord.com/api/webhooks/1248991558103994428/zPO4xgeU0p60hwrMGfGePHoIsJP2KpgnAj2y1-tINFMXpK1IgCpiqY6151ArFVc05cJE';
                $response = Http::post($webhookUrl, ['content' => $mensagem]);

                $description = json_decode($pedido->checkout->description, true);

                $response->getBody();

                $url = '';
                if (isset($description['plan'])) {
                    $url = '/api/process/plan/order';
                } elseif (isset($description['maquinas'])) {
                    $url = '/api/process/maquinas/order';
                } elseif (isset($description['salaData'])) {
                    $url = '/api/process/salas/order';
                } elseif (isset($description['upgradeMaquinas'])) {
                    $url = '/api/process/maquinasUp/order';
                } elseif (isset($description['UpgradePlanData'])) {
                    $url = '/api/process/planUpgrade/order';
                } else {
                    return response()->json(['error' => 'Tipo de compra não identificado'], 400);
                }
                
                // Envia a requisição POST para a URL adequada
                $response = Http::post(url($url), $responseBody);
                
                // Retorna a resposta recebida do controller destinatário
                return $response;
    }
}
