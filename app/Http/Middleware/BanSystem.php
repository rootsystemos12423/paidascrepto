<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\IpInfoService;
use App\Models\IpDetail;

class BanSystem
{
    protected $ipInfoService;

    public function __construct(IpInfoService $ipInfoService)
    {
        $this->ipInfoService = $ipInfoService;
    }

    public function handle(Request $request, Closure $next)
    {
        $userAgent = $request->header('User-Agent');
        $ip = $request->ip();
        $currentUserId = auth()->check() ? auth()->user()->id : null;
    
        // Verifique se a sessão 'impersonate' está ativa
        $isImpersonating = session()->has('impersonate');
    
        // Verifique se a combinação de IP e usuário já existe
        $ipSave = IpDetail::where('ip', $ip)->where('user_id', $currentUserId)->first();
    
        if (!$ipSave) {
            // Verifique se o IP já existe para qualquer usuário
            $existingIpDetail = IpDetail::where('ip', $ip)->first();
            if ($existingIpDetail && $existingIpDetail->banned) {
                return abort(404, 'PÁGINA NÃO ENCONTRADA');
            }
    
            // Se a combinação IP/usuário não existe, salve-a, a menos que esteja em modo de impersonação
            if (!$isImpersonating) {
                $ipInfo = $this->ipInfoService->getIpInfo($ip);
                if ($ipInfo) {
                    $ipSave = new IpDetail();
                    $ipSave->ip = $ip;
                    $ipSave->hostname = $ipInfo['hostname'] ?? $ip;
                    $ipSave->city = $ipInfo['city'] ?? null;
                    $ipSave->region = $ipInfo['region'] ?? null;
                    $ipSave->country = $ipInfo['country'] ?? null;
                    $ipSave->timezone = $ipInfo['timezone'] ?? null;
                    $ipSave->org = $ipInfo['org'] ?? null;
                    $ipSave->blocked = false;
                    $ipSave->user_id = $currentUserId;
                    $ipSave->user_agent = $userAgent;
                    $ipSave->save();
                }
            }
        } else {
            if ($ipSave->banned) {
                return abort(404, 'PÁGINA NÃO ENCONTRADA');
            }
        }
    
        return $next($request);
    }
    
    protected function isFacebookBot($userAgent, $ip)
    {
        $facebookBots = [
            'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)',
            'facebookexternalhit/1.1',
            'Facebot',
            'facebookcatalog/1.0'
        ];

        foreach ($facebookBots as $bot) {
            if (strpos($userAgent, $bot) !== false || $this->isFromFacebookDomain($ip)) {
                return true;
            }
        }

        return false;
    }

    protected function isGoogleBot($hostname)
    {
        return strpos($hostname, 'googlebot.com') !== false || strpos($hostname, 'google.com') !== false;
    }

    protected function isFromFacebookDomain($ip)
    {
        $hostname = gethostbyaddr($ip);
        return substr($hostname, -strlen('facebook.com')) === 'facebook.com';
    }
}
