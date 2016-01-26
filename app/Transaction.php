<?php

namespace Budgeck;

class Transaction extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'amount', 'payment_date', 'comment', 'category_id',
        'budget_id', 'payment_method_id'];
    
    /**
     * Define the rules to create or edit a transaction 
     * 
     * @var array 
     */
    protected $rules = [
        'description' => 'required|max:255',
        'amount' => ['required', 'regex:"(^\d*\.?\d*[0-9]+\d*$)|(^[0-9]+\d*\.\d*$)"'],
        'payment_date' => 'required|date_format:Y-m-d',
        'debit_date' => 'date_format:Y-m-d',
        'category_id' => 'required|exists:categories,id',
        'budget_id' => 'required|exists:budgets,id',
        'payment_method_id' => 'required|exists:payment_methods,id'
    ];
    
    /**
     * Define the messages associated to the rules
     * 
     * @var array 
     */
    protected $messages = [
        'description.required' => 'La description ne peut pas être vide',
        'description.max' => 'La description ne peut pas être aussi longue'
    ];
    
    public function budget()
    {
        return $this->belongsTo('Budgeck\Budget');
    }
    
    public function income()
    {
        return $this->belongsTo('Budgeck\Income');
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
        $transactionsFromBudgets = self::select('transactions.*')->leftJoin('budgets', 'transactions.budget_id', '=', 'budgets.id')
            ->leftJoin('accounts', 'budgets.account_id', '=', 'accounts.id')
            ->where('accounts.user_id', $user_id);
    
        $transactionsFromIncomes = self::select('transactions.*')->leftJoin('incomes', 'transactions.income_id', '=', 'incomes.id')
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
        
        //TODO: paginator
        return $query->get();
    }
}
