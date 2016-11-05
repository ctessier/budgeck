<?php

use Illuminate\Database\Seeder;

class CategoryTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_types')->insert([
            'id'   => Budgeck\Models\CategoryType::EXPENSE,
            'name' => 'Expense',
        ]);

        DB::table('category_types')->insert([
            'id'   => Budgeck\Models\CategoryType::INCOME,
            'name' => 'Income',
        ]);
    }
}
