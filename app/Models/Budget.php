<?php

namespace Budgeck\Models;

use Auth;

class Budget extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'amount', 'year', 'month', 'default_category_id'];

    /**
     * Return the account which the budget belongs to.
     *
     * @return Account
     */
    public function account()
    {
        return $this->belongsTo($this->getBaseNamespace().'\Account');
    }

    /**
     * Return the collection of transactions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function transactions()
    {
        return $this->hasMany($this->getBaseNamespace().'\Transaction')
            ->where('transaction_type_id', TransactionType::EXPENSE)
            ->orderBy('transaction_date', 'DESC');
    }

    /**
     * Return the sum of the expenses for the budget.
     *
     * @param int $status
     *
     * @return float
     */
    public function getAmountSpent($status = null)
    {
        if ($status === null) {
            return $this->transactions()->sum('amount');
        }

        switch ($status) {
            case Transaction::AWAITING:
                return $this->transactions()->whereNull('value_date')->sum('amount');
                break;
            case Transaction::EFFECTIVE:
                return $this->transactions()->whereNotNull('value_date')->sum('amount');
                break;
            default:
                abort(500, 'Unknown transaction state.');
        }
    }

    /**
     * Return the remaining amount available.
     *
     * @return float
     */
    public function getAmountRemaining()
    {
        return $this->amount - $this->getAmountSpent();
    }

    /**
     * Return the list of budgets according to year and month.
     *
     * @param int $year
     * @param int $month
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getListFromYearMonth($year, $month)
    {
        $collection = self::select('budgets.id', 'budgets.title')
            ->leftJoin('accounts', 'budgets.account_id', '=', 'accounts.id')
            ->where('accounts.user_id', Auth::user()->id)
            ->where('budgets.year', $year)
            ->where('budgets.month', $month)
            ->lists('budgets.title', 'budgets.id');

        $collection->prepend('-- Sélectionner --', 0);

        return $collection;
    }
}
