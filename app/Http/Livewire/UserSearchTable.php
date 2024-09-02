<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserSearchTable extends Component
{
    use WithPagination;

    public $searchTerm = '';

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $users = User::where('username', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm)
                    ->paginate(10);

        return view('livewire.user-search-table', ['users' => $users]);
    }
}
