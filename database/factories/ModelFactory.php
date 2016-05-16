<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Budgeck\Models\User::class, function ($faker) {
    return [
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'email' => strtolower($faker->email),
        'password' => Hash::make('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Budgeck\Models\Account::class, function ($faker) {
    return [
        'name' => 'Compte chèque',
        'description' => 'Description goes here.',
        'account_type_id' => 1,
        'is_default' => true
    ];
});
