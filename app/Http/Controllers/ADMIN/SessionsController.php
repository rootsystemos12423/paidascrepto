<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session;

class SessionsController extends Controller
{
    public function index()
{
    // Ordena os registros da tabela de sessões por 'last_activity' em ordem decrescente e define o número de itens por página, por exemplo, 10
    $sessions = Session::orderBy('last_activity', 'desc')->paginate(50);

    return view('admin.sessions', compact('sessions'));
}


public function indexOnlines(){


    return view('admin.onlines');
}
}
