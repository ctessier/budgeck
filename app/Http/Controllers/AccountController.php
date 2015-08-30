<?php

namespace Budgeck\Http\Controllers;

use Budgeck;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = $this->user->accounts;
        view()->share('accounts', $accounts);
        return view('accounts.index');
    }
    
    /**
     * 
     * 
     * @param int $account
     * @param int $year
     * @param int $month
     * @return \Illuminate\Http\Response
     */
    public function month($account, $year, $month)
    {
        $account = Budgeck\Account::find($account);
        
        view()->share('account', $account);
        return view('accounts.month');
    }
}
