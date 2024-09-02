<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IpInfoService
{
    protected $token;

    public function __construct()
    {
        $this->token = env('IPINFO_TOKEN');
    }

    public function getIpInfo($ip)
    {
        $response = Http::get("https://ipinfo.io/{$ip}?token={$this->token}");

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
