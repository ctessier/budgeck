<?php

namespace Budgeck\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Budgeck\Console\Commands\Inspire::class,
        \Budgeck\Console\Commands\BudgeckPrepareMonths::class,
        \Budgeck\Console\Commands\BudgeckCreateUser::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Launch budgeck preparemonths command the 1st of each month, at 1 AM
        $schedule->command('budgeck:preparemonths')->cron('* 1 1 * * *');
    }
}
