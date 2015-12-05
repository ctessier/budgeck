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
        'date', 'account_id', 'category_id', 'account_budget_id'];
    
    /**
     * Define the rules to create or edit a budget 
     * 
     * @var array 
     */
    protected $rules = [
        
    ];
    
    /**
     * Define the messages associated to the rules
     * 
     * @var array 
     */
    protected $messages = [
        
    ];
    
    public function getAmountSpent() {
        return Spending::where('budget_id', $this->id)->sum('amount');
    }
}
