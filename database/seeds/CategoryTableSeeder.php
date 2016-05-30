<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Logement',
                'category_type_id' => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => null,
            ],
            [
                'id' => 2,
                'name' => 'Loyer',
                'category_type_id' => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Electricité',
                'category_type_id' => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Gaz',
                'category_type_id' => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 1,
            ],
            [
                'id' => 5,
                'name' => 'Eau',
                'category_type_id' => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 1,
            ],
            [
                'id' => 6,
                'name' => 'Alimentation',
                'category_type_id' => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => null,
            ],
            [
                'id' => 7,
                'name' => 'Courses',
                'category_type_id' => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 6,
            ],
            [
                'id' => 8,
                'name' => 'Restaurant',
                'category_type_id' => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 6,
            ],
            [
                'id' => 9,
                'name' => 'Salaire',
                'category_type_id' => Budgeck\Models\CategoryType::INCOME,
                'parent_category_id' => null,
            ],
            [
                'id' => 10,
                'name' => 'Remboursement',
                'category_type_id' => Budgeck\Models\CategoryType::INCOME,
                'parent_category_id' => null,
            ]
        ]);
    }
}
