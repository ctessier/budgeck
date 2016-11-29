<?php

namespace Budgeck\Models;

class Budget extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'amount', 'year', 'month', 'default_category_id', 'closed'];

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
        $transactions = $this->transactions();

        switch ($status) {
            case Transaction::AWAITING:
                $transactions->whereNull('value_date');
                break;
            case Transaction::EFFECTIVE:
                $transactions->whereNotNull('value_date');
                break;
            default:
                break;
        }

        return $transactions->sum('amount');
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
}
