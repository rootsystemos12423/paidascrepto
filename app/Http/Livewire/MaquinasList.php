<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MachineFicticia; // Modelo de exemplo, substitua conforme necessário

class MaquinasList extends Component
{
    public $filtroCripto = 'Todas'; // Filtro padrão

    public function render()
    {
        // Buscando todas as máquinas ou filtrando por criptomoeda
        $maquinas = $this->filtroCripto === 'Todas' 
            ? MachineFicticia::all() 
            : MachineFicticia::where('algoritmo', $this->filtroCripto)->get();

        return view('livewire.maquinas-list', compact('maquinas'));
    }

    // Método para atualizar o filtro
    public function atualizarFiltro($cripto)
    {
        $this->filtroCripto = $cripto;
    }
}
