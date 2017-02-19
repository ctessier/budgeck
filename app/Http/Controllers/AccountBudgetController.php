<?php

namespace Budgeck\Http\Controllers;

use Budgeck\Http\Requests\AccountBudgetRequest;
use Budgeck\Models\Account;
use Budgeck\Models\AccountBudget;

class AccountBudgetController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Account $account
     *
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
     * @param \Budgeck\Http\Requests\AccountBudgetRequest $request
     * @param Account                                     $account
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccountBudgetRequest $request, $account)
    {
        $account_budget = new AccountBudget();
        $account_budget->fill($request->all());
        $account_budget->account_id = $account->id;

        // Set default_category_id to null if empty
        if (empty($request->input('default_category_id'))) {
            $account_budget->default_category_id = null;
        }

        $account_budget->save();

        return response()->json([
            'redirect' => route('accounts.show', $account),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Account       $account
     * @param AccountBudget $account_budget
     *
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
     * @param \Budgeck\Http\Requests\AccountBudgetRequest $request
     * @param Account                                     $account
     * @param AccountBudget                               $account_budget
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AccountBudgetRequest $request, $account, $account_budget)
    {
        $account_budget->fill($request->all());

        // Set default_category_id to null if empty
        if (empty($request->input('default_category_id'))) {
            $account_budget->default_category_id = null;
        }

        $account_budget->save();

        return response()->json([
            'redirect' => route('accounts.show', $account),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Account       $account
     * @param AccountBudget $account_budget
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($account, $account_budget)
    {
        // Remove relation from budgets
        foreach ($account_budget->budgets as $budget) {
            $budget->account_budget_id = null;
            $budget->save();
        }

        $account_budget->delete();

        return redirect()->route('accounts.show', $account);
    }
}
