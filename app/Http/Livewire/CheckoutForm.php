<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class CheckoutForm extends Component
{
    public $txId;
    public $nome;
    public $cpf;
    public $telefone;
    public $email;

    public function mount($txId)
{
    $this->txId = $txId;
    $checkout = Checkout::where('txId', $this->txId)->first();
    // Simplesmente deixa as propriedades vazias se não encontrar o checkout
    $this->nome = '';
    $this->cpf = '';
    $this->telefone = '';
    $this->email = '';
}



    public function updated($propertyName)
    {
        // Formatar CPF e Telefone para conter apenas números
        if ($propertyName === 'cpf' || $propertyName === 'telefone') {
            $this->{$propertyName} = preg_replace('/\D/', '', $this->{$propertyName});
        }

        $checkout = Checkout::where('txId', $this->txId)->firstOrFail();

        if (in_array($propertyName, ['nome', 'cpf', 'telefone', 'email'])) {
            $checkout->{$propertyName} = $this->{$propertyName};
            $checkout->save();
        }
    }

    public function render()
    {
        return view('livewire.checkout-form');
    }
}


