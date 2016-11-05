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
        'firstname'      => $faker->firstname,
        'lastname'       => $faker->lastname,
        'email'          => strtolower($faker->safeEmail),
        'password'       => Hash::make('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Budgeck\Models\Account::class, function ($faker) {
    return [
        'description' => $faker->sentence(3),
    ];
});

$factory->defineAs(Budgeck\Models\Account::class, 'checking', function ($faker) use ($factory) {
    $account = $factory->raw(Budgeck\Models\Account::class);

    return array_merge($account, [
        'name'            => 'Checking',
        'account_type_id' => Budgeck\Models\AccountType::CHECKING,
    ]);
});

$factory->defineAs(Budgeck\Models\Account::class, 'saving', function ($faker) use ($factory) {
    $account = $factory->raw(Budgeck\Models\Account::class);

    return array_merge($account, [
        'name'            => 'Savings',
        'account_type_id' => Budgeck\Models\AccountType::SAVINGS,
    ]);
});

$factory->define(Budgeck\Models\AccountBudget::class, function ($faker) {
    return [
        'title'  => $faker->randomElement(['Shelter', 'Utilities', 'Food', 'Health', 'Clothing']),
        'amount' => $faker->randomFloat(2, 100, 500),
    ];
});

$factory->define(Budgeck\Models\Transaction::class, function ($faker) {
    return [
        'title'            => $faker->sentence($faker->numberBetween(2, 5)),
        'amount'           => $faker->randomFloat(2, 5, 100),
        'transaction_date' => $faker->dateTimeInInterval('-15 days', $interval = '+ 15 days'),
        'value_date'       => $faker->randomElement([null, $faker->dateTimeInInterval('-13 days', $interval = '+ 13 days')]),
        'month'            => date('m'),
        'year'             => date('Y'),
    ];
});

$factory->defineAs(Budgeck\Models\Transaction::class, 'expense', function ($faker) use ($factory) {
    $transaction = $factory->raw(Budgeck\Models\Transaction::class);

    return array_merge($transaction, [
        'transaction_type_id' => Budgeck\Models\TransactionType::EXPENSE,
    ]);
});

$factory->defineAs(Budgeck\Models\Transaction::class, 'income', function ($faker) use ($factory) {
    $transaction = $factory->raw(Budgeck\Models\Transaction::class);

    return array_merge($transaction, [
        'transaction_type_id' => Budgeck\Models\TransactionType::INCOME,
        'amount'              => $faker->randomFloat(2, 1200, 2500),
        'value_date'          => $faker->dateTimeInInterval('-13 days', $interval = '+ 13 days'),
    ]);
});
