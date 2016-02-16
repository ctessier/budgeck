<?php

namespace Budgeck\Http\Controllers;

use Budgeck\Budget;
use Budgeck\Income;
use Budgeck\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller {
    
    /**
     * 
     */
    public function getEdit($transaction_id = null) {
        return view('transactions.getEdit')
            ->with('transaction', $transaction = Transaction::getById($transaction_id))
            ->with('budgets', Budget::getListFromYearMonth(date('Y'), date('m')))
            ->with('incomes', Income::getListFromYearMonth(date('Y'), date('m')))
            ->with('isCreation', $transaction === null);
    }
    
    /**
     *
     */
    public function postSave(Request $request, $transaction_id = null) {
        $transaction = Transaction::find($transaction_id);
        
        if ($transaction == null) {
            $transaction = new Transaction();
        }
        
        if (!$transaction->validate($request->all())) {
            return response()->json(['errors' => $transaction->errors]);
        }
        
        $transaction->fill($request->all());
        
        if (empty($transaction->effective_date)) {
            $transaction->effective_date = null;
        }
        if ($transaction->budget_id == 0) {
            $transaction->budget_id = null;
        } else if ($transaction->income_id == 0) {
            $transaction->income_id = null;
        }
        
        if ($transaction->save()) {
            return response()->json(['redirect' => '']);
        } else {
            //todo
        }
    }
}
