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
        DB::table('users')->insert([
            'email' => 'demo@budgeck.fr',
            'password' => bcrypt('demo'),
            'firstname' => 'Démo',
            'lastname' => 'Budgeck',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
