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
        factory(Budgeck\Models\User::class, 3)->create()->each(function ($user) {
            $user->accounts()->save(factory(Budgeck\Models\Account::class, 'checking')->make([
                'is_default' => true,
            ]));
            $user->accounts()->save(factory(Budgeck\Models\Account::class, 'saving')->make());
        });
    }
}
