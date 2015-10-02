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
        $account = Budgeck\Account::getUserAccountById($account_id);
        if ($account == null)
        {
            return response()->json(['errors' => [
                'form' => 'Oops, une erreur s\‘est produite'
            ]]);
        }
        
        $budget = $account->getBudgetById($id);
        if ($budget == null)
        {
            $budget = new Budgeck\AccountBudget();
            $budget->account_id = $account->id;
        }

        if (!$budget->validate($request->all()))
        {
            return response()->json(['errors' => $budget->errors]);
        }
        
        $budget->fill($request->all());
        if ($budget->save())
        {
            return response()->json(['redirect' => route('accounts.getAccount', ['id' => $account->id])]);
        }
        else
        {
            return response()->json(['errors' => ['form' => 'TO DO Error']]);
        }
        
        //TODO
        //Run automate creating of month budget
    }
}
