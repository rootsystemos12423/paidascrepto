<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MiningRoom;
use Illuminate\Support\Facades\DB;

class RoomList extends Component
{
    use WithPagination;

    public $searchTerm;

    public function deleteRoom($roomId)
    {
        $room = MiningRoom::find($roomId);
        
        if ($room) {
            $room->delete();
            $this->emit('roomDeleted'); // Emitir evento para capturar no front-end.
        }
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $rooms = MiningRoom::query()
            ->join('users', 'mining_rooms.owner_id', '=', 'users.id')
            ->where(function($query) use ($searchTerm) {
                $query->where('users.username', 'like', $searchTerm)
                      ->orWhere('users.email', 'like', $searchTerm);
            })
            ->select('mining_rooms.*') // Evite selecionar todos os campos para não haver sobreposição.
            ->paginate(10);

        return view('livewire.room-list', compact('rooms'));
    }
}
