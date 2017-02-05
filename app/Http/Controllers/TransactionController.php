<?php

namespace Budgeck\Http\Controllers;

use Budgeck\Http\Requests\TransactionRequest;
use Budgeck\Models\Budget;
use Budgeck\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $view = view('accounts.transactions.create');

        if ($request->exists('budget')) {
            $budget = Budget::find($request->get('budget'));
            if ($budget !== null) {
                $view->with('budget', $budget);
            }
        }

        if ($request->exists('income')) {
            $view->with('income', true);
        } else {
            $view->with('expense', true);
        }

        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Budgeck\Http\Requests\TransactionRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $transaction = new Transaction();
        $transaction->account_id = $this->current_account->id;
        $transaction->fill($request->all());

        // Set value_date if not empty, null otherwise
        if (empty($request->input('value_date'))) {
            $transaction->value_date = null;
        }

        // Set category_id to null if empty
        if (empty($request->input('category_id'))) {
            $transaction->category_id = null;
        }

        // Set budget_id to null if empty
        if (empty($request->input('budget_id'))) {
            $transaction->budget_id = null;
        }

        $transaction->save();

        return response()->json([
            'redirect' => URL::previous(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \Budgeck\Models\Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function show($transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Budgeck\Models\Account     $account
     * @param \Budgeck\Models\Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($account, $transaction)
    {
        return view('accounts.transactions.edit')
            ->with('transaction', $transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Budgeck\Http\Requests\TransactionRequest $request
     * @param \Budgeck\Models\Account                   $account
     * @param \Budgeck\Models\Transaction               $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $account, $transaction)
    {
        $transaction->fill($request->all());

        // Set value_date if not empty, null otherwise
        if (empty($request->input('value_date'))) {
            $transaction->value_date = null;
        }

        // Set category_id to null if empty
        if (empty($request->input('category_id'))) {
            $transaction->category_id = null;
        }

        // Set budget_id to null if empty
        if (empty($request->input('budget_id'))) {
            $transaction->budget_id = null;
        }

        $transaction->save();

        return response()->json([
            'redirect' => route('history'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Budgeck\Models\Account     $account
     * @param \Budgeck\Models\Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($account, $transaction)
    {
        $transaction->delete();

        return redirect('history');
    }
}
