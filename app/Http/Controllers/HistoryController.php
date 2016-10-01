<?php

namespace Budgeck\Http\Controllers;

use Budgeck\Models\Transaction;

class HistoryController extends Controller
{
    /**
     * Return the history page
     *
     * @return \Illuminate\Http\Response
     */
    public function getHistory()
    {
        return view('history.index')
            ->with('awaitings', $this->current_account->getTransactions(Transaction::AWAITING))
            ->with('transactions', $this->current_account->getTransactions(Transaction::EFFECTIVE));
    }
}
