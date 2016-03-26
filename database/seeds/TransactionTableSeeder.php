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
        DB::table('transaction_types')->insert([
            [
                'id' => 1,
                'name' => 'Dépense'
            ],
            [
                'id' => 2,
                'name' => 'Revenu'
            ]
        ]);
    }
}
