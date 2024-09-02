<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AiPrompt;

class ChatPrompt extends Component
{
    public $prompt;
    public $promptId;
    public $message = '';  // Propriedade para armazenar a mensagem de feedback

    public function mount()
    {
        $aiPrompt = AiPrompt::where('desc', 'chatPrompt')->first();
        
        if ($aiPrompt) {
            $this->prompt = $aiPrompt->prompt;
            $this->promptId = $aiPrompt->id;
        }
    }

    public function updatedPrompt()
    {
        $aiPrompt = AiPrompt::where('desc', 'chatPrompt')->first();

        if ($aiPrompt) {
            $aiPrompt->prompt = $this->prompt;
            $aiPrompt->save();
            $this->message = 'Prompt atualizado com sucesso!';  // Atualiza a mensagem
        }
    }

    public function render()
    {
        return view('livewire.chat-prompt');
    }
}

