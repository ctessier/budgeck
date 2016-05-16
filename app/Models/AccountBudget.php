<?php

namespace Budgeck\Models;

use Carbon\Carbon;

class AccountBudget extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'amount', 'default_category_id'];

    /**
     * The account model of the account budget
     *
     * @return \Budgeck\Models\Account
     */
    public function account()
    {
        return $this->belongsTo($this->getBaseNamespace() . '\Account');
    }

    /**
     * The collection of budgets which inherit to this account budget
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function budgets()
    {
        return $this->hasMany($this->getBaseNamespace() . '\Budget');
    }

    /**
     * Create budgets from account budget according to defined aheadness
     *
     * @return void
     */
    public function createMonthsBudget()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        for ($i=0 ; $i <= config('budgeck.aheadness') ; ++$i)
        {
            $budget = Budget::where('account_budget_id', $this->id)
                ->where('year', $currentYear)
                ->where('month', $currentMonth)
                ->withTrashed()
                ->get();

            if ($budget->isEmpty())
            {
                $budget = new Budget();
                $budget->title = $this->title;
                $budget->description = $this->description;
                $budget->amount = $this->amount;
                $budget->year = $currentYear;
                $budget->month = $currentMonth;
                $budget->closed = false;
                $budget->account_budget_id = $this->id;
                $budget->account_id = $this->account_id;
                $budget->default_category_id = $this->default_category_id;
                $budget->save();
            }

            $currentMonth++;
            if ($currentMonth > 12)
            {
                $currentYear++;
                $currentMonth = 1;
            }
        }
    }

    /**
     * Update budgets from updated account income according to defined aheadness
     *
     * @return void
     */
    public function updateMonthsBudget()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        for ($i=0 ; $i < config('budgeck.aheadness') ; ++$i)
        {
            // The current month should not be updated
            $currentMonth++;
            if ($currentMonth > 12)
            {
                $currentYear++;
                $currentMonth = 1;
            }

            $budget = Budget::where('account_budget_id', $this->id)
                ->where('year', $currentYear)
                ->where('month', $currentMonth)
                ->withTrashed()
                ->first();

            if ($budget === null)
            {
                $budget = new Budget();
                $budget->closed = false;
            }
            else
            {
                // Trashed budgets are not updated
                if ($budget->trashed())
                {
                    continue;
                }
            }

            $budget->title = $this->title;
            $budget->description = $this->description;
            $budget->amount = $this->amount;
            $budget->year = $currentYear;
            $budget->month = $currentMonth;
            $budget->account_budget_id = $this->id;
            $budget->account_id = $this->account_id;
            $budget->default_category_id = $this->default_category_id;
            $budget->save();
        }
    }
}

AccountBudget::created(function ($accountBudget) {
    $accountBudget->createMonthsBudget();
});

AccountBudget::updated(function ($accountBudget) {
    $accountBudget->updateMonthsBudget();
});
