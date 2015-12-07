<?php

namespace Budgeck;

class Income extends BaseModel
{   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'amount', 'year', 'month',
        'expected_date', 'account_id', 'category_id', 'account_income_id'];
    
    /**
     * Define the rules to create or edit a income 
     * 
     * @var array 
     */
    protected $rules = [
        'title' => 'required|max:45',
        'description' => 'max:255',
        'amount' => ['required', 'regex:"(^\d*\.?\d*[0-9]+\d*$)|(^[0-9]+\d*\.\d*$)"'],
        'year' => 'required|integer:4|min:2014',
        'month' => 'required|integer|min:1|max:12',
        'expected_date' => 'date_format:Y-m-d',
        'account_id' => 'required|exists:accounts,id',
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
}
