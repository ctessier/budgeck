<?php

namespace Budgeck\Http\Controllers;

use Budgeck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * 
     * @return type
     */
    public function index()
    {
        $accounts = $this->user->accounts;
        view()->share('accounts', $accounts);
        return view('accounts.index');
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function getAccount($id)
    {
        $account = Budgeck\Account::find($id);
        $accounts = $this->user->accounts;
        view()->share('accounts', $accounts);
        view()->share('account', $account);
        return view('accounts.account');
    }
    
    /**
     * 
     * 
     * @param int $account
     * @param int $year
     * @param int $month
     * @return \Illuminate\Http\Response
     */
    public function month($account_id, $year, $month)
    {
        $account = Budgeck\Account::find($account);
        
        view()->share('account', $account);
        return view('accounts.month');
    }
    
    /**
     * Show the create account pop-up content
     * 
     * @return \Illuminate\Http\Response
     */
    public function getEdit($account_id = null)
    {
        $isCreation = true;
        $account = Budgeck\Account::find($account_id);
        if ($account != null)
        {
            $isCreation = false;
        }
        view()->share('account', $account);
        view()->share('isCreation', $isCreation);
        return view('accounts.edit');
    }
    
    /**
     * Handles an account create request
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request, $account_id = null)
    {
        $account = Budgeck\Account::find($account_id);
        if ($account == null)
        {
            $account = new Budgeck\Account();
            $account->user_id = $this->user->id;
        }
        
        //TODO Validate data
        $v = Validator::make($request->all(), $account->rules, $account->messages);        
        if ($v->fails())
        {
            return response()->json(['errors' => $v->errors()]);
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
}
