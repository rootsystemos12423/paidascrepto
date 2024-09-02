<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Keyword;
use App\Events\MessageEvent;
use App\Events\MessageDeleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OpenAIService;
use App\Models\AiPrompt;


class MessageController extends Controller
{

    protected $openAIService;

    // Injeção de dependência através do construtor
    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }


    public function index(Request $request)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'username' => 'required|string',
            'message' => 'required|string',
            'role' => 'required|string'
        ]);

        return response()->json([
            'success' => false,
            'error' => 'Chat em Manutenção.'
        ]);

        // Encontra o usuário pelo username
        $user = User::where('username', $validatedData['username'])->first();
        $keywords = Keyword::all()->pluck('keyword'); // Assume que você tem um modelo Keyword
        $validatedMsg = $validatedData['message'];

        // Normalizar a mensagem uma única vez fora do loop
        $normalizedMessage = mb_strtolower($this->removeAccents($validatedMsg), 'UTF-8');

        foreach ($keywords as $keyword) {
            $normalizedKeyword = mb_strtolower($this->removeAccents($keyword), 'UTF-8');
            if (!$user->hasRole('admin')) {
                if (mb_stripos($normalizedMessage, $normalizedKeyword) !== false) {
                    return response()->json(['success' => false, 'error' => 'Mensagem contém palavras proibidas']);
                }
            }
        }
        if($user->hasRole('banido') || $user->hasPermissionTo('banido')){
            return response()->json([
                'success' => false,
                'error' => 'Você está banido.'
            ]);
        }

        $cacheKey = 'user_last_message_time_' . $user->id;
        $waitTimeSeconds = 10; // Define o tempo de espera em segundos
        if (\Cache::has($cacheKey) && \Cache::get($cacheKey) > now()->subSeconds($waitTimeSeconds)) {
            return response()->json([
                'success' => false,
                'error' => 'Aguarde antes de enviar outra mensagem.'
            ]);
        }

        // Atualiza o cache com o horário da última mensagem enviada
        \Cache::put($cacheKey, now(), now()->addSeconds($waitTimeSeconds));


        if ($this->containsPhoneNumber($validatedData['message'])) {
            return response()->json([
                'success' => false,
                'error' => 'Não é permitido enviar numeros de telefone.'
            ]);
        }

        // Cria e salva a mensagem no banco de dados
        $message = new Message;
        $message->user_id = $user->id; // Usa o ID do usuário encontrado
        $message->message = $validatedData['message'];
        $message->save();

        // Dispara o evento para notificar os ouvintes
        event(new MessageEvent($user->username, $validatedData['message'], $validatedData['role']));

        $responseMessage = $this->handleKeywordDetectionAndResponse($user, $validatedMsg);

        // Retornar uma resposta HTTP após todo o processamento
        return response()->json([
            'success' => true,
            'message' => $responseMessage !== 'NT' ? 'Resposta enviada.' : 'NT',
        ]);
    }

    private function removeAccents($string) {
        return str_replace(
            ['á', 'é', 'í', 'ó', 'ú', 'â', 'ê', 'î', 'ô', 'û', 'ã', 'õ', 'ç', 'à', 'è', 'ì', 'ò', 'ù', 'ä', 'ë', 'ï', 'ö', 'ü', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Â', 'Ê', 'Î', 'Ô', 'Û', 'Ã', 'Õ', 'Ç', 'À', 'È', 'Ì', 'Ò', 'Ù', 'Ä', 'Ë', 'Ï', 'Ö', 'Ü'],
            ['a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'o', 'c', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'A', 'E', 'I', 'O', 'U', 'A', 'O', 'C', 'A', 'E', 'I', 'O', 'U', 'A', 'E', 'I', 'O', 'U'],
            $string
        );
    }

    private function handleKeywordDetectionAndResponse($user, $validatedMsg)
{
    // Supondo que 'dnkzineo' seja um usuário específico ou assistente.
    $userSystem = User::where('username', 'SuporteBot')->first();

    // Verifica se o usuário tem uma role e obtém a primeira role associada.
    // Supõe-se que um usuário tenha pelo menos uma role.
    $role = $userSystem->roles->first() ? $userSystem->roles->first()->name : 'Gratis';

    // Definição do contexto para a resposta da IA incluindo a role do usuário.
    $context = $this->prepareContext($validatedMsg, $userSystem);

    $prompt = $context;

    // Obtenção da resposta da IA.
    $responseMessage = $this->openAIService->generateResponse($prompt);

    if (trim($responseMessage) !== "NT") {
        $message = new Message;
        $message->user_id = $userSystem->id;
        $message->message = $responseMessage;
        $message->save();

        event(new MessageEvent($userSystem->username, $responseMessage, $role));
    }

    // Retorna apenas a mensagem de resposta ou 'NT' para o controlador
    return trim($responseMessage);
}


private function containsPhoneNumber($message)
{
    // Esta expressão regular é uma tentativa de capturar vários formatos de números de telefone
    $phoneRegex = '/\+?[0-9]{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}/';

    return (bool) preg_match($phoneRegex, $message);
}


    private function prepareContext($userMessage, $userSystem)
    {
        $aiPrompt = AiPrompt::where('desc', 'chatPrompt')->first();
    
        // Inicialize o contexto com uma string vazia para garantir que a função sempre retorne uma string.
        $context = '';
    
        if ($aiPrompt) {
            $context = $aiPrompt->prompt;
            // Concatenar diretamente é adequado aqui, mas certifique-se de que userMessage é tratado adequadamente.
            $context .= "\n\nUsuário pergunta: " . $userMessage;
        } else {
            // Decida como você quer lidar se não houver prompt. Talvez definir um contexto padrão ou retornar um erro.
            $context = "Desculpe, não foi possível carregar o contexto.";
        }
    
        return $context;
    }
    
    // Em seu MessageController ou similar
    public function delete(Request $request)
    {
        $message = Message::find($request->id);
        $user = User::where('username', $request->username)->first();

        // Certifique-se de que o usuário foi encontrado e depois verifique a role
        if ($user && ($user->hasRole('admin') || $user->hasRole('suporte'))) {
            if ($message) {
                $messageId = $message->id;
                $message->delete();
                event(new MessageDeleted($messageId));
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['error' => 'Acesso negado'], 403);
    }

}

