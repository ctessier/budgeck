<?php

use Illuminate\Database\Seeder;

class IncomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_incomes')->insert([
            [
                'id' => 1,
                'title' => 'Salaire Capgemini',
                'amount' => 1690,
                'day' => 28,
                'account_id' => 1,
                'category_id' => 2,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ]);
    }
}
