<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class CaptchaController extends Controller
{
    public function generate()
{
    // Gera um texto aleatório para o CAPTCHA
    $captchaText = strtoupper(Str::random(4));

    // Salva o texto na sessão
    Session::put('captcha_text', $captchaText);
    Session::save(); // Assegura que a sessão seja salva no banco de dados

    // Gera e retorna a imagem do CAPTCHA
    $image = imagecreate(120, 40);
    $bgColor = imagecolorallocate($image, 255, 255, 255);
    $textColor = imagecolorallocate($image, 0, 0, 0);
    imagestring($image, 5, 10, 10, $captchaText, $textColor);

    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();

    imagedestroy($image);

    return response($imageData, 200)
        ->header('Content-Type', 'image/png');
}


    // Método para verificar o CAPTCHA
    public function verify(Request $request)
{

    $request->validate(['captcha' => 'required']);
    $captchaFromSession = Session::get('captcha_text');
    
    if ($request->input('captcha') === $captchaFromSession) {
        Cookie::queue('captcha_verified', true, 1440);
        return redirect('/')->with('success', 'Verificação bem-sucedida!');
    }

    return back()->withErrors(['captcha' => 'CAPTCHA incorreto, tente novamente.']);
}

}
