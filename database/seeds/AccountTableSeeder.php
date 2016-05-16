<?php

use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_types')->insert([
            [
                'id' => 1,
                'name' => 'Courant'
            ],
            [
                'id' => 2,
                'name' => 'Epargne'
            ]
        ]);
    }
}
