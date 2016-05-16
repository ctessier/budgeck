<?php

namespace Budgeck\Http\Controllers;

use Budgeck\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Budgeck\Http\Requests\TransactionRequest;
use Budgeck\Http\Controllers\Controller;

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
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $view = view('accounts.transactions.create');
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        if ($request->exists('income'))
        {
            $view->with('income', true);
        }
        else
        {
            $view->with('expense', true);
        }

        return $view->with('baseMonth', $month)->with('baseYear', $year);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Budgeck\Http\Requests\TransactionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $transaction = new Transaction();
        $transaction->account_id = $this->current_account->id;
        $transaction->fill($request->all());

        // Assign date if not empty
        if (!empty($request->input('value_date')))
        {
            $transaction->value_date = $request->input('value_date');
        }

        $transaction->save();

        return response()->json([
            'redirect' => route('history')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Budgeck\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Budgeck\Models\Account  $account
     * @param  \Budgeck\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($account, $transaction)
    {
        return view('accounts.transactions.edit')
            ->with('transaction', $transaction)
            ->with('baseMonth', $transaction->created_at->month)
            ->with('baseYear', $transaction->created_at->year);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Budgeck\Http\Requests\TransactionRequest $request
     * @param  \Budgeck\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $transaction)
    {
        $transaction->fill($request->all());

        // Assign date if not empty
        if (!empty($request->input('value_date')))
        {
            $transaction->value_date = $request->input('value_date');
        }

        $transaction->save();

        return response()->json([
            'redirect' => route('history')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Budgeck\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($transaction)
    {
        //
    }
}
