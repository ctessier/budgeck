<?php

namespace Budgeck\Http\Controllers;

use Budgeck\Http\Requests\RecurrentTransactionRequest;
use Budgeck\Models\RecurrentTransaction;

class RecurrentTransactionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param \Budgeck\Models\Account $account
     *
     * @return \Illuminate\Http\Response
     */
    public function create($account)
    {
        return view('accounts.recurrent_transactions.create')
            ->with('account', $account);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Budgeck\Http\Requests\RecurrentTransactionRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RecurrentTransactionRequest $request)
    {
        $recurrent_transaction = new RecurrentTransaction();
        $recurrent_transaction->fill($request->all());
        $recurrent_transaction->account_id = $this->current_account->id;

        // Set category_id to null if empty
        if (empty($request->input('category_id'))) {
            $recurrent_transaction->category_id = null;
        }

        // Set account_budget_id to null if empty
        if (empty($request->input('account_budget_id'))) {
            $recurrent_transaction->account_budget_id = null;
        }

        $recurrent_transaction->save();

        return response()->json([
            'redirect' => $this->getRedirectUrl(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Budgeck\Models\Account              $account
     * @param \Budgeck\Models\RecurrentTransaction $recurrent_transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($account, $recurrent_transaction)
    {
        return view('accounts.recurrent_transactions.edit')
            ->with('account', $account)
            ->with('recurrent_transaction', $recurrent_transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Budgeck\Http\Requests\RecurrentTransactionRequest $request
     * @param \Budgeck\Models\Account                            $account
     * @param \Budgeck\Models\RecurrentTransaction               $recurrent_transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RecurrentTransactionRequest $request, $account, $recurrent_transaction)
    {
        $recurrent_transaction->fill($request->all());

        // Set category_id to null if empty
        if (empty($request->input('category_id'))) {
            $recurrent_transaction->category_id = null;
        }

        // Set account_budget_id to null if empty
        if (empty($request->input('account_budget_id'))) {
            $recurrent_transaction->account_budget_id = null;
        }

        // Set next_month to false if empty
        if (empty($request->input('next_month'))) {
            $recurrent_transaction->next_month = false;
        }

        $recurrent_transaction->save();

        return response()->json([
            'redirect' => $this->getRedirectUrl(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Budgeck\Models\Account              $account
     * @param \Budgeck\Models\RecurrentTransaction $recurrent_transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($account, $recurrent_transaction)
    {
        // Make transactions orphans
        foreach ($recurrent_transaction->transactions as $transaction) {
            $transaction->recurrent_transaction_id = null;
            $transaction->save();
        }

        $recurrent_transaction->delete();

        return redirect($this->getRedirectUrl());
    }
}
