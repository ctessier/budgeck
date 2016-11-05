<?php

use Illuminate\Database\Seeder;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $budgets = DB::table('budgets')->where([
            'month' => date('m'),
            'year'  => date('Y'),
        ])->get();

        foreach ($budgets as $budget) {
            factory(Budgeck\Models\Transaction::class, 'expense', $faker->numberBetween(1, 5))->create([
                'budget_id'  => $budget->id,
                'account_id' => $budget->account_id,
                'month'      => $budget->month,
                'year'       => $budget->year,
            ]);
        }

        $accounts = DB::table('accounts')->get();

        foreach ($accounts as $account) {
            factory(Budgeck\Models\Transaction::class, 'income', $faker->numberBetween(1, 3))->create([
                'account_id' => $account->id,
            ]);
        }
    }
}
