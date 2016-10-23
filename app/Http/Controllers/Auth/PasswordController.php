<?php

namespace Budgeck\Http\Controllers\Auth;

use Budgeck\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Reset password subject.
     *
     * @var string
     */
    protected $subject = "Réinitialisation de votre mot de passe";

    /**
     * URL to redirect the user after password reset.
     *
     * @var string
     */
    protected $redirectPath = '/history';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
