<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\FacebookConversionService;
use App\Models\Checkout;
use App\Models\Pixel;


class FacebookTrack
{
    protected $conversionService;

    public function __construct(FacebookConversionService $conversionService)
    {
        $this->conversionService = $conversionService;
    }

    public function handle(Request $request, Closure $next)
{
    $response = $next($request);

    // Verifica se há pixels registrados
    $pixels = Pixel::all();
    if ($pixels->isEmpty()) {
        return $response;
    }

    $url = $request->url();
    $eventData = $this->getEventData($request);

    if (strpos($url, '/checkout/payment/') !== false) {
        $this->conversionService->sendEvent('InitiateCheckout', $eventData);
    } elseif (strpos($url, '/payment/success/') !== false) {
        $this->conversionService->sendEvent('Purchase', $eventData);
    }

    return $response;
}


    protected function getEventData(Request $request)
    {
        $checkoutId = $this->extractCheckoutId($request->url());
        $checkout = Checkout::find($checkoutId);


        if(isset(json_decode($checkout->description, true)['plan'])) {
            $value = json_decode($checkout->description, true)['plan']['value'];
        } elseif(isset(json_decode($checkout->description, true)['maquinas'])) {
            $value = json_decode($checkout->description, true)['maquinas']['value'];
        } elseif(isset(json_decode($checkout->description, true)['upgradeMaquinas'])) {
            $value = json_decode($checkout->description, true)['upgradeMaquinas']['value'];
        } elseif(isset(json_decode($checkout->description, true)['salaData'])) {
            $value = json_decode($checkout->description, true)['salaData']['value'];
        } elseif(isset(json_decode($checkout->description, true)['UpgradePlanData'])) {
            $value = json_decode($checkout->description, true)['UpgradePlanData']['value'];
        }else {
            $value = null;
        }

        if ($checkout) {
            list($firstName, $lastName) = $this->splitName($checkout->nome);
            
            if($request->cookie('_fbp')){
                $data = [
                    'external_id' => $checkout->payment->order_id,
                    'email' => $checkout->email,
                    'phone' => $checkout->telefone,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'fbc' => $checkout->fbc ?? $request->cookie('_fbc'),
                    'fbp' => $checkout->fbp ?? $request->cookie('_fbp'),
                    'user_ip' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                    'value' => $value,
                    'event_source_url' => $request->url(),
                ];

                return $data;
            }

        }

        return [];
    }

    protected function extractCheckoutId($url)
    {
        // Extraia o ID do checkout a partir da URL
        // Supondo que o ID é a última parte da URL
        $parts = explode('/', $url);
        return end($parts);
    }

    protected function splitName($fullName)
    {
        $nameParts = explode(' ', $fullName);
        $firstName = array_shift($nameParts);
        $lastName = implode(' ', $nameParts);

        return [$firstName, $lastName];
    }
}

