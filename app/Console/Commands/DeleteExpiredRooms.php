<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MiningRoom;
use App\Models\Message; // Certifique-se de que este é o modelo correto para sua tabela de mensagens
use Carbon\Carbon;

class DeleteExpiredRooms extends Command
{
    protected $signature = 'rooms:delete-expired';
    protected $description = 'Delete all expired mining rooms and their related messages from the messages table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $rooms = MiningRoom::where('end_date', '<', Carbon::now())->get();
        $countRooms = 0;
        $countMessages = 0;

        foreach ($rooms as $room) {
            $room->delete();
            $countRooms++;
        }

        $messages = Message::all();

        foreach ($messages as $message) {
            $message->delete();
            $countMessages++;
        }

        $this->info("Deleted $countRooms expired rooms and $countMessages related messages.");
    }
}
