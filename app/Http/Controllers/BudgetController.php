<?php

namespace Budgeck\Http\Controllers;

use Budgeck;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * Show the create budget pop-up form
     * 
     * @return \Illuminate\Http\Response
     */
    public function getEdit($account_id, $year, $month, $budget_id = null)
    {
        $isCreation = true;
        $budget = Budgeck\Budget::find($budget_id);
        if ($budget != null)
        {
            $isCreation = false;
        }
        
        return view('budgets.edit')
            ->with('isCreation', $isCreation)
            ->with('budget', $budget)
            ->with('account_id', $account_id)
            ->with('year', $year)
            ->with('month', $month);
    }
    
    /**
     * Handles a budget create or edit request
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function postSave(Request $request, $account_id, $year, $month, $budget_id = null)
    {
        $budget = Budgeck\Budget::find($budget_id);
        if ($budget == null)
        {            
            $budget = new Budgeck\Budget();
        }
        
        if (!$budget->validate($request->all()))
        {
            return response()->json(['errors' => $budget->errors]);
        }
        
        $budget->fill($request->all());
        if ($budget->save())
        {
            return response()->json([
                'redirect' => route('accounts.month', [
                    'account_id' => $account_id,
                    'year' => $year,
                    'month' => $month
                ])
            ]);
        }
        else
        {
            return response()->json(['errors' => ['form' => 'TODO: Error']]);
        }
    }
}
