<?php

namespace Budgeck\Http\Controllers;

use Budgeck;
use Illuminate\Http\Request;

class AccountBudgetController extends Controller
{
    /**
     * Show the create account budget pop-up content
     * 
     * @return \Illuminate\Http\Response
     */
    public function getEdit($account_budget_id = null)
    {
        $isCreation = true;
        $account = Budgeck\AccountBudget::find($account_budget_id);
        if ($account != null)
        {
            $isCreation = false;
        }
        view()->share('account', $account);
        view()->share('isCreation', $isCreation);
        return view('accounts.edit');
    }
    
    /**
     * Handles an account budget create or edit request
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function postSave(Request $request, $account_id = null)
    {
        $account = Budgeck\AccountBudget::find($account_id);
        if ($account == null)
        {            
            $account = new Budgeck\Account();
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
}
