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
        
    ];
    
    /**
     * Returns the collection of spendings
     */
    public function spendings()
    {
        return $this->hasMany('Budgeck\Spending');
    }
    
    /**
     * Returns the sum of the spendings for the budget
    */
    public function getAmountSpent()
    {
        return $this->hasMany('Budgeck\Spending')
            ->sum('amount');
    }
    
    /**
     * Returns the sum of the debited spendings for the budget
    */
    public function getAmountSpentDebited()
    {
        return $this->hasMany('Budgeck\Spending')
            ->whereNotNull('debit_date')
            ->sum('amount');
    }
    
    /**
     * Returns list of budgets according to account, year and month
     */
    public static function getListFromAccountYearMonth($account_id, $year, $month) 
    {
        \Debugbar::info($account_id);
        \Debugbar::info($year);
        \Debugbar::info($month);
        return self::where('account_id', $account_id)
            ->where('year', $year)
            ->where('month', $month)
            ->lists('title', 'id');
    }
}
