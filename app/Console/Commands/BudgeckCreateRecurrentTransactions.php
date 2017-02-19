<?php

namespace Budgeck\Console\Commands;

use Budgeck\Models\RecurrentTransaction;
use Budgeck\Models\Transaction;
use Illuminate\Console\Command;

class BudgeckCreateRecurrentTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'budgeck:createrecurrenttransactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create current month transactions for all recurrent transactions';

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
        $this->info('Creating transactions...');

        RecurrentTransaction::chunk(50, function ($recurrentTransactions) {
            foreach ($recurrentTransactions as $recurrentTransaction) {
                $this->info('Doing recurrent transaction '.$recurrentTransaction->id);
                Transaction::createFromRecurrentTransaction($recurrentTransaction);
            }
        });

        $this->info('Done.');
    }
}
