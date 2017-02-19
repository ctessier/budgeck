<?php

namespace Budgeck\Console\Commands;

use Budgeck\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BudgeckUpdateRecurrentTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'budgeck:updaterecurrenttransactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update current month recurrent transactions with a value date';

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
        $this->info('Updating transactions...');

        $yesterday = Carbon::yesterday();
        Transaction::whereNotNull('recurrent_transaction_id')
            ->where('transaction_date', $yesterday->toDateString())
            ->whereNull('value_date')
            ->chunk(50, function ($transactions) {
                foreach ($transactions as $transaction) {
                    $this->info('Doing transaction '.$transaction->id);
                    $transaction->value_date = $transaction->transaction_date;
                    $transaction->save();
                }
            });

        $this->info('Done.');
    }
}
