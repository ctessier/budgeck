<?php

namespace Budgeck\Http\Controllers;

use Budgeck\Http\Requests\AccountBudgetRequest;
use Budgeck\Models\Account;
use Budgeck\Models\AccountBudget;

class AccountBudgetController extends Controller
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
     * @param  Account $account
     * @return \Illuminate\Http\Response
     */
    public function create($account)
    {
        return view('accounts.account_budgets.create')
            ->with('account', $account);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Budgeck\Http\Requests\AccountBudgetRequest $request
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
     * @param  AccountBudget $account_budget
     * @return \Illuminate\Http\Response
     */
    public function show($account_budget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Account $account
     * @param  AccountBudget $account_budget
     * @return \Illuminate\Http\Response
     */
    public function edit($account, $account_budget)
    {
        return view('accounts.account_budgets.edit')
            ->with('account', $account)
            ->with('account_budget', $account_budget);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Budgeck\Http\Requests\AccountBudgetRequest $request
     * @param  Account $account
     * @param  AccountBudget $account_budget
     * @return \Illuminate\Http\Response
     */
    public function update(AccountBudgetRequest $request, $account, $account_budget)
    {
        $account_budget->update($request->all());

        return response()->json([
            'redirect' => route('accounts.show', ['account_id' => $account->id])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Account $account
     * @param  AccountBudget $account_budget
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($account, $account_budget)
    {
        // Remove relation from budgets
        foreach ($account_budget->budgets as $budget)
        {
            $budget->account_budget_id = null;
            $budget->save();
        }

        $account_budget->delete();

        return response()->json([
            'redirect' => route('accounts.show', ['account_id' => $account->id])
        ]);
    }
}
