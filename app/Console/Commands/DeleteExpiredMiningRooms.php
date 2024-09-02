<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MiningRoom;
use Carbon\Carbon;

class DeleteExpiredMiningRooms extends Command
{
    protected $signature = 'miningrooms:delete-expired';
    protected $description = 'Delete expired mining rooms.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();
        $expiredRooms = MiningRoom::where('end_date', '<=', $now)->get();

        foreach ($expiredRooms as $room) {
            $this->info("Deleting room: {$room->id}");
            $room->delete();
        }

        $this->info('Expired rooms deletion completed.');
        return 0;
    }
}
