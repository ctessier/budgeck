<?php

namespace Budgeck\Models;

class Account extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'account_type_id'];

    /**
     * Return the owner of the account.
     *
     * @return \Budgeck\Models\User
     */
    public function user()
    {
        return $this->belongsTo($this->getBaseNamespace().'\User');
    }

    /**
     * Return the collection of the account budgets.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function account_budgets()
    {
        return $this->hasMany($this->getBaseNamespace().'\AccountBudget');
    }

    /**
     * Return the collection of the account recurrent transactions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function recurrent_transactions()
    {
        return $this->hasMany($this->getBaseNamespace().'\RecurrentTransaction');
    }

    /**
     * Return the balance of the current account.
     *
     * @return float
     */
    public function getBalance()
    {
        // Get total of effective incomes
        $totalIncomes = Transaction::where('transaction_type_id', TransactionType::INCOME)
            ->where('account_id', $this->id)
            ->whereNotNull('value_date')
            ->sum('amount');

        // Get total of effective expenses
        $totalExpenses = Transaction::where('transaction_type_id', TransactionType::EXPENSE)
            ->where('account_id', $this->id)
            ->whereNotNull('value_date')
            ->sum('amount');

        // Return the difference
        return $totalIncomes - $totalExpenses;
    }

    /**
     * Return the month budgets of the account for the given year and month.
     *
     * @param int $year
     * @param int $month
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBudgets($year, $month)
    {
        return Budget::where('account_id', $this->id)
            ->where('year', $year)
            ->where('month', $month)
            ->get();
    }

    /**
     * Return a transactions collection.
     *
     * @param int $status
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTransactions($status, $sort = 'DESC')
    {
        $transactions = Transaction::select('transactions.*')
            ->where('account_id', $this->id)
            ->orderBy('year', $sort)
            ->orderBy('month', $sort)
            ->orderBy('transaction_date', $sort);

        if ($status === Transaction::AWAITING) {
            return $transactions
                ->whereNull('value_date')
                ->paginate(5, ['*'], 'pending');
        } else {
            return $transactions
                ->whereNotNull('value_date')
                ->paginate(20, ['*'], 'effective');
        }
    }

    /**
     * Returns the expected balance of the account by the end of the given month and year.
     *
     * @param int|null $month
     * @param int|null $year
     *
     * @return float
     */
    public function getExpectedBalance($month = null, $year = null)
    {
        if (!isset($month)) {
            $month = intval(date('n'));
        }
        if (!isset($year)) {
            $year = intval(date('Y'));
        }

        $expected = $this->getBalance();

        foreach ($this->getBudgets($year, $month) as $budget) {
            if ($budget->closed) { // budget is closed, we deduct only what's pending
                $expected -= $budget->getAmountSpent(Transaction::AWAITING);
            } elseif ($budget->isHealthy()) { // budget is healthy, we deduct what's pending or left to spend
                $expected -= $budget->amount - $budget->getAmountSpent(Transaction::EFFECTIVE);
            } else { // budget is not healthy,
                $expected -= $budget->getAmountSpent(Transaction::AWAITING);
            }
        }

        foreach ($this->getTransactions(Transaction::AWAITING) as $transaction) {
            if ($transaction->budget || $transaction->month > $month || $transaction->year > $year) {
                continue;
            }
            if ($transaction->isExpense()) {
                $expected -= $transaction->amount;
            } else {
                $expected += $transaction->amount;
            }
        }

        return $expected;
    }

    /**
     * Make account the default one.
     *
     * @return void
     */
    public function makeDefault()
    {
        $current_default = $this->user->defaultAccount();
        $current_default->is_default = false;
        $current_default->save();

        $this->is_default = true;
        $this->save();
    }
}
