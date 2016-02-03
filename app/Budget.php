<?php

namespace Budgeck;

class Budget extends BaseModel
{   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'amount', 'year', 'month',
        'date', 'account_budget_id', 'account_id', 'budget_type_id', 'category_id'];
    
    /**
     * Define the rules to create or edit a budget 
     * 
     * @var array 
     */
    protected $rules = [
        'title' => 'required|max:45',
        'description' => 'max:255',
        'amount' => ['required', 'regex:"(^\d*\.?\d*[0-9]+\d*$)|(^[0-9]+\d*\.\d*$)"'],
        'year' => 'required|integer:4|min:2014',
        'month' => 'required|integer|min:1|max:12',
        'date' => 'required_if:budget_type_id,1|date_format:Y-m-d',
        'account_id' => 'required|exists:accounts,id',
        'budget_type_id' => 'required|exists:budget_types,id',
        'category_id' => 'exists:categories,id'
    ];
    
    /**
     * Define the messages associated to the rules
     * 
     * @var array 
     */
    protected $messages = [
        'title.required' => 'Le titre ne peut pas être vide',
        'title.max' => 'Le titre ne peut pas être aussi long',
        'description.max' => 'La description ne peut pas être aussi longue',
        'amount.required' => 'Le montant ne peut pas être vide',
        'amount.regex' => 'Le format du montant est incorrect',
        'year.required' => 'Une année doit être sélectionnée',
        'month.required' => 'Un mois doit être sélectionné',
        'date.required_if' => 'La date ne peut pas être vide',
        'account_id.required' => 'Un compte doit être sélectionné',
        'budget_type_id.required' => 'Un type de budget doit être sélectionné'
    ];
    
    /**
     * Return the account of the budget
     */
    public function account()
    {
        return $this->belongsTo('Budgeck\Account');
    }
    
    /**
     * Return the collection of spendings
     */
    public function transactions()
    {
        return $this->hasMany('Budgeck\Transaction');
    }
    
    /**
     * Return the sum of the spendings for the budget
    */
    public function getAmountSpent()
    {
        return $this->hasMany('Budgeck\Transaction')
            ->sum('amount');
    }
    
    /**
     * Returns the sum of the debited spendings for the budget
    */
    public function getAmountSpentDebited()
    {
        return $this->hasMany('Budgeck\Transaction')
            ->whereNotNull('effective_date')
            ->sum('amount');
    }
    
    /**
     * Return the list of budgets according to account, year and month
     */
    public static function getListFromAccountYearMonth($account_id, $year, $month) 
    {
        return self::where('account_id', $account_id)
            ->where('year', $year)
            ->where('month', $month)
            ->lists('title', 'id');
    }
    
    /**
     * Return budgets of a given month
     *
     * @param int $user_id
     * @param int $account_id
     * @param int $year
     * @param int $month
     * @return
     */
    public static function getUserMonthBudgetsFromAccountId($account_id, $year, $month)
    {
        if ($account_id !== 'all')
        {
            $account = Account::getUserAccountById($account_id);
            return $account ? $account->getBudgets($year, $month) : null;
        }
        else
        {
            $budgets = null;
            foreach (\Auth::user()->accounts as $account)
            {
                if ($budgets === null)
                {
                    $budgets = $account->getBudgets($year, $month);
                }
                else 
                {
                    $budgets = $budgets->merge($account->getBudgets($year, $month));
                }
            }
            return $budgets;
        }
    }
}
