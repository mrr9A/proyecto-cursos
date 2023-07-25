<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    // agregando la ruta de la tarea automatica
    protected $commands = [
        \App\Console\Commands\CierreMes::class
    ];

    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // la cadena dentro de cron, indica la hora en la que ejecutara la tarea
        // $schedule->command('app:cierre-mes')->lastDayOfMonth('15:00');
        // $schedule->command('app:cierre-mes')->monthlyOn(1, '00:01');
        $schedule->command('app:cierre-mes')->everyMinute();
        // $schedule->command('app:cierre-mes')->cron('59 23 L * *');
        // $schedule->command('app:cierre-mes')->cron('42 12 25 * *');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
