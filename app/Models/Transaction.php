<?php

namespace Budgeck\Models;

class Transaction extends BaseModel
{
    /**
     * Constant for awaiting state
     *
     * @var int
     */
    const AWAITING = 0;

    /**
     * Constant for effective state
     *
     * @var int
     */
    const EFFECTIVE = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'amount', 'transaction_date', 'value_date', 'comment', 'category_id', 'budget_id', 'transaction_type_id', 'payment_method_id', 'month', 'year'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['transaction_date', 'value_date', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Return the budget which the transaction belongs to
     *
     * @return Budget
     */
    public function budget()
    {
        return $this->belongsTo($this->getBaseNamespace() . '\Budget');
    }

    /**
     * Tell if the transaction is of type expense
     *
     * @return bool
     */
    public function isExpense()
    {
        return $this->transaction_type_id === TransactionType::EXPENSE;
    }
}
