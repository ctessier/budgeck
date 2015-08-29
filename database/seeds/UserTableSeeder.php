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
            'email' => 'clement.tessier@ymail.com',
            'password' => bcrypt('secret'),
            'firstname' => 'Clément',
            'lastname' => 'Tessier',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
