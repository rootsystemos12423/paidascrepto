<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Http;
use App\Models\Afiliados;


class CheckoutController extends Controller
{
    public function index(Request $request, $id)
{   
    // Finalize a consulta usando first() para obter o primeiro resultado correspondente
    $checkout = Checkout::where('txId', $id)->first();

    $description = json_decode($checkout->description, true);

    return view('checkout.welcome', compact('checkout', 'description'));
}
    

    public function indexPayment($id)
    {
        $payment = Payment::where('checkout_id', $id)->firstOrFail();

        $description = json_decode($payment->checkout->description, true);

        // Se o checkout for encontrado, passa os dados para a view.
        return view('checkout.payment', compact('payment', 'description'));
    }


    public function indexSucess($id)
    {
        $payment = Payment::where('checkout_id', $id)->firstOrFail();

        $description = json_decode($payment->checkout->description, true);

        // Se o checkout for encontrado, passa os dados para a view.
        return view('checkout.sucess',  compact('payment', 'description'));
    }



    public function createOrder(Request $request)
    {
        // Valida os dados recebidos do request
        $validatedData = $request->validate([
            'fornecedor' => 'required|string',
            'modelo' => 'required|string',
            'quantidade' => 'required|integer',
            'valor' => 'required|string',
            'contato' => 'required|string',
            'lingua' => 'required|string',
            'telefone' => 'required|string',
            'email' => 'required|string'
        ]);
    
        // Cria uma nova instância de Checkout
        $checkout = new Checkout;
    
        // Gera um txId único, você pode adaptar conforme necessário
        $txId = 'TX' . strtoupper(uniqid());
    
        // Converte o valor para um número (removendo o símbolo de moeda, por exemplo)
        $valor = floatval(str_replace(',', '.', str_replace('.', '', preg_replace('/[^\d,]/', '', $validatedData['valor']))));
    
        // Calcula a taxa de serviço (10% do valor)
        $taxaServico = $valor * 0.10;
    
        // Calcula o imposto (6% do valor)
        $imposto = $valor * 0.06;
    
        // Organiza os dados do plano em um array, incluindo a taxa de serviço e o imposto
        $planData = [
            'fornecedor' => $validatedData['fornecedor'],
            'modelo' => $validatedData['modelo'],
            'quantidade' => $validatedData['quantidade'],
            'valor' => $validatedData['valor'], // Valor original formatado
            'taxaServico' => number_format($taxaServico, 2, ',', '.'), // Taxa de Serviço formatada
            'imposto' => number_format($imposto, 2, ',', '.'), // Imposto formatado
            'contato' => $validatedData['contato'],
            'lingua' => $validatedData['lingua'],
            'telefone' => $validatedData['telefone'],
            'email' => $validatedData['email']
        ];

        if($request->hasCookie('AffiliateCodeCookie')){
            $checkout->afiliacao = $request->cookie('AffiliateCodeCookie');
        }
    
        // Atribui valores ao modelo. Os valores são coletados do request validado.
        $checkout->txId = $txId;
        $checkout->description = json_encode($planData); // Converte o array para JSON
        $checkout->save();
    
        // Retorna uma resposta ou redireciona o usuário para a página de checkout
        return redirect()->route('checkout', ['id' => $checkout->txId]);
    }    
    


