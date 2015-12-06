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
    public function getEdit($account_id, $budget_id = null)
    {
        $isCreation = true;
        $account = Budgeck\Account::getUserAccountById($account_id);
        if ($account == null)
        {
            abort(404, "Account not found");
        }
        else
        {
            view()->share('account', $account);
            $accountBudget = $account->getAccountBudgetById($budget_id);
        }
        
        if ($accountBudget != null)
        {
            $isCreation = false;
        }
        
        return view('accounts.budgets.edit')
            ->with('account_budget', $accountBudget)
            ->with('isCreation', $isCreation);
    }
    
    /**
     * Handles an account budget create or edit request
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function postSave(Request $request, $account_id, $budget_id = null)
    {
        $account = Budgeck\Account::getUserAccountById($account_id);
        if ($account == null)
        {
            return response()->json(['errors' => [
                'form' => 'Oops, une erreur s\‘est produite'
            ]]);
        }
        
        $accountBudget = $account->getAccountBudgetById($budget_id);
        if ($accountBudget == null)
        {
            $accountBudget = new Budgeck\AccountBudget();
            $accountBudget->account_id = $account->id;
        }

        if (!$accountBudget->validate($request->all()))
        {
            return response()->json(['errors' => $accountBudget->errors]);
        }
        
        $accountBudget->fill($request->all());
        if ($accountBudget->save())
        {
            return response()->json(['redirect' => route('accounts.getAccount', ['id' => $account->id])]);
        }
        else
        {
            return response()->json(['errors' => ['form' => 'TODO Error']]);
        }
    }
}
