<?php

namespace Budgeck\Http\Controllers;

use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $user;
    protected $current_account;

    public function __construct(Request $request)
    {
        if (Auth::check()) {
            // Get and share user information for
            // the controllers and the views
            $this->user = Auth::user();
            view()->share('user', $this->user);

            // Get and share the default user account
            // information for the controllers and the views
            if (!$request->session()->has('account')) {
                $this->current_account = $this->user->defaultAccount();
            } else {
                $this->current_account = $request->session()->get('account');
            }
            view()->share('current_account', $this->current_account);
        } else {
            $this->user = null;
            $this->current_account = null;
        }
    }
}
