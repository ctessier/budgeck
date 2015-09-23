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
    public function getEdit($account_id, $id = null)
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
            $accountBudget = $account->getBudgetById($id);
        }
        
        if ($accountBudget != null)
        {
            $isCreation = false;
        }
        view()->share('account_budget', $accountBudget);
        view()->share('isCreation', $isCreation);
        view()->share('listAccounts', Budgeck\Account::where('user_id', $this->user->id)->lists('name', 'id'));
        view()->share('listCategories', Budgeck\Category::where('category_type_id', Budgeck\CategoryType::SPENDING)->lists('name', 'id'));
        view()->share('listBudgetTypes', Budgeck\BudgetType::lists('name', 'id'));
        return view('accounts.budgets.edit');
    }
    
    /**
     * Handles an account budget create or edit request
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function postSave(Request $request, $account_id, $id = null)
    {
        //TODO
        
        // Get budget from account if edit
        // Validate form
        // Save budget account
        // Run automate creating of month budget
    }
}
