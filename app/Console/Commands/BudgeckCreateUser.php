<?php

namespace Budgeck\Console\Commands;

use Mail;
use Illuminate\Console\Command;
use Budgeck\Models\User;
use Budgeck\Models\Account;

class BudgeckCreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'budgeck:createuser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

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
        $email = $this->ask('What is the e-mail address?');
        $firstname = $this->ask('What is the firstname?');
        $lastname = $this->ask('What is the lastname?');
        $password = str_random(8);

        User::unguard('password');
        Account::unguard('is_default');

        $user = User::create([
            'email'     => $email,
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'password'  => bcrypt($password),
        ]);

        $user->accounts()->create([
            'name'            => 'Compte courant',
            'is_default'      => true,
            'account_type_id' => 1,
        ]);

        $this->info('User created.');

        Mail::send('emails.register', [
            'email'     => $email,
            'password'  => $password,
            'firstname' => $firstname,
        ], function ($message) use ($user) {
            $message
                ->to($user->email, $user->firstname . ' ' . $user->lastname)
                ->subject('Bienvenue sur Budgeck !');
            $this->info('Un message a été envoyé à ' . $user->email);
        });

        User::reguard('password');
        Account::reguard('is_default');
    }
}
