<?php

use Illuminate\Database\Seeder;

class AccountBudgetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = DB::table('accounts')->get();

        foreach ($accounts as $account)
        {
            if ($account->account_type_id === Budgeck\Models\AccountType::CHECKING)
            {
                factory(Budgeck\Models\AccountBudget::class, 3)->create([
                    'account_id' => $account->id,
                ]);
            }
        }
    }
}
