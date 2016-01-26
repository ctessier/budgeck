<?php

namespace Budgeck\Http\Controllers;

use Budgeck\Transaction;

class HistoryController extends Controller {
    /**
     * Returns the history page
     *
     * @param int $account_id
     * @return \Illuminate\Http\Response
     */
    public function getHistory($account_id)
    {
        return view('history.getHistory')
            ->with('account_id', $account_id)
            ->with('awaitings',
                Transaction::getUserTransactionsFromAccountId($this->user->id, $account_id, true))
            ->with('transactions',
                Transaction::getUserTransactionsFromAccountId($this->user->id, $account_id));
    }
}
