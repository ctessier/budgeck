<?php

namespace Budgeck\Http\Controllers;

use Budgeck;
use Illuminate\Http\Request;

class AccountIncomeController extends Controller
{
    /**
     * Show the create account income pop-up content
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
            $accountIncome = $account->getIncomeById($id);
        }
        
        if ($accountIncome != null)
        {
            $isCreation = false;
        }
        view()->share('account_income', $accountIncome);
        view()->share('isCreation', $isCreation);
        view()->share('listCategories', Budgeck\Category::where('category_type_id', Budgeck\CategoryType::INCOME)->lists('name', 'id'));
        return view('accounts.incomes.edit');
    }
    
    /**
     * Handles an account income create or edit request
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
        
        $income = $account->getIncomeById($id);
        if ($income == null)
        {
            $income = new Budgeck\AccountIncome();
            $income->account_id = $account->id;
        }

        if (!$income->validate($request->all()))
        {
            return response()->json(['errors' => $income->errors]);
        }
        
        $income->fill($request->all());
        if ($income->save())
        {
            return response()->json(['redirect' => route('accounts.getAccount', ['id' => $account->id])]);
        }
        else
        {
            return response()->json(['errors' => ['form' => 'TODO Error']]);
        }
        
        //TODO
        //Run automate creating of month budget
    }
}
