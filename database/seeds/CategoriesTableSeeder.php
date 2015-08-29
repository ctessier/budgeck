<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_types')->insert([
            [
                'id' => 1,
                'name' => 'Dépense',
                'description' => '',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'id' => 2,
                'name' => 'Revenu',
                'description' => '',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ]);
        
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Logement',
                'category_type_id' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'id' => 2,
                'name' => 'Salaire',
                'category_type_id' => 2,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]            
        ]);
    }
}
