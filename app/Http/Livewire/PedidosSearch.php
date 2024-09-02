<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Checkout;

class PedidosSearch extends Component
{
    use WithPagination;

    
    public $searchTerm;

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $pedidos = Checkout::where('email', 'like', $searchTerm)
                    ->orWhere('cpf', 'like', $searchTerm)
                    ->orWhere('telefone', 'like', $searchTerm)
                    ->orWhere('nome', 'like', $searchTerm)
                    ->orWhereHas('payment', function($query) use ($searchTerm) {
                        $query->where('order_id', 'like', $searchTerm);
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('livewire.pedidos-search', [
            'pedidos' => $pedidos,
        ]);
    }
}
