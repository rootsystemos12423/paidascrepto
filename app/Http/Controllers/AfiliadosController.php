<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliados;
use App\Models\User;
use App\Models\Checkout;
use App\Models\Referral;
use Illuminate\Support\Str;



class AfiliadosController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user = User::with('afiliado')->findOrFail($user->id);
    
        // Pegando as comissões pagas do afiliado
        $comissoes = Checkout::where('afiliacao', $user->afiliado->codigo_afiliado)
            ->where('status', 'paid')
            ->get(); // Não esqueça de pegar a coleção com get()
    
        // Função para somar as quantidades a partir do campo description (JSON)
        $cotas = $this->somarQuantidades($comissoes);
    
        return view('afiliados.instrucoes', compact('user', 'comissoes', 'cotas'));
    }

    private function somarQuantidades($comissoes)
{
    $totalCotas = 0;

    foreach ($comissoes as $comissao) {
        // Decodifica o JSON na coluna 'description'
        $description = json_decode($comissao->description, true);

        // Verifica se a descrição foi decodificada corretamente e se contém 'quantidade'
        if (isset($description['quantidade'])) {
            // Converte a quantidade para número (caso esteja como string) e soma
            $totalCotas += (int) $description['quantidade'];
        }
    }

    return $totalCotas;
}



    public function bonus()
{
    $user = auth()->user();

    if (!$user->afiliado) {
        return redirect()->route('afiliacao.index');
    }

    // Supondo que o usuário tenha um relacionamento 'afiliado' que retorna um modelo com o código de afiliado
    $codigoAfiliado = $user->afiliado->codigo_afiliado;

    // Recupera todas as recompensas baseadas no código de afiliado
    $recompensas = Referral::where('affiliate_code_id', $codigoAfiliado)->get();

    return view('afiliados.bonus', compact('recompensas'));
}


    public static function CookieSaver($code){

        $afiliado = Afiliados::where('codigo_afiliado', $code)->first();
        if(!$afiliado){
            return redirect('/');
        }
        $cookie = cookie()->forever('AffiliateCodeCookie', $code);
        return redirect('/')->withCookie($cookie);

    }




}
