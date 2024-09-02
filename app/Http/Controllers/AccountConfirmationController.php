<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ConfirmAccount;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AccountConfirmationController extends Controller
{

    public function index(){
        return view('auth.confirm-email');
    }


    public function validateTokenAndCod(Request $request, $token)
{
    // Validar o input
    $request->validate([
        'cod' => 'required|string|exists:account_confirmations,cod',
    ]);

    // Encontrar a entrada no banco de dados que corresponde ao 'cod' e ao 'token'
    $confirmation = DB::table('account_confirmations')
                        ->where('cod', $request->cod)
                        ->where('token', $token)
                        ->first();

    // Verificar se uma entrada correspondente foi encontrada
    if ($confirmation) {
        // Obter o email do usuário a partir da confirmação
        $user = DB::table('users')
                    ->where('email', $confirmation->email)
                    ->first();

        // Verificar se o usuário existe
        if ($user) {
            // Atualizar o campo `email_verified_at` do usuário correspondente
            DB::table('users')
                ->where('email', $user->email)
                ->update(['email_verified_at' => Carbon::now()]);

            // Logar o usuário
            Auth::loginUsingId($user->id);

            // Remover a entrada de confirmação para evitar reutilização
            DB::table('account_confirmations')
                ->where('id', $confirmation->id)
                ->delete();

            // Redirecionar o usuário para a dashboard ou área logada da plataforma
            return redirect()->route('dashboard');
        } else {
            // Usuário não encontrado
            \Log::info('Usuário não encontrado com o email: ' . $confirmation->email);
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        }
    } else {
        // Não foi encontrada uma entrada correspondente, retornar um erro
        \Log::info('Token: ' . $token . ', COD: ' . $request->cod);
        return response()->json(['error' => 'Token ou código inválido.'], 404);
    }
}



    public function sendConfirmationCode(Request $request)
    {
        $code = rand(1000, 9999); // Gera um código aleatório
        $email = $request->email;

        // Enviar email
        Mail::to($email)->send(new ConfirmAccount($code));

        // Aqui, você pode salvar o código em sessão, ou em banco de dados associado ao usuário
        session(['confirmation_code' => $code]);

        return response()->json(['message' => 'Código de verificação enviado com sucesso.']);
    }


    public function ConfirmationOnDash(){
    
     $user = Auth::User();   
    
    // Gerar token de confirmação
    $token = Str::random(60);
    $cod = Str::random(4);
    DB::table('account_confirmations')->insert([
        'email' => $user->email,
        'token' => $token,
        'cod' => $cod,
        'created_at' => now(),
    ]);

    // Enviar email de confirmação
    Mail::to($user->email)->send(new ConfirmAccount($token, $cod, $user->name));

    // Redirecionar para a view, passando o token como parâmetro
    return redirect()->route('auth.cm', ['token' => $token]);
    }


}



