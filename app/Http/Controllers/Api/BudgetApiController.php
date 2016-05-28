<?php

namespace Budgeck\Http\Controllers\Api;

use Budgeck\Models\Budget;
use Illuminate\Http\Request;

use Budgeck\Http\Requests;
use Budgeck\Http\Controllers\Controller;

class BudgetApiController extends Controller
{
    /**
     * Return the list of budgets from a given month and year
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        if ($request->has('month') || $request->has('year'))
        {
            return Budget::select('id', 'title', 'amount')
                ->where([
                    'month' => $request->get('month'),
                    'year' => $request->get('year'),
                    'account_id' => $this->current_account->id,
                    'closed' => false
                ])
                ->get();
        }
        else
        {
            abort(400);
        }
    }
}
