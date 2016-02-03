<?php

namespace Budgeck\Http\Controllers;

use Budgeck\Account;
use Budgeck\Budget;
use Budgeck\Income;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Show the view listing the accounts of an user
     * @return \Illuminuate\Http\Response
     */
    public function index()
    {
        $accounts = $this->user->accounts;
        view()->share('accounts', $accounts);
        return view('accounts.index');
    }
    
    /**
     * Show the view detailing a given account
     * 
     * @param int $account_id
     * @return \Illuminate\Http\Request
     */
    public function getAccount($account_id)
    {
        $account = null;
        $accounts = $this->user->accounts;
        foreach ($accounts as $acc)
        {
            if ($acc->id == $account_id)
            {
                $account = $acc;
            }
        }
        
        if ($account == null)
        {
            abort(404);
        }
        
        view()->share('accounts', $accounts);
        view()->share('account', $account);
        return view('accounts.account');
    }
    
    /**
     * Show the create account pop-up content
     * 
     * @return \Illuminate\Http\Response
     */
    public function getEdit($account_id = null)
    {
        $isCreation = true;
        $account = Account::find($account_id);
        if ($account != null)
        {
            $isCreation = false;
        }
        view()->share('account', $account);
        view()->share('isCreation', $isCreation);
        return view('accounts.edit');
    }
    
    /**
     * Handles an account create or edit request
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function postSave(Request $request, $account_id = null)
    {
        $account = Account::find($account_id);
        if ($account == null)
        {            
            $account = new Account();
            $account->user_id = $this->user->id;
        }
        
        if (!$account->validate($request->all()))
        {
            return response()->json(['errors' => $account->errors]);
        }
        
        $account->fill($request->all());
        if ($account->save())
        {
            return response()->json(['redirect' => route('accounts.getAccount', ['id' => $account->id])]);
        }
        else
        {
            return response()->json(['errors' => ['form' => 'TO DO Error']]);
        }
    }
    
    /**
     * 
     * 
     * @param int $account_id Account id
     * @param int $year Year
     * @param int $month Month
     * @return \Illuminuate\Http\Response
     */
    public function getMonth($account_id, $year, $month)
    {
        return view('accounts.month.index')
            ->with('budgets', Budget::getUserMonthBudgetsFromAccountId($account_id, $year, $month))
            ->with('incomes', Income::getUserMonthIncomesFromAccountId($account_id, $year, $month))
            ->with('account_id', $account_id)
            ->with('year', $year)
            ->with('month', $month);
    }
}
