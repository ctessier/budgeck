<?php

namespace Budgeck\Http\Controllers\Api;

use Budgeck\Http\Controllers\Controller;
use Budgeck\Models\Budget;
use Illuminate\Http\Request;

class BudgetApiController extends Controller
{
    /**
     * Return the list of budgets from a given month and year.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        if ($request->has('month') || $request->has('year')) {
            return Budget::select('id', 'title', 'amount', 'account_budget_id', 'default_category_id')
                ->where([
                    'month'      => $request->get('month'),
                    'year'       => $request->get('year'),
                    'account_id' => $this->current_account->id,
                    'closed'     => false,
                ])
                ->get();
        } else {
            abort(400);
        }
    }
}
