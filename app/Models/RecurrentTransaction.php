<?php

namespace Budgeck\Models;

use Carbon\Carbon;

/**
 * Class RecurrentTransaction
 *
 * @package Budgeck\Models
 */
class RecurrentTransaction extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'account_id',
    ];

    /**
     * Return the account which the recurrent transaction belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo($this->getBaseNamespace().'\Account');
    }

    /**
     * Return the account budget which the recurrent transaction belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account_budget()
    {
        return $this->belongsTo($this->getBaseNamespace().'\AccountBudget');
    }

    /**
     * Return the category which the recurrent transaction belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo($this->getBaseNamespace().'\Category');
    }

    /**
     * Return the collection of transactions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany($this->getBaseNamespace().'\Transaction');
    }

    /**
     * Return the recurrent transaction date as for today.
     *
     * @return \Carbon\Carbon
     */
    public function getCurrentMonthDate()
    {
        return Carbon::now()->day($this->day);
    }

    /**
     * Return the right budget according to the current month.
     *
     * @return \Budgeck\Models\Budget|null
     */
    public function getCurrentBudget()
    {
        // Return null if the recurrent transaction has no budget
        if (!$this->account_budget) {
            return null;
        }

        // Determine the transaction date according to if next_month is enable or not
        $date = $this->getCurrentMonthDate();
        if ($this->next_month) {
            $date->addMonth(1);
        }

        // Fetch the budget according to the year and month
        $budget = $this->account_budget->budgets()->where('year', $date->year)->where('month', $date->month)->getResults();
        if ($budget = $budget->first()) {
            return $budget;
        } else {
            return null;
        }
    }
}

RecurrentTransaction::created(function ($recurrentTransaction) {
    Transaction::createFromRecurrentTransaction($recurrentTransaction, false);
});
