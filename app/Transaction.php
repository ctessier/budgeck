<?php

namespace Budgeck;

class Transaction extends BaseModel
{
    protected $table = "transactions";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'amount', 'transaction_date', 'effective_date', 'comment', 'category_id', 'budget_id', 'income_id', 'payment_method_id'];

    /**
     * Define the rules to create or edit a transaction
     *
     * @var array
     */
    protected $rules = [
        'title' => 'required|max:255',
        'amount' => ['required', 'regex:"(^\d*\.?\d*[0-9]+\d*$)|(^[0-9]+\d*\.\d*$)"'],
        'transaction_date' => 'required|date_format:Y-m-d',
        'effective_date' => 'date_format:Y-m-d',
        'category_id' => 'required|exists:categories,id',
        'budget_id' => 'required_without_all:income_id',
        'income_id' => 'required_without_all:budget_id',
        'payment_method_id' => 'exists:payment_methods,id'
    ];

    /**
     * Define the messages associated to the rules
     *
     * @var array
     */
    protected $messages = [
        'title.required' => 'La description ne peut pas être vide',
        'title.max' => 'La description ne peut pas être aussi longue'
    ];

    public function budget()
    {
        return $this->belongsTo('Budgeck\Budget');
    }

    public function income()
    {
        return $this->belongsTo('Budgeck\Income');
    }

    public function account() {
        return $this->isSpending() ?
            $this->budget->account : $this->income->account;
    }

    public function isSpending() {
        return $this->budget_id !== null;
    }

    public function isIncome() {
        return $this->income_id !== null;
    }

    /**
     * Return a transaction by its id
     */
    public static function getById($id) {
        if ($id === null) {
            return null;
        } else {
            return self::find($id);
        }
    }

    /**
     * Return a transactions collection
     *
     * @param int $user_id
     * @param int/string $account_id
     * @param bool $awaiting
     * @return
     */
    public static function getUserTransactionsFromAccountId($user_id, $account_id, $awaiting = false)
    {
        $transactionsFromBudgets = self::select('transactions.*', 'budgets.month as month')->leftJoin('budgets', 'transactions.budget_id', '=', 'budgets.id')
            ->leftJoin('accounts', 'budgets.account_id', '=', 'accounts.id')
            ->where('accounts.user_id', $user_id);

        $transactionsFromIncomes = self::select('transactions.*', 'incomes.month as month')->leftJoin('incomes', 'transactions.income_id', '=', 'incomes.id')
            ->leftJoin('accounts', 'incomes.account_id', '=', 'accounts.id')
            ->where('accounts.user_id', $user_id);

        if ($awaiting) {
            $transactionsFromBudgets->whereNull('effective_date');
            $transactionsFromIncomes->whereNull('effective_date');
        } else {
            $transactionsFromBudgets->whereNotNull('effective_date');
            $transactionsFromIncomes->whereNotNull('effective_date');
        }

        if ($account_id !== 'all') {
            $transactionsFromBudgets->where('accounts.id', $account_id);
            $transactionsFromIncomes->where('accounts.id', $account_id);
        }

        $query = $transactionsFromBudgets->union($transactionsFromIncomes->getQuery());

        $query->orderBy('month', 'DESC');
        $query->orderBy('transaction_date', 'DESC');

        //TODO: paginator
        return $query->get();
    }
}
