<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Budgeck\User::class, 3)->create()->each( function($user) {
            $user->accounts()->save(factory(Budgeck\Account::class)->make());
        });
    }
}
