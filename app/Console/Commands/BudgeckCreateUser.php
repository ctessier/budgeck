<?php

namespace Budgeck\Console\Commands;

use Budgeck\Models\Account;
use Budgeck\Models\AccountType;
use Budgeck\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class BudgeckCreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'budgeck:createuser 
        {email : User\'s e-mail address}
        {firstname : User\'s first name}
        {lastname : User\'s last name}
        {password? : User\'s password}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user with a default account';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        User::unguard();
        Account::unguard();

        if (!$password = $this->argument('password')) {
            $password = str_random(6);
        }

        // Create the new user and a default account
        $user = User::create([
            'email'     => $this->argument('email'),
            'firstname' => $this->argument('firstname'),
            'lastname'  => $this->argument('lastname'),
            'password'  => bcrypt($password),
        ]);

        $user->accounts()->create([
            'name'            => 'Compte courant',
            'is_default'      => true,
            'account_type_id' => AccountType::CHECKING,
        ]);

        $this->info('The user has been created successfully.');

        // Send e-mail to the new user
        Mail::send('emails.register', [
            'email'     => $user->email,
            'password'  => $password,
            'firstname' => $user->firstname,
        ], function ($message) use ($user) {
            $message
                ->to($user->email, $user->firstname.' '.$user->lastname)
                ->subject('Bienvenue sur Budgeck !');

            $this->info('A message has been sent to '.$user->email);
        });

        User::reguard();
        Account::reguard();
    }
}
