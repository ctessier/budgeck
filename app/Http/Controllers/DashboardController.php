<?php

namespace Budgeck\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index')
            ->with('spendings', \Budgeck\Spending::getUserSpendings($this->user));
    }
}
