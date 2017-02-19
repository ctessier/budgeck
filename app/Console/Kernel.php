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
        \Budgeck\Console\Commands\BudgeckCreateRecurrentTransactions::class,
        \Budgeck\Console\Commands\BudgeckUpdateRecurrentTransactions::class,
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
        // Schedule budgeck preparemonths
        $schedule->command('budgeck:preparemonths')->monthly()->at('01:00');

        // Schedule budgeck create recurrent transactions
        $schedule->command('budgeck:createrecurrenttransactions')->monthly()->at('02:00');

        // Schedule budgeck update recurrent transactions
        $schedule->command('budgeck:updaterecurrenttransactions')->dailyAt('03:00');
    }
}
