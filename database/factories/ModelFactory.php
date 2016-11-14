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

/*
 * Factory for User
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

/*
 * Factory for Account
 */
$factory->define(Budgeck\Models\Account::class, function ($faker) {
    return [
        'name'            => $faker->word(),
        'description'     => $faker->sentence(3),
        'account_type_id' => Budgeck\Models\AccountType::CHECKING,
    ];
});

/*
 * Factory for AccountBudget
 */
$factory->define(Budgeck\Models\AccountBudget::class, function ($faker) {
    return [
        'title'  => $faker->randomElement(['Logement', 'Alimentation', 'Loisirs', 'Transports', 'Shopping']),
        'amount' => $faker->randomFloat(2, 50, 500),
    ];
});

/*
 * Factory for Budget
 */
$factory->define(Budgeck\Models\Budget::class, function ($faker) {
    return [
        'title'  => $faker->randomElement(['Logement', 'Alimentation', 'Loisirs', 'Transports', 'Shopping']),
        'amount' => $faker->randomFloat(2, 50, 500),
        'year'   => date('Y'),
        'month'  => date('m'),
    ];
});

/*
 * Factories for Transaction
 */
$factory->define(Budgeck\Models\Transaction::class, function ($faker) {
    return [
        'title'            => $faker->sentence($faker->numberBetween(1, 4)),
        'amount'           => $faker->randomFloat(2, 5, 100),
        'transaction_date' => $faker->dateTimeInInterval('-15 days', $interval = '+ 15 days'),
        'value_date'       => $faker->randomElement([null, $faker->dateTimeInInterval('-13 days', $interval = '+ 13 days')]),
        'year'             => date('Y'),
        'month'            => date('n'),
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
