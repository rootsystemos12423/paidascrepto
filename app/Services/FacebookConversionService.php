<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Pixel;
use Illuminate\Support\Facades\Request;

class FacebookConversionService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function sendEvent($eventName, $eventData)
    {
        $pixels = Pixel::all();
        foreach ($pixels as $pixel) {
        $url = "https://graph.facebook.com/v11.0/{$pixel->pixel_id}/events";
    
            $data = [
                'access_token' => $pixel->token,
                'data' => [
                    [
                        'event_name' => $eventName,
                        'event_time' => time(),
                        'action_source' => 'website',
                        'user_data' => [
                            'em' => hash('sha256', $eventData['email']),
                            'ph' => hash('sha256', $eventData['phone']),
                            'fn' => hash('sha256', $eventData['first_name']),
                            'ln' => hash('sha256', $eventData['last_name']),
                            'client_ip_address' => $eventData['user_ip'],
                            'client_user_agent' => $eventData['user_agent'],
                            'external_id' => $eventData['external_id'],
                            'fbc' => $eventData['fbc'],
                            'fbp' => $eventData['fbp'],
                        ],
                        'custom_data' => [
                            'currency' => 'BRL',
                            'value' => $eventData['value'],
                        ],
                        'event_source_url' => $eventData['event_source_url'],
                    ],
                ],
            ];

            $url .= '?' . http_build_query($data);
        
            $response = $this->client->post($url);    
        }
    
        return json_decode($response->getBody(), true);
    }
}
