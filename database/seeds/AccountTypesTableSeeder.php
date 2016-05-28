<?php

use Illuminate\Database\Seeder;

class AccountTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_types')->insert([
            'id' => 1,
            'name' => 'Checking',
        ]);

        DB::table('account_types')->insert([
            'id' => 2,
            'name' => 'Savings',
        ]);
    }
}
