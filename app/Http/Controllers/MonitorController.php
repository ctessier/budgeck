<?php

namespace Budgeck\Http\Controllers;

use Carbon\Carbon;

class MonitorController extends Controller
{
    /**
     * Show month monitoring view.
     *
     * @param int $year
     * @param int $month
     *
     * @return \Illuminate\Http\Response
     */
    public function getMonitoring($year, $month)
    {
        $monitoringDate = Carbon::createFromDate($year, $month, null);

        return view('monitoring.monitor')
            ->with('budgets', $this->current_account->getBudgets($monitoringDate->year, $monitoringDate->month))
            ->with('year', $monitoringDate->year)
            ->with('month', $monitoringDate->month)
            ->with('month_title', ucfirst($monitoringDate->formatLocalized('%B %Y')));
    }
}
