<?php

namespace App\Console;

use App\Jobs\NewsJob;
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
        $schedule->call(function () {
            dispatch(new NewsJob('topstories'));
            info('Fetching top stories...');
            dispatch(new NewsJob('newstories'));
            info('Fetching new stories...');
            dispatch(new NewsJob('beststories'));
            info('Fetching best stories...');
        })->everyFiveMinutes()
        ->appendOutputTo(storage_path('logs/schedule.log'));;
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
