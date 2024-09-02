<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class OnlineUsers extends Component
{
    public $onlineUsers = [];

    public function mount()
    {
        $this->getOnlineUsers();
    }

    public function getOnlineUsers()
    {
        $this->onlineUsers = Cache::get('online-users', []);
    }

    public function render()
    {
        return view('livewire.online-users');
    }
}



