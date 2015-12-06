<?php

namespace Budgeck\Http\Controllers;

use Budgeck;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Show the create income pop-up form
     * 
     * @return \Illuminate\Http\Response
     */
    public function getEdit($account_id, $year, $month, $income_id = null)
    {
        $isCreation = true;
        $income = Budgeck\Income::find($income_id);
        if ($income != null)
        {
            $isCreation = false;
        }
        
        return view('incomes.edit')
            ->with('isCreation', $isCreation)
            ->with('income', $income)
            ->with('account_id', $account_id)
            ->with('year', $year)
            ->with('month', $month);
    }
    
    /**
     * Handles a income create or edit request
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function postSave(Request $request, $account_id, $year, $month, $income_id = null)
    {
        $income = Budgeck\Income::find($income_id);
        if ($income == null)
        {            
            $income = new Budgeck\Income();
        }
        
        if (!$income->validate($request->all()))
        {
            return response()->json(['errors' => $income->errors]);
        }
        
        $income->fill($request->all());
        if ($income->save())
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
