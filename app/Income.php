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
     * Define the rules to create or edit an income 
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
}
