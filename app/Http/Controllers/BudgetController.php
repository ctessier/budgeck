<?php

namespace Budgeck\Http\Controllers;

use Budgeck\Http\Requests\BudgetRequest;
use Budgeck\Models\Budget;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        if ($request->has('month') && $request->has('year')) {
            if (intval($request->input('month')) !== 0 && intval($request->input('year')) !== 0) {
                $month = intval($request->input('month'));
                $year = intval($request->input('year'));
            }
        }

        return view('accounts.budgets.create')
            ->with('month', $month)
            ->with('year', $year)
            ->with('month_title', ucfirst(Carbon::createFromDate($year, $month, null)
                ->formatLocalized('%B %Y')
            ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Budgeck\Http\Requests\BudgetRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetRequest $request)
    {
        $budget = new Budget();
        $budget->account_id = $this->current_account->id;
        $budget->fill($request->all());

        // Set default_category_id to null if empty
        if (empty($request->input('default_category_id'))) {
            $budget->default_category_id = null;
        }

        $budget->save();

        return response()->json([
            'redirect' => route('monitoring', [
                'month' => $budget->month,
                'year'  => $budget->year,
            ]),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \Budgeck\Models\Account $accounts
     * @param \Budgeck\Models\Budget  $budget
     *
     * @return \Illuminate\Http\Response
     */
    public function show($accounts, $budget)
    {
        return view('accounts.budgets.show')
            ->with('budget', $budget);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Budgeck\Models\Account $accounts
     * @param \Budgeck\Models\Budget  $budget
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($accounts, $budget)
    {
        return view('accounts.budgets.edit')
            ->with('budget', $budget)
            ->with('month', $budget->month)
            ->with('year', $budget->year);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Budgeck\Http\Requests\BudgetRequest $request
     * @param \Budgeck\Models\Account              $accounts
     * @param \Budgeck\Models\Budget               $budget
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BudgetRequest $request, $accounts, $budget)
    {
        $budget->fill($request->all());

        // Set default_category_id to null if empty
        if (empty($request->input('default_category_id'))) {
            $budget->default_category_id = null;
        }

        // Set closed to false if empty
        if (empty($request->input('closed'))) {
            $budget->closed = false;
        }

        $budget->save();

        return response()->json([
            'redirect' => route('monitoring', [
                'month' => $budget->month,
                'year'  => $budget->year,
            ]),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Budgeck\Models\Account $accounts
     * @param \Budgeck\Models\Budget  $budget
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($accounts, $budget)
    {
        // Make budget's transactions orphans
        foreach ($budget->transactions as $transaction) {
            $transaction->budget_id = null;
            $transaction->save();
        }

        $budget->delete();

        return redirect($this->getRedirectUrl());
    }
}
