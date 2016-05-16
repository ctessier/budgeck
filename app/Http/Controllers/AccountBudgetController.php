<?php

namespace Budgeck\Http\Controllers;

use Illuminate\Http\Request;

use Budgeck\Http\Requests\AccountBudgetRequest;
use Budgeck\Http\Controllers\Controller;
use Budgeck\Models\AccountBudget;

class AccountBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($account)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Account  $accounts
     * @return \Illuminate\Http\Response
     */
    public function create($accounts)
    {
        return view('accounts.account_budgets.create')
            ->with('account', $accounts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Budgeck\Http\Requests\AccountBudgetRequest  $request
     * @param  Account  $accounts
     * @return \Illuminate\Http\Response
     */
    public function store(AccountBudgetRequest $request)
    {
        $account_budget = new AccountBudget();
        $account_budget->fill($request->all());
        $account_budget->account_id = $this->current_account->id;
        $account_budget->save();
        return response()->json([
            'redirect' => route('accounts.show', ['account_id' => $this->current_account->id])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  AccountBudget  $account_budgets
     * @return \Illuminate\Http\Response
     */
    public function show($account_budgets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Account  $accounts
     * @param  AccountBudget  $account_budgets
     * @return \Illuminate\Http\Response
     */
    public function edit($accounts, $account_budgets)
    {
        return view('accounts.account_budgets.edit')
            ->with('account', $accounts)
            ->with('account_budget', $account_budgets);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\AccountBudgetRequest  $request
     * @param  Account  $accounts
     * @param  AccountBudget  $account_budgets
     * @return \Illuminate\Http\Response
     */
    public function update(AccountBudgetRequest $request, $accounts, $account_budgets)
    {
        $account_budgets->update($request->all());
        return response()->json([
            'redirect' => route('accounts.show', ['account_id' => $accounts->id])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AccountBudget  $account_budgets
     * @return \Illuminate\Http\Response
     */
    public function destroy($account_budgets)
    {
        //
    }
}
