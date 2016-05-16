<?php

namespace Budgeck\Console\Commands;

use Budgeck\Models\Account;
use Budgeck\Models\AccountBudget;
use Illuminate\Console\Command;

class BudgeckPrepareMonths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'budgeck:preparemonths';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare upcoming months with accounts\' budgets and incomes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Preparing months...');

        Account::chunk(50, function($accounts) {
            foreach ($accounts as $account)
            {
                $this->info('Doing account ' . $account->id);

                AccountBudget::where('account_id', $account->id)
                    ->chunk(10, function ($budgets) {
                        foreach ($budgets as $budget)
                        {
                            $budget->createMonthsBudget();
                        }
                    });
            }
        });

        $this->info('Done.');
    }
}
