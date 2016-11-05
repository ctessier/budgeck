<?php

use Illuminate\Database\Seeder;

class TransactionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_types')->insert([
            'id'   => Budgeck\Models\TransactionType::EXPENSE,
            'name' => 'Expense',
        ]);

        DB::table('transaction_types')->insert([
            'id'   => Budgeck\Models\TransactionType::INCOME,
            'name' => 'Income',
        ]);
    }
}