    public function processPayment(Request $request)
    {
        try {
            // Validar os dados de entrada
            $request->validate([
                'nome' => 'required',
                'cpf' => 'required', 
                'telefone' => 'required',
                'email' => 'required|email',
                'conf_email' => 'required|same:email',
            ]);
    

            // Gerar um ID único para o pedido
            $order_id = uniqid();
    
            // Localizar o checkout com base no txId
            $checkout = Checkout::where('txId', $request->txId)->firstOrFail();
    
            // Atualizar os dados no checkout
            $checkout->update([
                'cpf' => $request->cpf,
                'nome' => $request->nome,
                'telefone' => $request->telefone,
                'email' => $request->email,
            ]);
    
            // Verificar afiliado, se fornecido
            if ($request->afid !== null) {
                $afiliado = Afiliados::where('codigo_afiliado', $request->afid)->first();
                if ($afiliado) {
                    $checkout->afiliacao = $request->afid;
                    $checkout->save();
                }
            }
    
            // Obter a descrição do checkout como array
            $description = json_decode($checkout->description, true);
    
            // URL para chamada da API
            $url = "https://api.sqala.tech/core/v1/pix-qrcode-payments";
    
            // Processar os dados do pagamento
            return $this->processPaymentData($request, $description, $order_id, $checkout, $url);
    
        } catch (\Exception $e) {
            // Registrar erro detalhado
            Log::error('Erro ao processar pagamento', [
                'error_message' => $e->getMessage(),
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);
    
            // Retornar resposta de erro
            return response()->json(['error' => 'Erro ao processar pagamento: ' . $e->getMessage()], 500);
        }
    }
    
    private function processPaymentData($request, $description, $order_id, $checkout, $url)
    {
        try {
            // Gerar chave de idempotência única
            $idempotencyKey = Uuid::uuid4()->toString();
    
            // Instanciar cliente Guzzle
            $client = new \GuzzleHttp\Client();
    
            // Separar nome completo em primeiro nome e sobrenome
            $nomeCompleto = explode(" ", $request->nome, 2);
            $primeiroNome = $nomeCompleto[0];
            $sobrenome = $nomeCompleto[1] ?? '';
    
            // Extrair DDD e telefone formatado
            $telefoneFormatado = preg_replace('/\D/', '', $request->telefone);
            $ddd = substr($telefoneFormatado, 0, 2);
            $telefone = substr($telefoneFormatado, 2);
    
            // Gerar um email randômico para processamento
            $randomEmail = $this->generateRandomEmail($request->email);
    
            // Processar valores (valor, taxa de serviço e imposto)
            $orderValue = $this->parseCurrency($description['valor']);
            $taxaServico = $this->parseCurrency($description['taxaServico']);
            $imposto = $this->parseCurrency($description['imposto']);
    
            // Calcular o valor total e formatar
            $totalValue = $orderValue + $taxaServico + $imposto;
            $orderValueInCents = intval($totalValue * 100); // Converter para centavos
    
            // Dados para pagamento
            $data = [
                'amount' => $orderValueInCents,
                'code' => $order_id,
            ];
    
            // Obter token de acesso da API
            $token = $this->getAccessToken();
    
            // Enviar solicitação POST para API
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ]);
    
            // Verificar resposta da API
            if ($response->getStatusCode() !== 200) {
                throw new \Exception('Falha na solicitação POST: ' . $response->getBody());
            }
    
            // Decodificar resposta JSON
            $responseBody = json_decode($response->getBody(), true);
            $qr_code = base64_encode($responseBody['payload']);
    
            // Verificar se order_id e checkout_id estão definidos
            if (!isset($order_id) || !isset($checkout->id)) {
                throw new \Exception('order_id ou checkout_id não definidos');
            }
    
            // Salvar pagamento
            Payment::create([
                'order_id' => $order_id,
                'status' => 'pending',
                'due_date' => now(),
                'pix_code_url' => $responseBody['payload'],
                'pix_code_base64' => $qr_code,
                'checkout_id' => $checkout->id,
            ]);
    
            // Redirecionar para a rota de pagamento do checkout
            return redirect()->route('checkout.payment', ['id' => $checkout->id]);
    
        } catch (\Exception $e) {
            // Registrar erro detalhado
            Log::error('Erro ao processar pagamento', [
                'error_message' => $e->getMessage(),
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);
    
            // Retornar resposta de erro
            return response()->json(['error' => 'Erro ao se conectar com a API: ' . $e->getMessage()], 500);
        }
    }
    
    // Função auxiliar para parse de valores monetários
    private function parseCurrency($value)
    {
        return floatval(str_replace(',', '.', str_replace('.', '', preg_replace('/[^\d,]/', '', $value))));
    }
    
    // Função para gerar um email randômico
    private function generateRandomEmail($baseEmail)
    {
        list($username, $domain) = explode('@', $baseEmail);
        $randomNumber = rand(1000, 9999);
        return $username . $randomNumber . '@' . $domain;
    }
    
    // Função para obter access token da API
    private function getAccessToken()
    {
        $appId = env('APP_ID_SQALA');
        $appSecret = env('APP_SECRET');
        $refreshToken = env('REFRESH_TOKEN');
    
        $base64Credentials = base64_encode("{$appId}:{$appSecret}");
    
        // Enviar solicitação POST para obter token de acesso
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $base64Credentials,
            'Content-Type' => 'application/json',
        ])->post('https://api.sqala.tech/core/v1/access-tokens', [
            'refreshToken' => $refreshToken,
        ]);
    
        // Verificar resposta da API
        if ($response->failed()) {
            throw new \Exception('Falha ao obter access token: ' . $response->body());
        }
    
        // Decodificar resposta JSON
        $dataResponse = $response->json();
        $token = $dataResponse['token'] ?? null;
    
        // Verificar se o token foi obtido corretamente
        if (!$token) {
            throw new \Exception('Access token não encontrado na resposta');
        }
    
        return $token;
    }
    
    
}

