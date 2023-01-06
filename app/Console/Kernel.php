<?php

namespace App\Console;

use App\Jobs\JobReminder;
use App\Jobs\JobReminderLecturer;
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
        // $schedule->command('inspire')->hourly();
        $schedule->command('queue:retry all')
        ->twiceDaily(9, 15)->runInBackground();
        $schedule->job(new JobReminder)->days([1,2,3,4,5,6])->at('07:00')->runInBackground();
        $schedule->job(new JobReminderLecturer)->days([1,3,5])->at('13:00')->runInBackground();
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
