<?php

use Illuminate\Database\Seeder;

class BudgetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('budget_types')->insert([
            [
                'id' => 1,
                'name' => 'Dépense unique',
                'description' => 'Représente un budget ne content qu\'une seule dépense.',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'id' => 2,
                'name' => 'Dépense multiple',
                'description' => 'Représente un budget contenant plusieurs dépenses.',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ]);
        
        DB::table('account_budgets')->insert([
            [
                'id' => 1,
                'title' => 'Loyer',
                'description' => '',
                'amount' => 571.3,
                'day' => 11,
                'account_id' => 1,
                'budget_type_id' => 1,
                'category_id' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ]);
    }
}
