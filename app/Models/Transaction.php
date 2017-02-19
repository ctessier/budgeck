<?php

namespace Budgeck\Models;

use Carbon\Carbon;

class Transaction extends BaseModel
{
    /**
     * Constant for awaiting state.
     *
     * @var int
     */
    const AWAITING = 1;

    /**
     * Constant for effective state.
     *
     * @var int
     */
    const EFFECTIVE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'amount', 'transaction_date', 'value_date', 'comment', 'category_id', 'budget_id', 'transaction_type_id', 'month', 'year'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['transaction_date', 'value_date', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Return the budget which the transaction belongs to.
     *
     * @return Budget
     */
    public function budget()
    {
        return $this->belongsTo($this->getBaseNamespace().'\Budget');
    }

    /**
     * Tell if the transaction is of type expense.
     *
     * @return bool
     */
    public function isExpense()
    {
        return $this->transaction_type_id == TransactionType::EXPENSE;
    }

    /**
     * Create a new transaction from a given recurrent transaction.
     *
     * @param RecurrentTransaction $recurrentTransaction
     * @param bool                 $isCommand
     *
     * @return bool
     */
    public static function createFromRecurrentTransaction(RecurrentTransaction $recurrentTransaction, $isCommand = true)
    {
        $transaction_date = $recurrentTransaction->getCurrentMonthDate();
        $budget = $recurrentTransaction->getCurrentBudget();

        // Create the transaction only if the day is not passed
        if ($isCommand || $transaction_date->toDateTimeString() >= Carbon::now()->toDateTimeString()) {
            $transaction = new self();
            $transaction->title = $recurrentTransaction->title;
            $transaction->amount = $recurrentTransaction->amount;
            $transaction->transaction_date = $transaction_date;
            $transaction->transaction_type_id = $recurrentTransaction->transaction_type_id;
            $transaction->category_id = $recurrentTransaction->category_id;
            $transaction->account_id = $recurrentTransaction->account_id;
            $transaction->recurrent_transaction_id = $recurrentTransaction->id;

            // Set year and month
            if ($recurrentTransaction->next_month) {
                $transaction_date->addMonth(1);
            }
            $transaction->year = $transaction_date->year;
            $transaction->month = $transaction_date->month;

            // Set budget
            if ($budget) {
                $transaction->budget_id = $budget->id;
            }

            return $transaction->save();
        }

        return false;
    }
}
