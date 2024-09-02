<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Payment;

class PedidosController extends Controller
{
    public function index()
    {
        // Ordena os registros por 'created_at' em ordem decrescente e define o número de itens por página, por exemplo, 10
        $pedidos = Checkout::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pedidos', compact('pedidos'));
    }
  

    public function moreinfo($id)
    {
        // Ordena os registros por 'created_at' em ordem decrescente e define o número de itens por página, por exemplo, 10
        $pedido = Checkout::FindOrfail($id);

        return view('admin.pedidoinfo', compact('pedido'));
    }
}
