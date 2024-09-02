<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Certifique-se de que o nome do comando corresponde à assinatura definida no comando.
        $schedule->command('update:maquinas')->hourly();
        $schedule->command('distribute:mining-rewards')->everyFifteenMinutes();
        $schedule->command('miningrooms:delete-expired')->hourly();
        $schedule->command('balance:update-daily')->everyFifteenMinutes();
        $schedule->command('rooms:delete-expired')->dailyAt('00:00');
        $schedule->command('email:marketing')->dailyAt('12:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
