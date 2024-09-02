<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function generateResponse($prompt)
{
    $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json'
        ],
        'json' => [
            'model' => "gpt-4-turbo-preview",
            'messages' => [
                [
                    'role' => "system",
                    'content' => $prompt
                ],
                [
                    'role' => "user",
                    'content' => $prompt
                ],
            ],
            'max_tokens' => 100, // Limita o retorno a 50 tokens.
        ]
    ]);

    $body = json_decode($response->getBody(), true);
    return $body['choices'][0]['message']['content'] ?? 'Desculpe, não consegui processar sua mensagem.';
}
}
