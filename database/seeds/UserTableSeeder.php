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
        factory(Budgeck\Models\User::class, 3)->create()->each( function($user) {
            $user->accounts()->save(factory(Budgeck\Models\Account::class)->make());
            $user->accounts()->save(factory(Budgeck\Models\Account::class)->make([
                'name' => 'Epargne',
                'account_type_id' => 2
            ]));
        });
    }
}
