<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CategoryTypesTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(AccountTypesTableSeeder::class);
        $this->call(TransactionTypesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(AccountBudgetTableSeeder::class);
        $this->call(TransactionTableSeeder::class);

        Model::reguard();
    }
}
