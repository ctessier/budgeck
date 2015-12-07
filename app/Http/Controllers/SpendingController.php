<?php

namespace Budgeck\Http\Controllers;

use Budgeck;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    /**
     * Show the edit spending pop-up form
     * 
     * @return \Illuminate\Http\Response
     */
    public function getEdit($account_id, $year, $month, $budget_id, $spending_id = null)
    {
        $isCreation = true;
        $spending = Budgeck\Spending::find($spending_id);
        if ($spending != null)
        {
            $isCreation = false;
        }
        
        return view('spendings.edit')
            ->with('isCreation', $isCreation)
            ->with('spending', $spending)
            ->with('budget_id', $budget_id)
            ->with('account_id', $account_id)
            ->with('year', $year)
            ->with('month', $month);
    }
    
    /**
     * Handles a spending create or edit request
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function postSave(Request $request, $account_id, $year, $month, $budget_id, $spending_id = null)
    {
        $spending = Budgeck\Spending::find($spending_id);
        if ($spending == null)
        {            
            $spending = new Budgeck\Spending();
        }
        
        if (!$spending->validate($request->all()))
        {
            return response()->json(['errors' => $spending->errors]);
        }
        
        $spending->fill($request->all());
        
        // Add debit date if it has been filled
        if (!empty($request->input('debit_date')))
        {
            $spending->debit_date = $request->input('debit_date');
        }
        
        if ($spending->save())
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
