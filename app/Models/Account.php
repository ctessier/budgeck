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
     * Return the collection of the account budgets.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function account_budgets()
    {
        return $this->hasMany($this->getBaseNamespace() . '\AccountBudget');
    }

    /**
     * Return the balance of the current account.
     *
     * @return double
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
        return ($totalIncomes - $totalExpenses);
    }

    /**
     * Return an account's budget from given id.
     *
     * @param int $id
     *
     * @return \Budgeck\Models\AccountBudget
     */
    public function getAccountBudgetById($id)
    {
        foreach ($this->budgets as $budget)
        {
            if ($budget->id == $id)
            {
                return $budget;
            }
        }
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
     * Return an account object from given id and logged in user.
     *
     * @param int $id
     *
     * @return Account
     */
    public static function getUserAccountById($id)
    {
        return self::where('id', $id)
            ->where('user_id', \Auth::user()->id)
            ->first();
    }

    /**
     * Return a transactions collection.
     *
     * @param $status
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTransactions($status)
    {
        $transactions = Transaction::select('transactions.*')
            ->where('account_id', $this->id);

        if ($status === Transaction::AWAITING)
        {
            $transactions->whereNull('value_date');
        }
        else
        {
            $transactions->whereNotNull('value_date');
        }

        $transactions->orderBy('year', 'DESC');
        $transactions->orderBy('month', 'DESC');
        $transactions->orderBy('transaction_date', 'DESC');

        //TODO: paginator (maybe implemented partial view with get method for infinite scroll)
        return $transactions->get();
    }

    /**
     * Make account the default one.
     */
    public function makeDefault()
    {
        $current_default = \Auth::user()->defaultAccount();
        $current_default->is_default = false;
        $current_default->save();

        $this->is_default = true;
        $this->save();
    }
}
