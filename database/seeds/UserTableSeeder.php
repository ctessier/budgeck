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
        Artisan::call('budgeck:createuser', [
            'email'     => 'demo@example.com',
            'firstname' => '',
            'lastname'  => '',
            'password'  => 'secret',
        ]);
    }
}
